<?php

namespace App\Livewire\Modals;

use App\Enums\RolesEnum;
use App\Livewire\Forms\ProjectForm;
use App\Models\Project;
use App\Traits\DeleteModalTrait;
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
        $this->dispatch('closeCardModal');
    }
    public function save(){
        if (!auth()->user()->hasAnyRole(RolesEnum::PROJECTMANAGER->value, RolesEnum::ADMIN->value)) {
            abort(403, __('amorce.message-permission-denied-edit-project') . '.');
        }
        $this->form->update();
        $this->feedback = __('amorce.message-toast-success-edit-project');

        $this->dispatch('closeModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
        $this->dispatch('refresh-projects');
    }

    public function render()
    {
        return view('livewire.modals.project-edit');
    }
}
