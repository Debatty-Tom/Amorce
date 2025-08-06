<?php

namespace App\Livewire\Links;

use Livewire\Component;

class Navigation extends Component
{
    public string $href = '';
    public string $label = '';
    public string $icon = '';
    public bool $isActive = false;
    public function mount($href,$label,$icon)
    {
        $this->href = $href;
        $this->label = $label;
        $this->icon = $icon;

        $this->setActive();
    }
    public function setActive()
    {
        $this->isActive = str_contains(request()->url(), route($this->href));
    }

    public function render()
    {
        return view('livewire.links.navigation');
    }
}
