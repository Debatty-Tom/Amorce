<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\DrawForm;
use App\Models\Draw;
use Livewire\Component;

class DrawCreate extends Component
{
    public $feedback = '';
    public DrawForm $form;
    public $loading;
    public Draw $draw;

    public function mount(Draw $draw)
    {
        $this->form->setDraw($draw);
        $this->draw = $draw;
    }
    public function normalizeNumber($input) {
        if (strpos($input, '.') !== false) {
            return str_replace('.', '', $input);
        } else {
            return $input * 100;
        }
    }

    public function save(){
        $this->form->amount = $this->normalizeNumber($this->form->amount);
        $this->form->create();
        $this->feedback='Draw created successfully';

        $this->dispatch('closeModal');

    }
    public function render()
    {
        return view('livewire.modals.draw-create');
    }
}
