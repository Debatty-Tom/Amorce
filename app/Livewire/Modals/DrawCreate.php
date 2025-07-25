<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\DrawForm;
use App\Models\Donator;
use App\Models\Draw;
use App\Models\Project;
use Livewire\Component;
use function Pest\Laravel\get;

class DrawCreate extends Component
{
    public $feedback = '';
    public DrawForm $form;
    public $loading;
    public $draw;
    public $projects;
    public $selectedProjects = [];

    public function mount(Draw $draw)
    {
        $this->form->setDraw($draw);
        $this->draw = $draw;

        $this->projects = Project::whereDoesntHave('draws')->get();
    }

    public function normalizeNumber($input)
    {
        if (str_contains($input, '.') !== false) {
            return str_replace('.', '', $input);
        } else {
            return $input * 100;
        }
    }

    public function save()
    {
        $this->form->amount = $this->normalizeNumber($this->form->amount);
        $this->draw = $this->form->create();
        $this->feedback = 'Draw created successfully';
        foreach ($this->form->new_participants as $participant) {
            $participantContact = $this->getDonatorContact($participant);
            $this->draw->donators()->attach($participant, ['contact' => $participantContact, 'status' => 'pending']);
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
