<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Illuminate\Support\Str;
use Livewire\Component;

class TodosTable extends Component
{
    public $todos;
    public function mount()
    {
        $this->todos = Todo::all();

        foreach ($this->todos as $todo) {
            $todo->descriptionLimited = str::limit($todo->description, 100);
        }
        $this->todos->load('users');
    }
    public function render()
    {
        return view('livewire.todo.todos-table');
    }
}
