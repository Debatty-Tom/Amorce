<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class Header extends Component
{
    public $title;
    public $buttonText;
    public $modalComponent;

    public function mount($title, $buttonText, $modalComponent)
    {
        $this->title = $title;
        $this->buttonText = $buttonText;
        $this->modalComponent = $modalComponent;
    }

    public function render()
    {
        return view('livewire.layout.header');
    }
}
