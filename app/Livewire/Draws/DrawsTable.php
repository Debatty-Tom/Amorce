<?php

namespace App\Livewire\Draws;

use App\Models\Draw;
use App\Traits\HandleSortingTrait;
use Brick\Money\Money;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class DrawsTable extends Component
{
    use WithPagination, HandleSortingTrait;
    public $categories = [
        'title' => 'Titre',
        'description' => 'Description',
        'amount' => 'Montant',
        'date' => 'Date',
        'created_at' => 'Date de création',
    ];
    public function mount()
    {
        $this->sorts = [
            'pending' => ['field' => 'date', 'direction' => 'asc'],
            'archived' => ['field' => 'date', 'direction' => 'asc'],
        ];

        $this->searches = [
            'pending' => '',
            'archived' => '',
        ];
    }
    #[Computed]
    public function pendingDraws()
    {
        return Draw::with(['projects'])->where('title', 'like', '%' . $this->getSearch('pending') . '%')->orderBy($this->getSortField('pending'), $this->getSortDirection('pending'))->paginate(4, pageName: 'pendingDrawsPage');
    }
    #[Computed]
        public function archivedDraws()
    {
        return Draw::onlyTrashed()->with(['projects'])->where('title', 'like', '%' . $this->getSearch('archived') . '%')->orderBy($this->getSortField('archived'), $this->getSortDirection('archived'))->paginate(8, pageName: 'archivedDrawsPage');
    }
    #[computed]
    public function amount($draw)
    {
        $sum = $draw->projects->sum(function ($project) {
            return $project->pivot->amount;
        });

        if ($sum === 0) {
            return Money::ofMinor($draw->amount, 'EUR')->formatTo('fr_BE');
        } else {
            $totalAssigned = $sum;
            $remaining = Money::ofMinor($draw->amount, 'EUR')->plus(Money::of($totalAssigned, 'EUR'));
            return $remaining->formatTo('fr_BE');
        }
    }
    #[On('refresh-draws')]
    public function refreshDraws(): void
    {
        return;
    }
    public function render()
    {
        return view('livewire.draws.draws-table');
    }
}
