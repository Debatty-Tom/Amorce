<?php

namespace App\Livewire\Accounting;

use App\Models\Fund;
use Livewire\Component;

class FundCard extends Component
{
    public $fund;
    public function mount($fund)
    {
        $this->fund = $fund;
    }
    public function render()
    {
        return view('livewire.accounting.fund-card');
    }
}
