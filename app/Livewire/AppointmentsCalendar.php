<?php

namespace App\Livewire;

use App\Models\Draw;
use App\Models\Event;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Omnia\LivewireCalendar\LivewireCalendar;

class AppointmentsCalendar extends LivewireCalendar
{
    public $dayEvents;
    #[computed]
    public function events(): \Illuminate\Support\Collection
    {
        $events = Event::all()->map(function ($event) {
            return [
                'id' => 'event-' . $event->id,
                'title' => $event->title,
                'description' => '',
                'date' => $event->date,
            ];
        });

        $draws = Draw::all()->map(function ($draw) {
            return [
                'id' => 'draw-' . $draw->id,
                'title' => 'Détente',
                'description' => '',
                'date' => $draw->date,
            ];
        });

        return $events->merge($draws);
    }
    #[on('refresh-calendar')]
    public function refreshCalendar()
    {
        return;
    }

    public function getDayEvents($date)
    {
        return Event::whereDate('date', $date)
            ->get();
    }

    public function onDayClick($year, $month, $day)
    {
        $date = Carbon::create($year, $month, $day);
        $this->dayEvents = $this->getDayEvents($date);
        if ($this->dayEvents->isEmpty()) {
            $this->dispatch('openCardModal', component: 'modals.event-create', params: [
                'date' => $date,
            ]);
        } else {
            $this->dispatch('openCardModal', component: 'modals.event-show', params: [
                'ids' => $this->dayEvents->pluck('id'),
                'date' => $date,
            ]);
        }
    }

    public function onEventClick($eventId)
    {
        // This event is triggered when an event card is clicked
        // You will be given the event id that was clicked
    }

    public function onEventDropped($eventId, $year, $month, $day)
    {
        dd($eventId, $year, $month, $day);
    }
}
