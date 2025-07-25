<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ProjectForm;
use App\Models\Project;
use Livewire\Component;

class ProjectEdit extends Component
{
    public ProjectForm $form;
    public $project;
    public $feedback = '';
    public function mount(Project $project)
    {
        $this->form->setProject($project);
        $this->project = Project::find($project['id']);
    }
    public function save(){
        $this->form->update();
        $this->feedback='Project updated successfully';

        $this->dispatch('closeCardModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
        $this->dispatch('refresh-projects');

    }
    public function render()
    {
        return view('livewire.modals.project-edit');
    }
}
