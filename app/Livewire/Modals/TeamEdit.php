<?php

namespace App\Livewire\Modals;

use App\Enums\RolesEnum;
use App\Livewire\Forms\TeamForm;
use App\Models\User;
use App\Traits\DeleteModalTrait;
use App\Traits\handlesImagesUpload;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class TeamEdit extends Component
{
    use WithFileUploads, handlesImagesUpload, DeleteModalTrait;
    public $feedback = '';
    public $user;
    public TeamForm $form;
    public $roles;
    public $loading;
    public function mount($id)
    {
        $this->user = User::withTrashed()->find($id);
        $this->form->setUser($this->user);
        $this->roles = Role::pluck('name', 'id')->toArray();
    }
    public function save(){
        if (!auth()->user()->hasAnyRole(RolesEnum::USERMANAGER->value, RolesEnum::ADMIN->value)) {
            abort(403, 'Vous n’avez pas la permission d’ajouter ou modifier des membres.');
        }
        $this->form->update();
        $this->feedback='User updated successfully';

        $this->dispatch('closeCardModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
        $this->dispatch('refresh-users');

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
    public function unarchiveUser()
    {
        $this->user->restore();

        $this->feedback='User restored successfully';

        $this->dispatch('refresh-users');
        $this->dispatch('closeCardModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
    }

    public function render()
    {
        return view('livewire.modals.team-edit');
    }
}
