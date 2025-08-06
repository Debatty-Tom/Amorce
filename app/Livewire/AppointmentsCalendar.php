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
        if (str_contains($eventId, 'draw')) {
            $drawId = str_replace('draw-', '', $eventId);
            redirect(route('draw.show', ['id' => $drawId]));
        } else {
            $event = Event::findOrFail(str_replace('event-', '', $eventId));
            $this->dispatch('openCardModal', component: 'modals.event-show', params: [
                'id' => $event->id,
                'date' => $event->date->format('Y-m-d'),
            ]);
        }
    }

    public function onEventDropped($eventId, $year, $month, $day)
    {
        dd($eventId, $year, $month, $day);
    }
}
