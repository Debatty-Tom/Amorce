<?php

namespace App\Livewire\Team;

use App\Models\User;
use Livewire\Component;

class TeamTable extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.team.team-table');
    }
}
