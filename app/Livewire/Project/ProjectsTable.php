<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProjectsTable extends Component
{
    #[computed]
    public function pendingProjects(): Collection
    {
        return Project::whereDoesntHave('draws')->get();
    }

    #[computed]
    public function nextDrawProjects(): Collection
    {
        return Project::whereHas('draws', function ($query) {
            $query->where('status', 'pending'); // Example condition
        })->get();
    }

    #[computed]
    public function fundedProjects(): Collection
    {
        return Project::whereHas('draws', function ($query) {
            $query->where('status', 'funded'); // Example condition
        })
            ->limit(20)
            ->orderBy('created_at')
            ->get();
    }
    public function render()
    {
        return view('livewire.project.projects-table');
    }
}
