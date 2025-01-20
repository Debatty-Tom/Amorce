<?php

namespace App\Livewire\Draws;

use App\Models\Draw;
use Livewire\Component;

class DrawTable extends Component
{
    public Draw $draw;

    public function mount()
    {
        $this->draw->load('donators');
        $this->draw->load('projects');
    }
    public function render()
    {
        return view('livewire.draws.draw-table');
    }
}
