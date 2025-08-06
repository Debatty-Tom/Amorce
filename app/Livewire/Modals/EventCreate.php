<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\EventForm;
use App\Models\Event;
use Illuminate\Support\Carbon;
use Livewire\Component;

class EventCreate extends Component
{
    public string $feedback;
    public EventForm $form;
    public function mount(Event $event, $date)
    {
        $this->form->setEvent($event);
        $this->form->date = Carbon::parse($date)->toDateString();
    }

    public function save()
    {
        $this->form->create();
        $this->feedback=__('Event created successfully');

        $this->dispatch('closeCardModal');
        $this->dispatch(event: 'openalert', params: ['message' => $this->feedback]);
        $this->dispatch(event: 'refresh-calendar');
    }
    public function render()
    {
        return view('livewire.modals.event-create');
    }
}
