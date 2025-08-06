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
    public $categories;
    public function mount(Fund $fund)
    {
        $this->categories = [
            'date' => __('Date'),
            'description' => __('Description'),
            'amount' => __('Montant'),
            'created_at' => __('Date de création'),
        ];
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
