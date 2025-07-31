<?php

namespace App\Livewire\Team;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TeamTable extends Component
{
    use WithPagination;
    #[computed]
    public function users()
    {
        return User::paginate(12);
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
