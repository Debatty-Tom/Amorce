<?php

namespace App\Livewire\Forms;

use App\Models\Transaction;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TransactionForm extends Form
{
    public Transaction $transaction;
    #[Validate]
    public $title;
    #[Validate]
    public $description;
    #[Validate]
    public $amount;

    public function setFund($transaction)
    {
        $this->title = $transaction->title;
        $this->description = $transaction->description;
        $this->amount = $transaction->amount;
    }
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:100','nullable'],
            'description' => ['max:255', 'nullable'],
            'amount' => ['required', 'numeric', 'nullable'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->fund->update($this->except('transaction'));
    }

    public function create()
    {
        $this->validate();

        Transaction::create($this->validate());
    }
}
