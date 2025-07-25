<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ProjectForm;
use App\Models\Project;
use App\Traits\DeleteModalTrait;
use Livewire\Component;

class ProjectEdit extends Component
{
    use DeleteModalTrait;
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
    public function deleteProject()
    {
        $this->project->delete();

        $this->feedback='Project deleted successfully';

        $this->dispatch('refresh-projects');
        $this->showDeleteModal = false;
        $this->dispatch('closeCardModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
    }
    public function render()
    {
        return view('livewire.modals.project-edit');
    }
}
