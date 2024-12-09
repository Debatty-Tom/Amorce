<?php

namespace App\Livewire\Forms;

use App\Models\Todo;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TodoForm extends Form
{
    public Todo $todo;
    #[Validate]
    public $title;
    #[Validate]
    public $description;
    #[Validate]
    public $date;

    public function setTodo($draw)
    {
        $this->title = $draw->title;
        $this->description = $draw->description;
        $this->date = $draw->date;
    }
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:100','nullable'],
            'description' => ['max:255', 'nullable'],
            'date' => ['required', 'date', 'nullable'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->todo->update($this->except('todo'));
    }

    public function create()
    {
        $this->validate();

        Todo::create($this->validate());
    }
}
