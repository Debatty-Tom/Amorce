<?php

namespace App\Livewire\Modals;

use App\Enums\RolesEnum;
use App\Livewire\Forms\ProjectForm;
use App\Models\Project;
use Livewire\Component;

class ProjectCreate extends Component
{
    public $feedback = '';
    public ProjectForm $form;
    public Project $project;

    public function save(){
        if (!auth()->user()->hasAnyRole(RolesEnum::PROJECTMANAGER->value, RolesEnum::ADMIN->value)) {
            abort(403, __('Vous n’avez pas la permission d’ajouter ou modifier des projets.'));
        }

        $this->form->create();
        $this->feedback='Project created successfully';

        $this->dispatch('closeModal');
        $this->dispatch(event: 'openalert', params: ['message' => $this->feedback]);
        $this->dispatch('refresh-projects');
    }

    public function render()
    {
        return view('livewire.modals.project-create');
    }
}
