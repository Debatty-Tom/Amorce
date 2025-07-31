<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectsTable extends Component
{
    use WithPagination;

    #[computed]
    public function pendingProjects()
    {
        return Project::whereDoesntHave('draws')->paginate(8, pageName: 'pendingProjectsPage');
    }

    #[computed]
    public function nextDrawProjects()
    {
        return Project::whereHas('draws', function ($query) {
            $query->where('status', 'pending');
        })->paginate(8, pageName: 'nextDrawProjectsPage');
    }

    #[computed]
    public function fundedProjects()
    {
        return Project::whereHas('draws', function ($query) {
            $query->where('status', 'funded');
        })
            ->limit(20)
            ->orderBy('created_at')
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
