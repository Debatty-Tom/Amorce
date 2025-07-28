<?php

namespace App\Livewire\Modals;

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

    public function mount(Todo $todo)
    {
        $this->form->setTodo($todo);
        $this->todo = Todo::with(['assignments.assignedBy'])->find($todo['id']);
        $this->dispatch('closeCardModal');
        $this->users = User::all();
    }

    public function save()
    {
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
