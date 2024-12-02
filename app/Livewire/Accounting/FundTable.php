<?php

namespace App\Livewire\Accounting;

use App\Models\Fund;
use App\Models\Transaction;
use Livewire\Component;

class FundTable extends Component
{
    public Fund $fund;
    public Transaction $transaction;
    public function mount(Fund $fund, Transaction $transaction)
    {
        $this->fund = $fund;
        $this->transaction = $transaction;
    }

    public function render()
    {
        return view('livewire.accounting.fund-table');
    }
}
