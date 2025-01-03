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
<<<<<<< Updated upstream
        $this->draws = $draws;


=======
        return Draw::orderBy('date')->paginate(10);
>>>>>>> Stashed changes
    }
//    #[Computed]
//    public function pastDraws()
//    {
//        return Draw::orderBy('date');
//    }
//    #[Computed]
//    public function nextDraws()
//    {
//        return Draw::orderBy('date');
//    }
    public function render()
    {
        return view('livewire.draws.draws-list');
    }
}
