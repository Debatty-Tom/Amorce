<?php

namespace App\Livewire\Forms;

use App\Models\Project;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProjectForm extends Form
{
    public Project $project;
    #[Validate]
    public $title;
    #[Validate]
    public $description;
    #[Validate]
    public $email;

    public function setProject($project)
    {
        $this->project = $project;

        $this->title = $project->title;
        $this->description = $project->description;
        $this->email = $project->email;
    }
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:100','nullable'],
            'description' => ['max:255', 'nullable'],
            'email' => ['required', 'email'],
        ];
    }

    public function update()
    {
        $this->validate();

        $this->project->update($this->except('draw'));
    }

    public function create()
    {
        $this->validate();

        return Project::create($this->validate());
    }
}
