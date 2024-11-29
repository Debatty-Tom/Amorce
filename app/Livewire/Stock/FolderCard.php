<?php

namespace App\Livewire\Stock;

use App\Models\Stock;
use Livewire\Component;

class FolderCard extends Component
{
    public Stock $folder;
    public function mount($folder)
    {
        $this->folder = $folder;
    }
    public function render()
    {
        return view('livewire.stock.folder-card');
    }
}
