<?php

namespace App\Livewire\Todo;

use App\Models\Assignment;
use App\Models\Todo;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Component;

class TodosTable extends Component
{
    #[computed]
    public function todos()
    {
        return Todo::with(['assignments.assignedBy'])->get();
    }

    public function refreshTodos()
    {
        return;
    }

    public function render()
    {
        return view('livewire.todo.todos-table');
    }
}
