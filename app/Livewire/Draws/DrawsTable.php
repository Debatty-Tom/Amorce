<?php

namespace App\Livewire\Draws;

use App\Models\Draw;
use Brick\Money\Money;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class DrawsTable extends Component
{
    #[Computed]
    public function pendingDraws()
    {
        return Draw::with(['projects'])->orderBy('date')->get();
    }
    #[Computed]
        public function archivedDraws()
    {
        return Draw::onlyTrashed()->with(['projects'])->orderBy('date')->get();
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
