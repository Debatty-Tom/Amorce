<?php

namespace App\Livewire\Modals;

use App\Enums\AttendancesStatuses;
use App\Enums\RolesEnum;
use App\Livewire\Forms\DrawForm;
use App\Models\Donator;
use App\Models\Draw;
use App\Models\Project;
use App\Models\Transaction;
use App\Traits\HandlesDonators;
use App\Traits\HandlesNumbers;
use Illuminate\Support\Collection;
use Livewire\Component;
use function Pest\Laravel\get;

class DrawCreate extends Component
{
    use HandlesNumbers, HandlesDonators;
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

        $this->randomButton = true;
        $this->projects = Project::whereDoesntHave('draws')->get();
        $this->lastDraw = Draw::with('donators')->latest('date')->first();
    }
    public function loadOldParticipants()
    {
        $this->oldParticipants = $this->lastDraw
            ? $this->lastDraw->donators()->orderBy('created_at')->take(9)->get()->slice(3, 6)
            : collect();
    }

    public function addNewParticipants()
    {
        $this->randomParticipants(excludedIds: $this->getExcludedIds($this->lastDraw));
        $this->randomButton = false;
    }


    public function save()
    {
        if (!auth()->user()->hasAnyRole(RolesEnum::DRAWMANAGER->value, RolesEnum::ADMIN->value)) {
            abort(403, 'Vous n’avez pas la permission d’ajouter ou modifier des détentes.');
        }
        $this->loadOldParticipants();

        $this->form->amount = $this->normalizeNumber($this->form->amount);
        $this->draw = $this->form->create();
        $this->feedback = 'Draw created successfully';

        Transaction::create([
            'fund_id' => $this->generalFund->id,
            'amount' => - $this->form->amount,
            'date' => now(),
            'title' => 'Assignation du budget de la détente du ' . $this->draw->date->format('d/m/Y'),
            'description' => 'Assignation du budget de la détente du ' . $this->draw->date->format('d/m/Y'),
            'hash' => md5(json_encode('draw credited')),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

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

    public function render()
    {
        return view('livewire.modals.draw-create');
    }
}
