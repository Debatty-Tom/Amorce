<?php

namespace App\Livewire\Modals;

use App\Enums\RolesEnum;
use App\Livewire\Forms\FundForm;
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
        $targetFund = Fund::findOrFail($fundId);

        Transaction::create([
            'fund_id' => $targetFund->id,
            'amount' => $amount * 100,
            'date' => now(),
            'title' => 'Redistribution du fond ' . $this->sourceFund->title,
            'description' => 'Montant redistribué depuis le fond ' . $this->sourceFund->title . ' lors de son archive',
            'hash' => md5(json_encode('fund credited')),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Transaction::create([
            'fund_id' => $this->sourceFund->id,
            'amount' => -($amount * 100),
            'date' => now(),
            'title' => 'Redistribution Sortante',
            'description' => 'Redistribution vers le fond ' . $targetFund->title,
            'hash' => md5(json_encode('fund debited')),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->dispatch('openalert', message: "Montant de {$amount} € redistribué avec succès.");
        $this->dispatch('refresh-fund');
    }


    public function deleteFund()
    {
        if (!auth()->user()->hasAnyRole(RolesEnum::ACCOUNTANT->value, RolesEnum::ADMIN->value)) {
            abort(403, 'Vous n’avez pas la permission de supprimer un fond.');
        }

        $this->sourceFund->delete();

        $this->feedback = 'Fund archived successfully';

        $this->dispatch('refresh-funds');
        $this->showDeleteModal = false;
        $this->dispatch('closeCardModal');
        $this->dispatch(event: 'openalert', params: ['message' => $this->feedback]);
        $this->redirectRoute('accounting.index');
    }

    public function render()
    {
        return view('livewire.modals.fund-delete');
    }
}
