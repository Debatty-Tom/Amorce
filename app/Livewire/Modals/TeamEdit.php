<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\TeamForm;
use App\Models\User;
use App\Traits\handlesImagesUpload;
use Livewire\Component;
use Livewire\WithFileUploads;

class TeamEdit extends Component
{
    use WithFileUploads, handlesImagesUpload;
    public $feedback = '';
    public $user;
    public TeamForm $form;
    public $showDeleteModal = false;
    public $loading;
    public function mount(User $user)
    {
        $this->form->setUser($user);
        $this->user = User::find($user['id']);
    }
    public function save(){
        $this->form->update();
        $this->feedback='User updated successfully';

        $this->dispatch('closeCardModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
        $this->dispatch('refresh-users');

    }
    public function confirmDelete()
    {
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
    }

    public function deleteTeam()
    {
        $this->user->delete();

        $this->feedback='User deleted successfully';

        $this->dispatch('refresh-users');
        $this->showDeleteModal = false;
        $this->dispatch('closeCardModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
    }

    public function render()
    {
        return view('livewire.modals.team-edit');
    }
}
