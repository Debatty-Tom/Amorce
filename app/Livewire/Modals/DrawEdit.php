<?php

namespace App\Livewire\Modals;

use App\Enums\AttendancesStatuses;
use App\Enums\RolesEnum;
use App\Livewire\Forms\DrawForm;
use App\Models\Draw;
use App\Models\Fund;
use App\Models\Project;
use App\Models\Transaction;
use App\Models\TransactionSummaryView;
use App\Traits\HandlesDonators;
use App\Traits\HandlesNumbers;
use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Livewire\Attributes\Computed;
use Livewire\Component;

class DrawEdit extends Component
{
    use HandlesNumbers, HandlesDonators;

    public $draw;
    public $projects;
    public DrawForm $form;
    public $amount;
    public string $feedback;
    public $lockedDonators;
    public array $participantsToDelete = [];
    public $selectedProjects = [];

    public function mount(Draw $draw)
    {
        $this->form->setDraw($draw);
        $this->draw = $draw;
        $this->draw->load('donators');
        $this->draw->load('projects');

        $this->projects = Project::whereDoesntHave('draws')->get();
        $this->selectedProjects = $this->draw->projects->pluck('id')->toArray();
    }

    public function removeParticipant($id): void
    {
        if (count($this->participantsToDelete) < 3) {
            $this->form->new_participants = $this->form->new_participants
                ->reject(fn($donator) => $donator->id === $id)
                ->values();

            $this->participantsToDelete[] = $id;

            $this->addNewParticipant();
        } else {
            $this->dispatch('openalert', message: 'You can only remove 3 participants at a time');
        }
    }

    public function addNewParticipant()
    {
        $this->randomParticipants(limit: 1, excludedIds: $this->getExcludedIds($this->draw));
    }

    public function handleAmountEdit()
    {
        $newAmount = Money::ofMinor($this->form->amount, 'EUR');
        $transactionAmount = Money::ofMinor($this->draw->amount, 'EUR')->minus($newAmount)->getAmount();
        $transactionAmount = $transactionAmount->toScale(2, RoundingMode::DOWN)->multipliedBy(100)->toInt();
        Transaction::create([
            'fund_id' => $this->generalFund->id,
            'amount' => $transactionAmount,
            'date' => now(),
            'description' => 'Modification du budget de la détente du ' . $this->draw->date->format('d/m/Y'),
            'hash' => md5(json_encode('draw edited')),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function handleParticipantsEdit()
    {
        if ($this->form->new_participants) {
            $oldParticipants = $this->draw->donators()->orderBy('created_at')->take(9)->get()->slice(6, 3);
            $currentParticipantsIds = $oldParticipants->pluck('id')->toArray();

            $newParticipantsIds = collect($this->form->new_participants)
                ->pluck('id')
                ->toArray();;

            $participantsToDetach = $this->participantsToDelete;

            $participantsToAttach = array_diff($newParticipantsIds, $currentParticipantsIds);

            if (!empty($participantsToDetach)) {
                $this->draw->donators()->detach($participantsToDetach);
            }

            if (!empty($participantsToAttach)) {
                $attachData = collect($participantsToAttach)->mapWithKeys(function ($userId) {
                    return [
                        $userId => [
                            'contact' => null,
                            'status' => AttendancesStatuses::Pending->value,
                            'created_at' => now(),
                            'updated_at' => now()
                        ],
                    ];
                })->toArray();

                $this->draw->donators()->attach($attachData);
            }
        }
    }

    public function handleProjectsEdit()
    {
        $currentProjectIds = array_map('intval', $this->draw->projects->pluck('id')->toArray());

        $newProjectIds = array_map('intval', $this->selectedProjects);

        $projectsToDetach = array_diff($currentProjectIds, $newProjectIds);

        $projectsToAttach = array_diff($newProjectIds, $currentProjectIds);


        if (!empty($projectsToDetach)) {
            $this->draw->projects()->detach($projectsToDetach);
        }

        if (!empty($projectsToAttach)) {
            $attachData = collect($projectsToAttach)->mapWithKeys(function ($projectId) {
                return [
                    $projectId => [
                        'status' => 'pending',
                        'amount' => 0,
                        'created_at' => now(),
                        'updated_at' => now()
                    ],
                ];
            })->toArray();

            $this->draw->projects()->attach($attachData);
        }
    }

    public function save()
    {
        if (!auth()->user()->hasAnyRole(RolesEnum::DRAWMANAGER->value, RolesEnum::ADMIN->value)) {
            abort(403, 'Vous n’avez pas la permission d’ajouter ou modifier une détente.');
        }

        $this->form->amount = $this->normalizeNumber($this->form->amount);

        $this->form->update();

        $this->handleAmountEdit();

        $this->handleParticipantsEdit();

        $this->handleProjectsEdit();

        $this->feedback = 'Draw edited successfully';

        $this->dispatch('closeModal');
        $this->dispatch('openalert', message: $this->feedback);
        $this->dispatch('refresh-draw');
    }


    public function render()
    {
        return view('livewire.modals.draw-edit');
    }
}
