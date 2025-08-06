<?php

namespace App\Livewire\Project;

use App\Models\Project;
use App\Traits\HandleSortingTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectsTable extends Component
{
    use WithPagination, HandleSortingTrait;

    public $categories;

    public function mount()
    {
        $this->categories = [
            'title' => __('Nom'),
            'description' => __('description'),
            'email' => __('Email'),
            'created_At' => __('Date de création'),
        ];
        $this->sorts = [
            'pending' => ['field' => 'title', 'direction' => 'asc'],
            'next' => ['field' => 'title', 'direction' => 'asc'],
            'funded' => ['field' => 'title', 'direction' => 'asc'],
        ];

        $this->searches = [
            'pending' => '',
            'next' => '',
            'funded' => '',
        ];
    }

    #[computed]
    public function pendingProjects()
    {
        return Project::whereDoesntHave('draws')
            ->where('title', 'like', '%' . $this->getSearch('pending') . '%')
            ->orderBy($this->getSortField('pending'), $this->getSortDirection('pending'))
            ->paginate(8, pageName: 'pendingProjectsPage');
    }

    #[computed]
    public function nextDrawProjects()
    {
        return Project::whereHas('draws', function ($query) {
            $query->where('status', 'pending');
        })
            ->where('title', 'like', '%' . $this->getSearch('next') . '%')
            ->orderBy($this->getSortField('next'), $this->getSortDirection('next'))
            ->paginate(8, pageName: 'nextDrawProjectsPage');
    }

    #[computed]
    public function fundedProjects()
    {
        return Project::whereHas('draws', function ($query) {
            $query->where('status', 'funded');
        })
            ->where('title', 'like', '%' . $this->getSearch('funded') . '%')
            ->orderBy($this->getSortField('funded'), $this->getSortDirection('funded'))
            ->paginate(8, pageName: 'fundedProjectsPage');
    }

    #[on('refresh-projects')]
    public function refreshProjects()
    {
        return;
    }

    public function render()
    {
        return view('livewire.project.projects-table');
    }
}
