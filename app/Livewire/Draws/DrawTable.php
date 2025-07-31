<?php

namespace App\Livewire\Draws;

use App\Models\Draw;
use App\Traits\DeleteModalTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class DrawTable extends Component
{
    use DeleteModalTrait;

    public $id;

    #[computed]
    public function draw()
    {
        return Draw::withTrashed()
            ->with(['donators', 'projects'])
            ->findOrFail($this->id);
    }

    public function tryDeleteOptions(): void
    {
        $this->dispatch('openCardModal', 'modals.draw-delete', ['id' => $this->id]);
        $this->showDeleteModal = false;
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
