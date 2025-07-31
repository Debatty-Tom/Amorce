<?php

namespace App\Livewire\Accounting;

use App\Models\Fund;
use App\Models\TransactionSummaryView;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FundsTable extends Component
{
    #[Computed]
    public function principalFunds()
    {
        return DB::table('transaction_summary_view')->whereNull('deleted_at')->where('fund_type', 'principal')->get();
    }

    #[Computed]
    public function specificFunds()
    {
        return DB::table('transaction_summary_view')->whereNull('deleted_at')->where('fund_type', 'specific')->get();
    }

    #[Computed]
    public function archivedFunds()
    {
        return DB::table('transaction_summary_view')->whereNotNull('deleted_at')->get();
    }


    public function render()
    {
        return view('livewire.accounting.funds-table');
    }
}
