<?php

namespace App\Livewire\Modals;

use App\Enums\RolesEnum;
use App\Livewire\Forms\ProjectForm;
use App\Models\Project;
use App\Traits\DeleteModalTrait;
use Livewire\Component;

class ProjectShow extends Component
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
    public function deleteProject()
    {
        if (!auth()->user()->hasAnyRole(RolesEnum::PROJECTMANAGER->value, RolesEnum::ADMIN->value)) {
            abort(403, __('Vous n’avez pas la permission de supprimer des projets.'));
        }
        $this->project->delete();

        $this->feedback = __('Project deleted successfully');

        $this->dispatch('refresh-projects');
        $this->showDeleteModal = false;
        $this->dispatch('closeCardModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
    }
    public function render()
    {
        return view('livewire.modals.project-show');
    }
}
