<?php

namespace App\Livewire\Draws;

use App\Models\Draw;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class DrawTable extends Component
{
    public $id;

    #[computed]
    public function draw()
    {
        return Draw::with(['donators', 'projects'])
        ->findOrFail($this->id);
    }

    #[on('refresh-draw')]
    public function refreshDraw()
    {
        return;
    }
    public function render()
    {
        return view('livewire.draws.draw-table');
    }
}
