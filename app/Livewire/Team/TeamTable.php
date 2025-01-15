<?php

namespace App\Livewire\Team;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class TeamTable extends Component
{
    #[computed]
    public function users(): Collection
    {
        return User::all();
    }

    public function render()
    {
        return view('livewire.team.team-table');
    }
}
