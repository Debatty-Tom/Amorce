<?php

namespace App\Livewire\Draws;

use App\Models\Draw;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DrawsList extends Component
{
    public $draws;
    public function mount($draws)
    {
        $this->draws = $draws;
        $this->draws = $draws->load('projects');
    }
    public function render()
    {
        return view('livewire.draws.draws-list');
    }
}
// propriété publique pour l'ordonnancement des tirages
