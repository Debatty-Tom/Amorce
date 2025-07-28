<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\TodoForm;
use App\Models\Todo;
use App\Models\User;
use Livewire\Component;

class TodoCreate extends Component
{
    public $feedback = '';
    public TodoForm $form;
    public $loading;
    public Todo $todo;
    public $users;
    public $selectedUsers = [];


    public function mount(Todo $todo)
    {
        $this->form->setTodo($todo);
        $this->todo = $todo;

        $this->users = User::all();
    }

    public function save()
    {
        $this->todo = $this->form->create();

        $this->todo->users()->attach($this->selectedUsers, ['assigned_by' => auth()->id(), 'created_at' => now(), 'updated_at' => now()]);

        $this->feedback = 'Todo created successfully';

        $this->dispatch('closeModal');
        $this->dispatch('refresh-todos');
    }

    public function render()
    {
        return view('livewire.modals.todo-create');
    }
}
