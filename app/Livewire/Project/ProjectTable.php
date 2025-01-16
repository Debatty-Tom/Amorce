<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Support\Str;
use Livewire\Component;

class ProjectTable extends Component
{
    public Project $project;

    public function mount($project)
    {
        $this->project = $project;

        $project->descriptionLimited = str::limit($project->description, 100);
    }

    public function render()
    {
        return view('livewire.project.project-table');
    }
}
