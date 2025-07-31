<?php

namespace App\Livewire\Todo;

use App\Models\Assignment;
use App\Models\Todo;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TodosTable extends Component
{
    use WithPagination;
    #[computed]
    public function todos()
    {
        return Todo::with(['assignments.assignedBy'])->orderBy('created_at', 'desc')->paginate(12);
    }

    #[on('refresh-todos')]
    public function refreshTodos()
    {
        return;
    }

    public function render()
    {
        return view('livewire.todo.todos-table');
    }
}
