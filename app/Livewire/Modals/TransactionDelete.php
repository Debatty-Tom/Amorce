<?php

namespace App\Livewire\Modals;

use App\Enums\TransactionTypesEnum;
use App\Livewire\Forms\TransactionForm;
use App\Models\Fund;
use App\Models\Transaction;
use App\Traits\DeleteModalTrait;
use Livewire\Component;

class TransactionDelete extends Component
{
    use DeleteModalTrait;
    public TransactionForm $form;

    public $transaction;
    public $feedback = "";

    public function mount($id)
    {
        $this->transaction = Transaction::find($id);
    }
    public function delete()
    {
        $this->form->description = __('Suppression de la transaction :') . ' ' . $this->transaction->description;
        $this->form->amount = str_contains($this->transaction->amount, '-')
            ? ltrim($this->transaction->amount, '-')
            : '-' . $this->transaction->amount;
        $this->form->target = $this->transaction->fund_id;

        $this->form->create();
        $this->transaction->delete();

        $this->dispatch('refresh-transactions');
        $this->dispatch('refresh-fund');
        $this->dispatch('closeCardModal');
        $this->feedback = __('Transaction supprimée avec succès');
        $this->dispatch(event: 'openalert', params: ['message' => $this->feedback]);
    }
    public function render()
    {
        return view('livewire.modals.transaction-delete');
    }
}
