<?php

namespace App\Livewire\Forms;

use App\Models\Fund;
use App\Models\Transaction;
use App\Models\TransactionSummaryView;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FundForm extends Form
{
    public Fund $fund;
    #[Validate]
    public $title;
    #[Validate]
    public $description;
    #[Validate]
    public $type;

    public function setFund($fund)
    {
        $this->fund = $fund;

        $this->title = $fund->title;
        $this->description = $fund->description;
        $this->type = $fund->type;
    }
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:100','nullable'],
            'description' => ['max:255', 'nullable'],
            'type' => ['required'],
        ];
    }

    public function update()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
        ];
        $this->fund->update($data);
    }

    public function create()
    {
        $validated = $this->validate();

        $fund = Fund::create($validated);

        Transaction::create([
            'fund_id' => $fund->id,
            'amount' => 0,
            'date' => now(),
            'description' => __('Transaction from fund creation'),
            'hash' => md5(json_encode('fund created')),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
