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
        $this->form->description = __('amorce.transaction-cancel-transaction') . ' : ' . $this->transaction->description;
        $this->form->amount = str_contains($this->transaction->amount, '-')
            ? ltrim($this->transaction->amount, '-')
            : '-' . $this->transaction->amount;
        $this->form->target = $this->transaction->fund_id;
        $this->form->create();
        $newTransaction = Transaction::latest('id')->first();
        $newTransaction->delete();
        if (str_contains($this->transaction->hash, 'id:')) {
            $id = explode(':', $this->transaction->hash)[1];
            $transaction = Transaction::findorFail($id);
            $this->form->description = __('amorce.transaction-cancel-transaction') . ' : ' . $transaction->description;
            $this->form->amount = str_contains($transaction->amount, '-')
                ? ltrim($transaction->amount, '-')
                : '-' . $transaction->amount;
            $this->form->target = $transaction->fund_id;
            $this->form->create();
            $transaction->delete();
            $newTransaction = Transaction::latest('id')->first();
            $newTransaction->delete();
        }
        $this->transaction->delete();

        $this->dispatch('refresh-transactions');
        $this->dispatch('refresh-fund');
        $this->dispatch('closeCardModal');
        $this->feedback = __('amorce.message-transaction-deleted');
        $this->dispatch(event: 'openalert', params: ['message' => $this->feedback]);
    }
    public function render()
    {
        return view('livewire.modals.transaction-delete');
    }
}
