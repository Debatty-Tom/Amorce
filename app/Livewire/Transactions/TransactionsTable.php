<?php

namespace App\Livewire\Transactions;

use App\Models\Fund;
use App\Models\TransactionSummaryView;
use App\Traits\HandleSortingTrait;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class TransactionsTable extends Component
{
    use HandleSortingTrait;
    public $fund;
    public $categories = [
        'date' => 'Date',
        'description' => 'Description',
        'amount' => 'Montant',
        'created_at' => 'Date de création',
    ];
    public function mount(Fund $fund)
    {
        $this->fund = $fund;
        $this->sorts = [
            'transaction' => ['field' => 'description', 'direction' => 'desc'],
        ];
        $this->searches = [
            'transaction' => '',
        ];
    }

    #[computed]
    public function transactions()
    {
        return $this->fund
            ->transactions()->withTrashed()
            ->where('description', 'like', '%' . $this->getSearch('transaction') . '%')
            ->orderBy($this->getSortField('transaction'), $this->getSortDirection('transaction'))
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
