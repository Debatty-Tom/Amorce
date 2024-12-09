<?php

namespace App\Livewire\Draws;

use App\Models\Draw;
use App\Models\User;
use Livewire\Component;

class ParticipantList extends Component
{
    public $participants;

    public function mount()
    {
        $this->participants = User::all();
    }
    public function render()
    {
        return view('livewire.draws.participant-list');
    }
}
