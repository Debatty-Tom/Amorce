<?php

namespace App\Livewire\Draws;

use App\Models\Draw;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DrawsTable extends Component
{
    #[Computed]
    public function pastDraws()
    {
        return Draw::orderBy('date')->where('date', '<', now())->get();
    }
    #[Computed]
    public function nextDraws()
    {
        return Draw::orderBy('date')->where('date', '>', now())->get();
    }
    public function render()
    {
        return view('livewire.draws.draws-table');
    }
}
