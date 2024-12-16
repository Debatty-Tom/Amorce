<?php

namespace App\Livewire\Draws;

use App\Models\Draw;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DrawsList extends Component
{
    #[Computed]
    public function draws()
    {
        return Draw::orderBy('date')->paginate(5);
    }
    public function render()
    {
        return view('livewire.draws.draws-list');
    }
}
// propriété publique pour l'ordonnancement des tirages
