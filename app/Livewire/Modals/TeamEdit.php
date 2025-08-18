<?php

namespace App\Livewire\Modals;

use App\Enums\RolesEnum;
use App\Livewire\Forms\TeamForm;
use App\Models\User;
use App\Traits\DeleteModalTrait;
use App\Traits\HandlesImagesUpload;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class TeamEdit extends Component
{
    use WithFileUploads, HandlesImagesUpload, DeleteModalTrait;
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
            abort(403, __('amorce.message-permission-denied-edit-member') . '.');
        }
        $this->form->update();
        $this->feedback = __('amorce.message-toast-success-edit-member');

        $this->dispatch('closeCardModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
        $this->dispatch('refresh-users');

    }

    public function deleteTeam()
    {
        if (!auth()->user()->hasAnyRole(RolesEnum::USERMANAGER->value, RolesEnum::ADMIN->value)) {
            abort(403, __('amorce.message-permission-denied-delete-member') . '.');
        }
        $this->user->delete();

        $this->feedback = __('amorce.message-toast-success-delete-member');

        $this->dispatch('refresh-users');
        $this->showDeleteModal = false;
        $this->dispatch('closeCardModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
    }
    public function unarchiveUser()
    {
        if (!auth()->user()->hasAnyRole(RolesEnum::USERMANAGER->value, RolesEnum::ADMIN->value)) {
            abort(403, __('amorce.message-permission-denied-unarchive-member') . '.');
        }
        $this->user->restore();

        $this->feedback = __('amorce.message-toast-success-restore-member');

        $this->dispatch('refresh-users');
        $this->dispatch('closeCardModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
    }

    public function render()
    {
        return view('livewire.modals.team-edit');
    }
}
