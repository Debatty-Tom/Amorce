<?php

namespace App\Livewire\Draws;

use App\Models\Draw;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DrawsTable extends Component
{
    public $draws;
    public function mount()
    {
        $this->draws = Draw::all();
    }
    public function render()
    {
        return view('livewire.draws.draws-table');
    }
}
