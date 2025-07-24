<?php

namespace App\Livewire\Layout;

use Livewire\Attributes\On;
use Livewire\Component;

class CardModal extends Component
{
    public $isCardOpen = false;
    public $livewireComponent = null;

    protected $listeners = ['openCardModal'];
    public array $componentParams;

    #[On('openCardModal')]
    public function openCardModal($component, $params = null): void
    {
        $this->livewireComponent = $component;
        $this->componentParams = $params ?? [];
        $this->isCardOpen = true;
    }

    #[On('closeCardModal')]
    public function closeCardModal(): void
    {
        $this->isCardOpen = false;
        $this->livewireComponent = null;
        $this->componentParams = [];
    }

    public function render()
    {
        return view('livewire.layout.card-modal');
    }
}
