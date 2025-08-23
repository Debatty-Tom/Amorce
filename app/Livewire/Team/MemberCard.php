<?php

namespace App\Livewire\Team;

use App\Models\User;
use Livewire\Component;

class MemberCard extends Component
{
    public User $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.team.member-card');
    }
}
