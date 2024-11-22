<?php

namespace App\Livewire\Links;

use http\Env\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;
use Livewire\Component;

class Navigation extends Component
{
    public string $href = '';
    public bool $active = false;
    public string $label = '';
    public string $icon = '';
    public function mount($href,$label,$icon)
    {
        $this->href = $href;
        $this->label = $label;
        $this->icon = $icon;

    }

    public function navigationStatement()
    {
        $currentRoute = \Illuminate\Support\Facades\Route::getCurrentRoute()->uri();

        if (str_contains($this->href, $currentRoute)) {
            return 'bg-indigo-900 text-white hover:bg-indigo-500';
        } else {
            return 'text-indigo-900 hover:bg-indigo-500 hover:text-white';
        }
    }

    public function render()
    {
        return view('livewire.links.navigation', [
            'navigationStatement' => $this->navigationStatement()
        ]);
    }
}
