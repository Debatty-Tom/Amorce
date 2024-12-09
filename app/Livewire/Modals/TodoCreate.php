<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\TodoForm;
use App\Models\Todo;
use Livewire\Component;

class TodoCreate extends Component
{
    public $feedback = '';
    public TodoForm $form;
    public $loading;
    public Todo $todo;

    public function mount(Todo $todo)
    {
        $this->form->setTodo($todo);
        $this->todo = $todo;
    }

    public function save(){
        $this->form->create();
        $this->feedback='Todo created successfully';

        $this->dispatch('closeModal');

    }
    public function render()
    {
        return view('livewire.modals.todo-create');
    }
}
