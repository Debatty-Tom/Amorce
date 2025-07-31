<?php

namespace App\Livewire\Transactions;

use App\Models\Fund;
use App\Models\TransactionSummaryView;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class TransactionsTable extends Component
{
    public $fund;
    public function mount(Fund $fund)
    {
        $this->fund = $fund;
    }

    #[computed]
    public function transactions()
    {
        return $this->fund
            ->transactions()
            ->orderBy('date', 'desc')
            ->paginate(9);
    }

    #[on('refresh-transactions')]
    public function refreshTransactions()
    {
        return;
    }
    public function render()
    {
        return view('livewire.transactions.transactions-table');
    }
}
