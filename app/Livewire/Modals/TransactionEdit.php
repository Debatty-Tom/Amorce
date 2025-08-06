<?php

namespace App\Livewire\Modals;

use App\Enums\TransactionTypesEnum;
use App\Livewire\Forms\TransactionForm;
use App\Models\Fund;
use App\Models\Transaction;
use Livewire\Component;

class TransactionEdit extends Component
{
    public TransactionForm $form;
    public $transaction;
    public $funds;
    public string $feedback = '';

    public function mount($id)
    {
        $this->transaction = Transaction::find($id);
        $this->form->setTransaction($this->transaction);
        $this->form->amount = $this->form->amount / 100;
        $this->form->amount < 0
            ? $this->form->transaction_type = TransactionTypesEnum::WITHDRAWAL->value
            : $this->form->transaction_type = TransactionTypesEnum::DEPOSIT->value;
        $this->funds = Fund::all();
    }

    public function save()
    {
        $this->form->amount = $this->form->transaction_type === TransactionTypesEnum::DEPOSIT->value
            ? $this->form->amount * 100
            : - $this->form->amount * 100;

        $this->form->update();

        $this->dispatch('refresh-transactions');
        $this->dispatch('closeCardModal');
        $this->feedback = __('Transaction effectuée avec succès');
        $this->dispatch(event: 'openalert', params: ['message' => $this->feedback]);
    }
    public function render()
    {
        return view('livewire.modals.transaction-edit');
    }
}
