<?php

namespace App\Livewire\Accounting;

use App\Models\Fund;
use Brick\Money\Money;
use Illuminate\Support\Str;
use Livewire\Component;

class FundCard extends Component
{
    public $fund;
    public function mount($fund)
    {
        $this->fund = $fund;

        $fund->descriptionLimited = str::limit($fund->fund_description, 50, preserveWords: true);
        $fund->amount = Money::ofMinor($fund->total_amount, 'EUR')->formatTo('fr_BE');
        $fund->titleLimited = str::limit($fund->fund_title, 25, preserveWords: true);
    }
    public function render()
    {
        return view('livewire.accounting.fund-card');
    }
}
