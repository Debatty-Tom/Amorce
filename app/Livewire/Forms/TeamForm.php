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

    public function setUser($user)
    {
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->email;
    }
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100','nullable'],
            'email' => ['email', 'max:50', 'nullable'],
            'password' => ['required', 'string', 'max:100','nullable'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->user->update($this->except('user'));
    }

    public function create()
    {
        $this->validate();

        User::create($this->validate());
    }
}
