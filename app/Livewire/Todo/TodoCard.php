<?php

namespace App\Livewire\Todo;

use Livewire\Component;

class TodoCard extends Component
{
    public $todo;
    public function mount($todo)
    {
        $this->todo = $todo;
    }
    public function render()
    {
        return view('livewire.todo.todo-card');
    }
}
