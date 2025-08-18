<?php

namespace App\Livewire;

use App\Models\Draw;
use App\Models\Event;
use App\Models\Todo;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Dashboard extends Component
{
    #[computed]
    public function draw()
    {
        return Draw::where('date', '>=', now())
            ->orderBy('date', 'desc')
            ->first();
    }
    #[computed]
    public function todo()
    {
        return Todo::with('users')
            ->whereHas('users', function ($query) {
                $query->where('users.id', auth()->id());
            })
            ->where('date', '>=', now())
            ->orderBy('created_at', 'desc')
            ->first();
    }
    #[computed]
    public function nextEvent()
    {
        return Event::where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->first();
    }
    #[on('refresh-dashboard')]
    public function refreshDashboard()
    {
        return;
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
