<?php

namespace App\Livewire\Draws;

use App\Models\Draw;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class DrawsList extends Component
{
    public $id;
    public function mount($id)
    {
        $this->id = $id;
    }
    #[Computed]
    public function draw()
    {
        return Draw::with('projects')
            ->find($this->id);
    }
    #[On('refresh-draws')]
    public function refreshDraws(): void
    {
        return;
    }

    public function render()
    {
        return view('livewire.draws.draws-list');
    }
}
