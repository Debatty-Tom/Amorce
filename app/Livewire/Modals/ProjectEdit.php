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
            abort(403, __('Vous n’avez pas la permission d’ajouter ou modifier des projets.'));
        }
        $this->form->update();
        $this->feedback = __('Project updated successfully');

        $this->dispatch('closeModal');
        $this->dispatch(event:'openalert', params:['message' => $this->feedback]);
        $this->dispatch('refresh-projects');
    }

    public function render()
    {
        return view('livewire.modals.project-edit');
    }
}
