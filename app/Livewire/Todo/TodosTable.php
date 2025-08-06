<?php

namespace App\Livewire\Todo;

use App\Models\Assignment;
use App\Models\Todo;
use App\Traits\HandleSortingTrait;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TodosTable extends Component
{
    use WithPagination, HandleSortingTrait;
    public $categories;
    public function mount()
    {
        $this->categories = [
            'title' => __('Name'),
            'description' => __('description'),
            'date' => __('Date'),
            'deleted_at' => __('Date d’archive'),
            'created_at' => __('Date de création'),
        ];
        $this->sorts = [
            'todo' => ['field' => 'title', 'direction' => 'asc'],
        ];

        $this->searches = [
            'todo' => '',
        ];
    }
    #[computed]
    public function todos()
    {
        return Todo::withTrashed()
            ->with(['assignments.assignedBy','users'])
            ->where('title', 'like', '%' . $this->getSearch('todo') . '%')
            ->orderBy($this->getSortField('todo'), $this->getSortDirection('todo'))
            ->paginate(12);
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
