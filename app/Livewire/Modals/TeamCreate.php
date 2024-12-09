<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\TeamForm;
use App\Models\User;
use Livewire\Component;

class TeamCreate extends Component
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
        $this->form->create();
        $this->feedback='Team member created successfully';

        $this->dispatch('closeModal');
    }


    public function render()
    {
        return view('livewire.modals.team-create');
    }

    public function waitingToRedirect()
    {
        $user = $this->user;
        return $this->redirect('/team', navigate: true);

    }
}
