<?php

namespace App\Livewire\Modals;

use App\Enums\RolesEnum;
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
        if (!auth()->user()->hasAnyRole(RolesEnum::ADMIN->value)) {
            abort(403, __('Vous n’avez pas la permission d’ajouter ou modifier des donateurs.'));
        }
        $this->form->create();
        $this->feedback=__('Donator created successfully');

        $this->dispatch('closeModal');
    }
    public function render()
    {
        return view('livewire.modals.donator-create');
    }
}
