<?php

namespace App\Livewire\Forms;

use App\Models\User;
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

    public function setUser($user)
    {
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->email;
        $this->image = $user->image;
    }
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100','nullable'],
            'email' => ['email', 'max:50', 'nullable'],
            'password' => ['required', 'string', 'max:100','nullable'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048', 'dimensions:max_width=1000,max_height=1000'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->user->update($this->except('user'));
    }
}
