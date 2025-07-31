<?php

namespace App\Livewire\Forms;

use App\Models\Fund;
use App\Models\Transaction;
use App\Models\TransactionSummaryView;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TransactionForm extends Form
{
    public Transaction $transaction;
    #[Validate]
    public $description;
    #[Validate]
    public $amount;
    public $transaction_type;
    public $target;

    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;

        $this->description = $transaction->description ?? '';
        $this->amount = $transaction->amount ?? 0;
        $this->transaction_type = $transaction->transaction_type ?? 'default';
        $this->target = $transaction->fund_id ?? null;
    }
    public function rules()
    {
        return [
            'description' => ['max:255', 'nullable'],
            'amount' => ['required', 'numeric', 'nullable'],
            'target' => ['required'],
        ];
    }

    public function ensureFundHasSufficientBalance(): void
    {
        $fund = TransactionSummaryView::where('fund_id', $this->target)->firstOrFail();

        if (!$fund) {
            throw new \Exception('Fond non trouvé.');
        }

        $proposedNewBalance = $fund->total_amount + $this->amount;

        if ($proposedNewBalance < 0) {
            $this->amount = abs($this->amount / 100);
            throw ValidationException::withMessages([
                'form.amount' => 'Cette transaction mettrait le fond en négatif.',
            ]);
        }
    }


    public function update()
    {
        $this->validate();

        $this->fund->update($this->except('transaction'));
    }

    public function create()
    {
        $validated = $this->validate();

        $this->ensureFundHasSufficientBalance();

        Transaction::create([
            'fund_id'     => $validated['target'],
            'amount'      => $validated['amount'],
            'date'        => now(),
            'description' => $validated['description'],
            'hash'        => md5(json_encode('Transaction created')),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
