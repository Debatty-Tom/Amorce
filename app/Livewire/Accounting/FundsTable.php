<?php

namespace App\Livewire\Accounting;

use App\Models\Fund;
use App\Models\TransactionSummaryView;
use App\Traits\HandleSortingTrait;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class FundsTable extends Component
{
    use WithPagination,HandleSortingTrait;
    public $categories = [
        'fund_title' => 'Name',
        'fund_description' => 'description',
        'total_amount' => 'Montant',
    ];
    public function mount()
    {
        $this->sorts = [
            'principal' => ['field' => 'fund_title', 'direction' => 'asc'],
            'specific' => ['field' => 'fund_title', 'direction' => 'asc'],
            'archived' => ['field' => 'fund_title', 'direction' => 'asc'],
        ];

        $this->searches = [
            'principal' => '',
            'specific' => '',
            'archived' => '',
        ];
    }
    #[Computed]
    public function principalFunds()
    {
        return DB::table('transaction_summary_view')->whereNull('deleted_at')->where('fund_type', 'principal')->where('fund_title', 'like', '%' . $this->getSearch('principal') . '%')->orderBy($this->getSortField('principal'), $this->getSortDirection('principal'))->paginate(4, pageName: 'principal');
    }

    #[Computed]
    public function specificFunds()
    {
        return DB::table('transaction_summary_view')->whereNull('deleted_at')->where('fund_type', 'specific')->where('fund_title', 'like', '%' . $this->getSearch('specific') . '%')->orderBy($this->getSortField('specific'), $this->getSortDirection('specific'))->paginate(4, pageName: 'specific');
    }

    #[Computed]
    public function archivedFunds()
    {
        return DB::table('transaction_summary_view')->whereNotNull('deleted_at')->where('fund_title', 'like', '%' . $this->getSearch('archived') . '%')->orderBy($this->getSortField('archived'), $this->getSortDirection('archived'))->paginate(4, pageName: 'archived');
    }
    #[on('refresh-funds')]
    public function refreshFunds(): void
    {
        return;
    }

    public function render()
    {
        return view('livewire.accounting.funds-table');
    }
}
