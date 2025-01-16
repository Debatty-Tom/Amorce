<?php

namespace App\Livewire\Forms;

use App\Models\Donator;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DonatorForm extends Form
{
    public Donator $donator;
    #[Validate]
    public $name;
    #[Validate]
    public $email;
    #[Validate]
    public $phone;
    #[Validate]
    public $address;

    public function setDonator($donator)
    {
        $this->name = $donator->name;
        $this->email = $donator->email;
        $this->phone = $donator->email;
        $this->address = $donator->address;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100', 'nullable'],
            'email' => ['email', 'max:50', 'nullable'],
            'phone' => ['max:50', 'nullable'],
            'address' => ['max:150', 'nullable'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->donator->update($this->except('donator'));
    }

    public function create()
    {
        $this->validate();

        Donator::create($this->validate());
    }
}
