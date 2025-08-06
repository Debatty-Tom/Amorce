<?php

namespace App\Livewire\Accounting;

use App\Enums\TransactionTypesEnum;
use App\Livewire\Forms\TransactionForm;
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
    public $funds;
    public TransactionForm $form;
    public string $feedback;


    public function mount($fund_id)
    {
        $this->funds = Fund::all();
        $this->id = $fund_id;
        $this->transactionSummaryView = TransactionSummaryView::where('fund_id', $this->id)->first();
        $this->form->target = $this->id;
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
        if ($this->id === 1) {
            abort(403, 'Vous ne pouvez pas supprimer le fond de base.');
        }
        if ($this->transactionSummaryView->total_amount > 0) {
            $this->dispatch('openCardModal', 'modals.fund-delete', ['fund' => $this->id]);
            $this->showDeleteModal = false;
            return;
        }
        $this->fund->delete();
        $this->feedback = 'Fonds archivé avec succès';
        $this->dispatch(event: 'openalert', params: ['message' => $this->feedback]);
        $this->dispatch('refresh-fund');
        $this->showDeleteModal = false;
        $this->redirectRoute('accounting.index');
    }
    public function unarchiveFund(): void
    {
        $this->fund->restore();
    }

    public function newTransfer()
    {
        $this->form->amount = $this->form->transaction_type === TransactionTypesEnum::DEPOSIT->value ? $this->form->amount * 100 : - $this->form->amount * 100;

        $this->form->create();

        $this->dispatch('refresh-transactions');
        $this->feedback = 'Transaction effectuée avec succès';
        $this->dispatch(event: 'openalert', params: ['message' => $this->feedback]);
        $this->form->resetExcept('transaction');
        $this->form->target = $this->id;
    }

    public function render()
    {
        return view('livewire.accounting.fund-table');
    }
}
