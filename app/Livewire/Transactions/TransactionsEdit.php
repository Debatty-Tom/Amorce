<?php

namespace App\Livewire\Transactions;

use App\Livewire\Forms\TransactionForm;
use App\Models\Fund;
use Livewire\Component;

class TransactionsEdit extends Component
{
    public $fund;
    public $feedback;
    public TransactionForm $form;

    public function mount(Fund $fund)
    {
        $this->form->setFund($fund);

        $this->fund = $fund;
    }
    public function save(){
        $this->form->update();
        $this->feedback='Transaction updated successfully';
    }

    public function render()
    {
        return view('livewire.transactions.transactions-edit');
    }
}
