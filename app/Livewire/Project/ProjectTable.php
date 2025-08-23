<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class ProjectTable extends Component
{
    public $project;

    public function mount($project)
    {
        $this->project = $project;
    }
    public function descriptionLimited()
    {
        return str::limit($this->project->description, 100);
    }

    public function render()
    {
        return view('livewire.project.project-table');
    }
}
