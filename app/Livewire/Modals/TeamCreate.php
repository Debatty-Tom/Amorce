<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\TeamForm;
use Livewire\Component;

class TeamCreate extends Component
{
    public $feedback = '';
    public TeamForm $form;

    public function save(){
        $this->form->create();
        $this->feedback='Team member created successfully';

        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.modals.team-create');
    }
}
