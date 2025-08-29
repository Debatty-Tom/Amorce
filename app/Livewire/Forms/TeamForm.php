<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TeamForm extends Form
{
    public User $user;
    #[Validate]
    public $name;
    #[Validate]
    public $email;
    #[Validate]
    public $password;
    #[Validate]
    public $image;
    #[Validate]
    public $role;

    public function setUser($user): void
    {
        $this->user = $user;

        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->image = null;
        $this->role = $user->getRoleNames()->first() ?? '';
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:50'],
            'password' => ['nullable', 'string', 'min:6'],
            'image' => ['nullable', 'image', 'max:5120'],
            'role' => ['required', 'exists:roles,name'],
        ];
    }

    public function update(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if (!empty($this->password)) {
            $data['password'] = bcrypt($this->password);
        }
        if ($this->image) {
            $path = $this->image->store('images/users', 's3');
            $data['picture_path'] = Storage::disk('s3')->url($path);
        }
        $this->user->update($data);
        if ($this->role) {
            $this->user->syncRoles([$this->role]);
        }
    }
}
