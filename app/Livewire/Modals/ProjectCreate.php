<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ProjectForm;
use App\Models\Project;
use Livewire\Component;

class ProjectCreate extends Component
{
    public $feedback = '';
    public ProjectForm $form;
    public Project $project;

    public function save(){

        $this->form->create();
        $this->feedback='Project created successfully';

        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.modals.project-create');
    }
}
