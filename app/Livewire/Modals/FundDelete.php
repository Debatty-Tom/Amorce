<?php

namespace App\Livewire\Modals;

use App\Enums\RolesEnum;
use App\Livewire\Forms\FundForm;
use App\Livewire\Forms\TransactionForm;
use App\Models\Fund;
use App\Models\Transaction;
use App\Models\TransactionSummaryView;
use App\Traits\DeleteModalTrait;
use Brick\Money\Money;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FundDelete extends Component
{
    use DeleteModalTrait;

    public $feedback = '';
    public $sourceFund;
    public TransactionForm $transactionForm;

    public function mount(Fund $fund)
    {
        $this->sourceFund = $fund;
    }

    #[Computed]
    public function sourceFundView(): TransactionSummaryView
    {
        return TransactionSummaryView::where('fund_id', $this->sourceFund->id)->firstOrFail();
    }

    #[Computed]
    public function rangeMax(): float
    {
        return $this->sourceFundView->total_amount / 100;
    }

    #[Computed]
    public function amount(): string
    {
        return Money::ofMinor($this->sourceFundView->total_amount, 'EUR')->formatTo('fr_BE');
    }

    #[Computed]
    public function targetFunds()
    {
        return Fund::query()
            ->where('id', '!=', $this->sourceFund->id)
            ->get();
    }

    public function assign($fundId, $amount)
    {
        if (!auth()->user()->hasAnyRole(RolesEnum::ACCOUNTANT->value, RolesEnum::ADMIN->value)) {
            abort(403, 'Vous n’avez pas la permission d’assigner de l’argent.');
        }
        $formatedAmount = round($amount, 2);
        $targetFund = Fund::findOrFail($fundId);
        $this->transactionForm->target = $targetFund->id;
        $this->transactionForm->amount = $formatedAmount * 100;
        $this->transactionForm->description = 'Montant redistribué depuis le fond ' . $this->sourceFund->title . ' lors de son archive';
        $this->transactionForm->create();

        $this->transactionForm->target = $this->sourceFund->id;
        $this->transactionForm->amount = -($amount * 100);
        $this->transactionForm->description = 'Redistribution vers le fond ' . $targetFund->title;
        $this->transactionForm->create();

        $this->feedback = "Montant de {$amount} € redistribué avec succès.";
        $this->dispatch(event: 'openalert', params: ['message' => $this->feedback]);
        $this->dispatch('refresh-fund');
    }


    public function deleteFund()
    {
        if (!auth()->user()->hasAnyRole(RolesEnum::ACCOUNTANT->value, RolesEnum::ADMIN->value)) {
            abort(403, 'Vous n’avez pas la permission de supprimer un fond.');
        }

        if ($this->sourceFundView->total_amount > 0) {
            $this->feedback = 'Impossible de supprimer le fond car il contient encore des fonds. Veuillez redistribuer les fonds restants avant de supprimer le fond.';
            $this->dispatch(event: 'openalert', params: ['message' => $this->feedback, 'type' => 'error']);
            return;
        }

        $this->sourceFund->delete();

        $this->feedback = 'Fund archived successfully';

        $this->dispatch('refresh-funds');
        $this->showDeleteModal = false;
        $this->dispatch('closeCardModal');
        $this->dispatch(event: 'openalert', params: ['message' => $this->feedback]);
        $this->redirectRoute('accounting.index');
    }
    public function cancelDelete()
    {
        $this->dispatch('closeCardModal');
    }

    public function render()
    {
        return view('livewire.modals.fund-delete');
    }
}
