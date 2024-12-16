<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Livewire\Component;

class TodosTable extends Component
{
    public $todos;
    public function mount()
    {
        $this->todos = Todo::all();

        $this->todos->load('users');
    }
    public function render()
    {
        return view('livewire.todo.todos-table');
    }
}
