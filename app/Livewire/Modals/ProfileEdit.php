<?php

namespace App\Livewire\Modals;

use App\Enums\RolesEnum;
use App\Livewire\Forms\TeamForm;
use App\Livewire\Forms\UserForm;
use App\Models\User;
use App\Traits\DeleteModalTrait;
use App\Traits\HandlesImagesUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class ProfileEdit extends Component
{
    use WithFileUploads, HandlesImagesUpload, DeleteModalTrait;
    public $feedback = '';
    public $user;
    public TeamForm $form;
    public $roles;
    public $loading;
    public function mount()
    {
        $this->user = Auth()->user();
        $this->form->setUser($this->user);
        $this->roles = Role::pluck('name', 'id')->toArray();
    }
    public function save(){
        if (!auth()->user()) {
            abort(403, __('Vous n’avez pas la permission de modifier un autre profile que le votre.'));
        }
        $this->form->update();
        $this->feedback = __('Profile updated successfully');

        $this->dispatch('closeCardModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
        $this->dispatch('refresh-profile');

    }

    public function deleteProfile()
    {
        if (!auth()->user()) {
            abort(403, __('Vous n’avez pas la permission de supprimer un autre profile que le votre.'));
        }
        $this->user->delete();

        $this->redirect('logout');
    }

    public function render()
    {
        return view('livewire.modals.profile-edit');
    }
}
