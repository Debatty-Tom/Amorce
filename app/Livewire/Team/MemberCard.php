<?php

namespace App\Livewire\Team;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class MemberCard extends Component
{
    public $userId;
    public User $user;

    public function mount($user)
    {
        $this->userId = $user->id;
    }
    #[Computed]
    public function user()
    {
        return User::find($this->userId);
    }

    #[on('refresh-users')]
    public function refreshUser()
    {
        return;
    }

    public function render()
    {
        return view('livewire.team.member-card');
    }
}
