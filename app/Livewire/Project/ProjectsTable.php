<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
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
            $query->where('status', 'pending');
        })->get();
    }

    #[computed]
    public function fundedProjects(): Collection
    {
        return Project::whereHas('draws', function ($query) {
            $query->where('status', 'funded');
        })
            ->limit(20)
            ->orderBy('created_at')
            ->get();
    }
    #[on('refresh-projects')]
    public function refreshProjects()
    {
        return;
    }
    public function render()
    {
        return view('livewire.project.projects-table');
    }
}
