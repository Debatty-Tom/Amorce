<?php

namespace App\Livewire\Accounting;

use App\Models\Fund;
use Livewire\Component;

class FundsTable extends Component
{
    public $principalFunds;
    public $specificFunds;
    public function mount()
    {
        $this->principalFunds = Fund::where('type', 'principal')->get();
        $this->specificFunds = Fund::where('type', 'specific')->get();
    }

    public function render()
    {
        return view('livewire.accounting.funds-table');
    }
}
