<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\DonatorForm;
use App\Models\Donator;
use Livewire\Component;

class DonatorCreate extends Component
{
    public $feedback = '';
    public Donator $donator;
    public DonatorForm $form;
    public $loading;
    public function mount(Donator $donator)
    {
        $this->form->setDonator($donator);

        $this->donator = $donator;
    }
    public function save(){
        $this->form->create();
        $this->feedback='Donator created successfully';

        $this->dispatch('closeModal');
    }
    public function render()
    {
        return view('livewire.modals.donator-create');
    }
}
