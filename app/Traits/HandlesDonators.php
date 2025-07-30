<?php

namespace App\Traits;

use App\Models\Donator;
use App\Models\Fund;
use App\Models\TransactionSummaryView;
use Livewire\Attributes\Computed;

trait HandlesDonators
{
    public $generalFund;
    public $randomButton = false;

    public function getGeneralFund()
    {
        $this->generalFund = Fund::where('title', 'Général')->firstOrFail();
    }

    public function getDonatorContact($participant): string
    {
        if ($participant->email === null) {
            if ($participant->phone === null) {
                return $participant->address;
            } else {
                return $participant->phone;
            }
        }
        return $participant->email;
    }

    #[Computed]
    public function sourceFundView(): TransactionSummaryView
    {
        $this->getGeneralFund();
        return TransactionSummaryView::where('fund_id', $this->generalFund->id)->firstOrFail();
    }

    #[Computed]
    public function rangeMax(): float
    {
        return ($this->sourceFundView->total_amount / 100) + ($this->draw->amount !== 0 ? $this->draw->amount / 100 : 0);
    }

    public function getExcludedIds($draw): array
    {
        return $draw->donators->pluck('id')->toArray();
    }
    public function randomParticipants($limit = 3, $excludedIds = []): void
    {
        if (!empty($excludedIds)) {
            $newParticipants = Donator::inRandomOrder()
                ->whereNotIn('id', $excludedIds)
                ->limit($limit)
                ->get();

            $this->form->new_participants = collect($this->form->new_participants)
                ->merge($newParticipants)
                ->unique('id')
                ->values();
        }
    }
}
