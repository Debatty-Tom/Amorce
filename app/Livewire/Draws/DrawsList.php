<?php

namespace App\Livewire\Draws;

use App\Models\Draw;
use Brick\Money\Money;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class DrawsList extends Component
{
    public Draw $draw;

    public function mount($draw): void
    {
        $this->draw = $draw;
    }

    #[Computed]
    public function amount(): string
    {
        $sum = $this->draw->projects->sum(function ($project) {
            return $project->pivot->amount;
        });

        if ($sum === 0) {
            return Money::ofMinor($this->draw->amount, 'EUR')->formatTo('fr_BE');
        } else {
            $totalAssigned = $sum;
            $remaining = Money::ofMinor($this->draw->amount, 'EUR')->plus(Money::of($totalAssigned, 'EUR'));
            return $remaining->formatTo('fr_BE');
        }
    }

    #[On('refresh-draws')]
    public function refreshDraws(): void
    {
        $this->draw->refresh();
    }

    public function render()
    {
        return view('livewire.draws.draws-list');
    }
}
