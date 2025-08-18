<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\TodoForm;
use App\Models\Todo;
use App\Traits\DeleteModalTrait;
use Livewire\Component;

class TodoShow extends Component
{
    use DeleteModalTrait;
    public TodoForm $form;
    public $project;
    public $feedback = '';
    public $todo;

    public function mount($id)
    {
        $this->todo = Todo::with(['assignments.assignedBy', 'users'])->withTrashed()->find($id);
        $this->form->setTodo($this->todo);
    }
    public function deleteTodo()
    {
        if(!(auth()->user()->hasRole(\App\Enums\RolesEnum::ADMIN->value) || auth()->id() === $this->todo->assignments[0]->assignedBy->id) && $this->todo->trashed()) {
            abort(403, __('amorce.message-permission-denied-delete-todo') . '.');
        }
        $this->todo->delete();

        $this->feedback = __('amorce.message-toast-success-delete-todo');

        $this->dispatch('refresh-todos');
        $this->showDeleteModal = false;
        $this->dispatch('closeCardModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
    }
    public function render()
    {
        return view('livewire.modals.todo-show');
    }
}
