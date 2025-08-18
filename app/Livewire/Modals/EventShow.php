<?php

namespace App\Livewire\Modals;

use App\Models\Event;
use Livewire\Component;
use Illuminate\Support\Carbon;

class EventShow extends Component
{
    public array $events = [];
    public string $title;

    public function mount(?array $ids = null, ?int $id = null, ?string $date = null)
    {
        if ($ids) {
            $this->events = Event::whereIn('id', $ids)->get()->toArray();
        } elseif ($id) {
            $this->events = Event::where('id', $id)->get()->toArray();
        }

        $this->title = __('amorce.misc-event-from') . ' ' . Carbon::parse($date)->format('d/m/Y');
    }


    public function render()
    {
        return view('livewire.modals.event-show');
    }
}
