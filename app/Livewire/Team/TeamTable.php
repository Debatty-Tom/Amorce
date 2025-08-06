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

    public $categories = [
        'name' => 'Name',
        'email' => 'Email',
        'created_at' => 'Date de création',
    ];
    public function mount()
    {
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
