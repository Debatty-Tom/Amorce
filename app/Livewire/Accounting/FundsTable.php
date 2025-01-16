<?php

namespace App\Livewire\Accounting;

use App\Models\Fund;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FundsTable extends Component
{
    #[Computed]
    public function principalFunds(){
        return DB::table('transaction_summary_view')->where('fund_type', 'principal')->get();

    }
    #[Computed]
    public function specificFunds(){
        return DB::table('transaction_summary_view')->where('fund_type', 'specific')->get();

    }

    public function render()
    {
        return view('livewire.accounting.funds-table');
    }
}
