<?php

namespace App\Livewire\Draws;

use App\Models\Attendance;
use App\Models\Donator;
use App\Models\Draw;
use App\Models\User;
use Livewire\Component;

class ParticipantList extends Component
{
    public $participants;
    public $contact;

    public function mount()
    {
        $this->participants = Attendance::all();

        $contact = $this->participants->contact_data;
        dd($contact);
    }
    public function render()
    {
        return view('livewire.draws.participant-list');
    }
}
