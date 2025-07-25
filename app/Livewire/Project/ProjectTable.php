<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class ProjectTable extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }
    #[computed]
    public function project()
    {
        return Project::findOrFail($this->id);
    }
    #[computed]
    public function descriptionLimited()
    {
        return str::limit($this->project->description, 100);
    }
    #[on('refresh-project')]
    public function refreshProject()
    {
        return;
    }

    public function render()
    {
        return view('livewire.project.project-table');
    }
}
