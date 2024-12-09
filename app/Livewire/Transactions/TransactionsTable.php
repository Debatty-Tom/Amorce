<?php

namespace App\Livewire\Transactions;

use App\Models\Fund;
use App\Models\TransactionSummaryView;
use Livewire\Attributes\Computed;
use Livewire\Component;

class TransactionsTable extends Component
{
    public $fund;
    public function mount(Fund $fund)
    {
        $this->fund = $fund;
    }
    public function render()
    {
        return view('livewire.transactions.transactions-table');
    }

    #[computed]
    public function transactions()
    {
        return $this->fund
            ->transactions()
            ->orderBy('created_at')
            ->paginate(9);
    }
}
