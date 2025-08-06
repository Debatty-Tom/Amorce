<?php

namespace App\Livewire\Team;

use App\Models\User;
use App\Traits\HandleSortingTrait;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TeamTable extends Component
{
    use WithPagination, HandleSortingTrait;

    public $categories;

    public function mount()
    {
        $this->categories = [
            'name' => __('Name'),
            'email' => __('Email'),
            'created_at' => __('Date de création'),
        ];
        $this->sorts = [
            'team' => ['field' => 'name', 'direction' => 'asc'],
        ];

        $this->searches = [
            'team' => '',
        ];
    }

    #[computed]
    public function users()
    {
        return User::where('name', 'like', '%' . $this->getSearch('team') . '%')
            ->orderBy($this->getSortField('team'), $this->getSortDirection('team'))
            ->paginate(12);
    }
    #[computed]
    public function trashedUsers()
    {
        return User::onlyTrashed()
            ->where('name', 'like', '%' . $this->getSearch('team') . '%')
            ->orderBy($this->getSortField('team'), $this->getSortDirection('team'))
            ->paginate(12);
    }

    #[On('refresh-users')]
    public function refreshUsers(): void
    {
        return;
    }

    public function render()
    {
        return view('livewire.team.team-table');
    }
}
