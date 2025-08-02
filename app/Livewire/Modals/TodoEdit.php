<?php

namespace App\Livewire\Modals;

use App\Enums\RolesEnum;
use App\Livewire\Forms\TodoForm;
use App\Models\Todo;
use App\Models\User;
use Livewire\Component;

class TodoEdit extends Component
{
    public TodoForm $form;
    public $todo;
    public $feedback = '';
    public $users;
    public $selectedUsers = [];

    public function mount($id)
    {
        $this->todo = Todo::with(['assignments.assignedBy'])->find($id);
        $this->form->setTodo($this->todo);
        $this->selectedUsers = $this->todo->users->pluck('id')->toArray();
        $this->dispatch('closeCardModal');
        $this->users = User::all();
    }

    public function save()
    {
        if(!auth()->user()->hasRole(RolesEnum::ADMIN->value) || auth()->id() !== $this->todo->assignments[0]->assignedBy->id && $this->todo->trashed()) {
            abort(403, 'Vous n’avez pas la permission de modifier cette tâche.');
        }
        $this->form->update();

        $currentUserIds = $this->todo->users->pluck('id')->toArray();

        $newUserIds = $this->selectedUsers;

        $usersToDetach = array_diff($currentUserIds, $newUserIds);

        $usersToAttach = array_diff($newUserIds, $currentUserIds);

        if (!empty($usersToDetach)) {
            $this->todo->users()->detach($usersToDetach);
        }

        if (!empty($usersToAttach)) {
            $attachData = collect($usersToAttach)->mapWithKeys(function ($userId) {
                return [
                    $userId => [
                        'assigned_by' => auth()->id(),
                        'updated_at' => now(),
                        'created_at' => now(),
                    ],
                ];
            })->toArray();

            $this->todo->users()->attach($attachData);
        }


        $this->feedback = 'todo updated successfully';

        $this->dispatch('closeModal');
        $this->dispatch(event: 'openalert', params: ['message' => $this->feedback]);
        $this->dispatch('refresh-todos');
    }

    public function render()
    {
        return view('livewire.modals.todo-edit');
    }
}
