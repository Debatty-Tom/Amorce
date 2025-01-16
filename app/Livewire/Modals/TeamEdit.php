<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\TeamForm;
use App\Models\User;
use Livewire\Component;

class TeamEdit extends Component
{
    public $feedback = '';
    public User $user;
    public TeamForm $form;
    public $loading;
    public function mount(User $user)
    {
        $this->form->setUser($user);

        $this->user = $user;
    }
    public function save(){
        $this->form->update();
        $this->feedback='Team member updated successfully';

        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.modals.team-edit');
    }
}
