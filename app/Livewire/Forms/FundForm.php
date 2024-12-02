<?php

namespace App\Livewire\Forms;

use App\Models\Fund;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FundForm extends Form
{
    public Fund $fund;
    #[Validate]
    public $title;
    #[Validate]
    public $description;
    #[Validate]
    public $total;

    public function setFund($fund)
    {
        $this->title = $fund->title;
        $this->description = $fund->description;
        $this->total = $fund->total;
    }
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:100','nullable'],
            'description' => ['max:255', 'nullable'],
            'total' => ['required', 'numeric', 'nullable'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->fund->update($this->except('fund'));
    }

    public function create()
    {
        $this->validate();

        Fund::create($this->validate());
    }
}
