<?php

namespace App\Livewire\Forms;

use App\Enums\TransactionTypesEnum;
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
    #[Validate]
    public $target;
    public $transaction_type;
    public $hash;
    public $date;

    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;

        $this->description = $transaction->description ?? '';
        $this->amount = $transaction->amount ?? 0;
        $this->transaction_type = $transaction->transaction_type ?? 'default';
        $this->target = $transaction->fund_id ?? null;
        $this->hash = $transaction->hash ?? '';
        $this->date = $transaction->date ?? now();
    }

    public function rules()
    {
        return [
            'description' => ['max:255', 'nullable'],
            'amount' => ['required', 'numeric', 'nullable'],
            'target' => ['required'],
            'transaction_type' => ['string', 'nullable'],
            'hash' => ['string', 'nullable'],
            'date' => ['date', 'nullable'],
        ];
    }

    public function ensureFundHasSufficientBalance($edit = false): void
    {
        $fund = TransactionSummaryView::where('fund_id', $this->target)->firstOrFail();

        if (!$fund) {
            throw new \Exception('Fond non trouvé.');
        }

        if ($this->transaction_type === TransactionTypesEnum::WITHDRAWAL->value && str_contains($this->amount, '-')){
            $this->amount = str_replace('-', '', $this->amount);
        } elseif ($this->transaction_type === TransactionTypesEnum::DEPOSIT->value && str_contains($this->amount, '-')){
            $this->amount = abs($this->amount / 100);
            throw ValidationException::withMessages([
                'form.amount' => 'Si vous voulez éffectuer un retrait, choisissez le bon type de transaction',
            ]);
        }

        if ($edit && !str_contains($this->transaction->amount, '-')
            && $this->transaction_type === TransactionTypesEnum::WITHDRAWAL->value) {
            $proposedNewBalance = $fund->total_amount + ($this->amount * 2);
        } else {
            $proposedNewBalance = $fund->total_amount + $this->amount;
        }


        if ($proposedNewBalance < 0) {
            $this->amount = abs($this->amount / 100);
            throw ValidationException::withMessages([
                'form.amount' => 'Cette transaction mettrait le fond en négatif.',
            ]);
        }
    }


    public function update()
    {
        $validated = $this->validate();

        $this->ensureFundHasSufficientBalance($edit = true);
        $this->transaction->update([
            'fund_id' => $validated['target'],
            'amount' => $validated['amount'],
            'date' => $validated['date'] ?? $this->transaction->date,
            'description' => $validated['description'],
            'hash' => $validated['hash'] ?? $this->transaction->hash,
            'created_at' => $this->transaction->created_at,
            'updated_at'  => now(),
        ]);
    }

    public function create()
    {
        $validated = $this->validate();

        $this->ensureFundHasSufficientBalance();

        Transaction::create([
            'fund_id' => $validated['target'],
            'amount' => $validated['amount'],
            'date' => $validated['date'] ?? now(),
            'description' => $validated['description'],
            'hash' => $validated['hash'] ?? md5(json_encode('Transaction created')),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
