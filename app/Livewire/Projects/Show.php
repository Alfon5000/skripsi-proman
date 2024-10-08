<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public Project $project;

    public function render()
    {
        return view('livewire.projects.show');
    }

    #[On('open-details')]
    public function setProject(Project $project)
    {
        $this->project = $project;
        $this->dispatch('open-modal', 'project-details');
    }
}
