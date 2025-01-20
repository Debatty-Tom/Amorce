<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class UserTable extends Component
{
    #[On('refresh-profile')]
    public function refreshProfile()
    {
        unset($this->user);
    }
    public function render()
    {
        $user = Auth::user();
        return view('livewire.profile.user-table', compact('user'));
    }
}
