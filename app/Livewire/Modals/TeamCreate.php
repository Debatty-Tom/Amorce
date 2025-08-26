<?php

namespace App\Livewire\Modals;

use App\Enums\RolesEnum;
use App\Livewire\Forms\TeamForm;
use App\Models\User;
use App\Traits\HandlesImagesUpload;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class TeamCreate extends Component
{
    use WithFileUploads, HandlesImagesUpload;
    public $feedback = '';
    public TeamForm $form;
    public $roles;

    public function mount(): void
    {
        $this->roles = Role::pluck('name', 'id')->toArray();
    }
    public function save(){
        if (!auth()->user()->hasAnyRole(RolesEnum::USERMANAGER->value, RolesEnum::ADMIN->value)) {
            abort(403, __('amorce.message-permission-denied-edit-member') . '.');
        }
        $this->validate();
        $data = $this->form->all();
        if ($this->form->image) {
            $path = $this->form->image->store('images/users', 'public');
            $data['picture_path'] = asset('storage/' . $path);
        }
        User::create($data)->assignRole($this->form->role);
        $this->feedback = __('amorce.message-toast-success-member');

        $this->dispatch('closeModal');
        $this->dispatch(event: 'openalert', params: ['message' => $this->feedback]);
        $this->dispatch('refresh-users');

    }

    public function render()
    {
        return view('livewire.modals.team-create');
    }
}
