<?php

namespace App\Livewire\Accounting;

use App\Models\Fund;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class FundsTable extends Component
{
    #[Computed]
    public function principalFunds(){
        return Fund::where('type', 'principal')->get();
    }
    #[Computed]
    public function specificFunds(){
        return Fund::where('type', 'specific')->get();
    }
    #[On('reset_fund_table')]
    public function resetFundtable(){
        unset($this->principalFunds);
        unset($this->specificFunds);
    }
    public function render()
    {
        return view('livewire.accounting.funds-table');
    }
}
