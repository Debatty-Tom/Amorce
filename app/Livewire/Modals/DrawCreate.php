<?php

namespace App\Livewire\Modals;

use App\Enums\AttendancesStatuses;
use App\Livewire\Forms\DrawForm;
use App\Models\Donator;
use App\Models\Draw;
use App\Models\Project;
use App\Traits\HandlesNumbers;
use Illuminate\Support\Collection;
use Livewire\Component;
use function Pest\Laravel\get;

class DrawCreate extends Component
{
    use HandlesNumbers;
    public $feedback = '';
    public DrawForm $form;
    public $loading;
    public $draw;
    public $projects;
    public $selectedProjects = [];
    public $lastDraw;
    public Collection $oldParticipants;

    public function mount(Draw $draw)
    {
        $this->form->setDraw($draw);
        $this->draw = $draw;

        $this->projects = Project::whereDoesntHave('draws')->get();
    }
    public function loadOldParticipants()
    {
        $this->lastDraw = Draw::with('donators')->latest('date')->first();

        $this->oldParticipants = $this->lastDraw
            ? $this->lastDraw->donators()->orderBy('created_at')->take(9)->get()->slice(3, 6)
            : collect();
    }


    public function save()
    {
        $this->loadOldParticipants();

        $this->form->amount = $this->normalizeNumber($this->form->amount);
        $this->draw = $this->form->create();
        $this->feedback = 'Draw created successfully';

        $this->draw->donators()->attach(
            $this->oldParticipants, [
                'contact' => null,
                'status' => AttendancesStatuses::Validated->value,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
        foreach ($this->form->new_participants as $participant) {
            $participantContact = $this->getDonatorContact($participant);
            $this->draw->donators()->attach($participant, [
                'contact' => $participantContact,
                'status' => AttendancesStatuses::Pending->value,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        $this->draw->projects()->attach(
            $this->selectedProjects, [
                'status' => 'pending',
                'amount' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        $this->feedback='Draw created successfully';

        $this->dispatch('closeModal');
        $this->dispatch('openalert', message: $this->feedback);
        $this->dispatch('refresh-draws');
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

    public function randomParticipants()
    {
        $this->form->new_participants = Donator::inRandomOrder()->limit(3)->get();
    }

    public function render()
    {
        return view('livewire.modals.draw-create');
    }
}
