<?php

namespace App\Livewire\Team;

use App\Models\User;
use Livewire\Component;

class MemberCard extends Component
{
    public int $userId;
    public User $user;

    public function mount(int $userId)
    {
        $this->userId = $userId;
        $this->user = User::findOrFail($this->userId);
    }

    public function render()
    {
        $permissions = $this->user->getRoleNames();
        return view('livewire.team.member-card', compact('permissions'));
    }
}
