<?php

namespace App\Livewire\Forms;

use App\Models\Donator;
use App\Models\Draw;
use App\Models\Event;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EventForm extends Form
{
    public Event $event;
    #[Validate]
    public $title;
    #[Validate]
    public $description;
    #[Validate]
    public $date;

    public function setEvent($event)
    {
        $this->event = $event;

        $this->title = $event->title;
        $this->description = $event->description;
        $this->date = Carbon::parse($event->date)->format('Y-m-d');
    }
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'description' => ['max:255', 'nullable'],
            'date' => ['required', 'date'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->event->update($this->except('draw'));
    }

    public function create()
    {
        $this->validate();

        return Event::create($this->validate());
    }
}
