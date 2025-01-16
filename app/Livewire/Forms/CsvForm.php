<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CsvForm extends Form
{
    public Draw $draw;
    #[Validate]
    public $new_participants;

    public function setDraw($draw)
    {
        $this->title = $draw->title;
        $this->description = $draw->description;
        $this->amount = $draw->amount;
        $this->date = $draw->date;
        $this->new_participants = [];
    }
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:100','nullable'],
            'description' => ['max:255', 'nullable'],
            'amount' => ['required', 'numeric', 'nullable'],
            'date' => ['required', 'date', 'nullable'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->draw->update($this->except('draw'));
    }

    public function create()
    {
        $this->validate();

        return Draw::create($this->validate());
    }
}
