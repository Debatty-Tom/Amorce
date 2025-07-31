<?php

namespace App\Livewire\Modals;

use App\Enums\RolesEnum;
use App\Livewire\Forms\TeamForm;
use App\Models\User;
use App\Traits\handlesImagesUpload;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class TeamCreate extends Component
{
    use WithFileUploads, handlesImagesUpload;
    public $feedback = '';
    public TeamForm $form;
    public $roles;

    public function mount(): void
    {
        $this->roles = Role::pluck('name', 'id')->toArray();
    }
    public function save(){
        if (!auth()->user()->hasAnyRole(RolesEnum::USERMANAGER->value, RolesEnum::ADMIN->value)) {
            abort(403, 'Vous n’avez pas la permission d’ajouter ou modifier des membres.');
        }
        $this->validate();
        $data = $this->form->all();
        if ($this->form->image) {
            $data['picture_path'] = Storage::disk('public')
                ->put('images/users', $data['image']);
        }
        User::create($data)->assignRole($this->form->role);
        $this->feedback='Team member created successfully';

        $this->dispatch('closeModal');
        $this->dispatch('openalert', message: $this->feedback);
        $this->dispatch('refresh-users');

    }

    public function render()
    {
        return view('livewire.modals.team-create');
    }
}
