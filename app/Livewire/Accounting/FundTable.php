<?php

namespace App\Livewire\Accounting;

use App\Models\Fund;
use App\Models\Transaction;
use App\Models\TransactionSummaryView;
use App\Traits\DeleteModalTrait;
use Brick\Money\Money;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class FundTable extends Component
{
    use DeleteModalTrait;

    public $id;
    public $transactionSummaryView;

    public function mount($fund_id)
    {
        $this->id = $fund_id;
        $this->transactionSummaryView = TransactionSummaryView::where('fund_id', $this->id)->first();
    }
    #[computed]
    public function fund()
    {
        return Fund::withTrashed()->where('id', $this->id)->first();
    }
    #[computed]
    public function amount()
    {
        return Money::ofMinor($this->transactionSummaryView->total_amount, 'EUR')->formatTo('fr_BE');
    }

    #[On('refresh-fund')]
    public function refreshFund(): void
    {
        return;
    }

    public function tryDeleteOptions(): void
    {
        if ($this->transactionSummaryView->total_amount > 0) {
            $this->dispatch('openCardModal', 'modals.fund-delete', ['fund' => $this->id]);
            $this->showDeleteModal = false;
            return;
        }

        $this->fund->delete();
        $this->dispatch('openalert', ['message' => 'Fonds archivé avec succès']);
        $this->dispatch('refresh-fund');
        $this->showDeleteModal = false;
        $this->redirectRoute('accounting.index');
    }
    public function unarchiveFund(): void
    {
        $this->fund->restore();
    }

    public function render()
    {
        return view('livewire.accounting.fund-table');
    }
}
