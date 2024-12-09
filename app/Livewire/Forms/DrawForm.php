<?php

namespace App\Livewire\Forms;

use App\Models\Draw;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DrawForm extends Form
{
    public Draw $draw;
    #[Validate]
    public $title;
    #[Validate]
    public $description;
    #[Validate]
    public $amount;
    #[Validate]
    public $date;

    public function setDraw($draw)
    {
        $this->title = $draw->title;
        $this->description = $draw->description;
        $this->amount = $draw->amount;
        $this->date = $draw->date;
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

        Draw::create($this->validate());
    }
}
