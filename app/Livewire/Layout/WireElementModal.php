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

    #[On('openModal')]
    public function openModal($component, $params = null)
    {
        $this->livewireComponent = $component;
        $this->isOpen = true;
    }

    #[On('closeModal')]
    public function closeModal()
    {
        $this->isOpen = false;
        $this->livewireComponent = null;
    }

    public function render()
    {
        return view('livewire.layout.wire-element-modal');
    }
}
