<?php

namespace App\Livewire\Accounting;

use App\Models\Fund;
use App\Models\TransactionSummaryView;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class FundsTable extends Component
{
    use WithPagination;
    #[Computed]
    public function principalFunds()
    {
        return DB::table('transaction_summary_view')->whereNull('deleted_at')->where('fund_type', 'principal')->paginate(4, pageName: 'principal');
    }

    #[Computed]
    public function specificFunds()
    {
        return DB::table('transaction_summary_view')->whereNull('deleted_at')->where('fund_type', 'specific')->paginate(4, pageName: 'specific');
    }

    #[Computed]
    public function archivedFunds()
    {
        return DB::table('transaction_summary_view')->whereNotNull('deleted_at')->paginate(4, pageName: 'archived');
    }


    public function render()
    {
        return view('livewire.accounting.funds-table');
    }
}
