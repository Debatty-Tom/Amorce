<?php

namespace App\Livewire\Layout;

use Livewire\Attributes\On;
use Livewire\Component;

class WireElementModal extends Component
{
    public $isOpen = false;
    public $livewireComponent = null;

    protected $listeners = [
        'openModal',
    ];
    public array $componentParams;

    #[On('openModal')]
    public function openModal($component, $params = null)
    {
        $this->livewireComponent = $component;
        $this->componentParams = $params ?? [];
        $this->isOpen = true;
    }

    #[On('closeModal')]
    public function closeModal()
    {
        $this->isOpen = false;
        $this->livewireComponent = null;
        $this->componentParams = [];
    }

    public function render()
    {
        return view('livewire.layout.wire-element-modal');
    }
}
