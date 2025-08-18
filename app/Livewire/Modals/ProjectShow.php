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
            abort(403, __('amorce.message-permission-denied-delete-project') . '.');
        }
        $this->project->delete();

        $this->feedback = __('amorce.message-toast-success-delete-project');

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
