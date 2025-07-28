<?php

namespace App\Livewire\Forms;

use App\Models\Donator;
use App\Models\Draw;
use Carbon\Carbon;
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
    #[Validate]
    public $new_participants;

    public function setDraw($draw)
    {
        $this->title = $draw->title;
        $this->description = $draw->description;
        $this->amount = $draw->amount;
        $this->date = Carbon::parse($draw->date)->format('Y-m-d');
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
