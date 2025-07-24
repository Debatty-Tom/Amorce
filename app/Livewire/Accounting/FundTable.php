<?php

namespace App\Livewire\Accounting;

use App\Models\Fund;
use App\Models\Transaction;
use App\Models\TransactionSummaryView;
use App\Traits\DeleteModalTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class FundTable extends Component
{
    use DeleteModalTrait;

    public Fund $fund;
    public TransactionSummaryView $fund_view;

    public function mount(TransactionSummaryView $fund_id)
    {
        $id = $fund_id->fund_id;
        $this->fund = Fund::where('id', $id)->first();
        $this->fund_view = $fund_id;
    }
    #[On('refresh-fund')]
    public function refreshFund(): void
    {
        return;
    }

    public function render()
    {
        return view('livewire.accounting.fund-table');
    }
}
