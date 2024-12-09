<?php

namespace App\Livewire\Accounting;

use App\Models\Fund;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FundsTable extends Component
{
    public $principalFunds;
    public $specificFunds;
    public function mount()
    {
        $this->principalFunds = DB::table('transaction_summary_view')->where('fund_type', 'principal')->get();
        $this->specificFunds = DB::table('transaction_summary_view')->where('fund_type', 'specific')->get();
    }

    public function render()
    {
        return view('livewire.accounting.funds-table');
    }
}
