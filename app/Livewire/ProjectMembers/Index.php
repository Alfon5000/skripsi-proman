<?php

namespace App\Livewire\ProjectMembers;

use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public Project $project;

    #[Url]
    public string $search = '';

    #[Url]
    public int $per_page = 0;

    #[On('refresh-members')]
    public function render()
    {
        $members = $this->project->members()->filter(['search' => $this->search])->orderBy('name')->paginate($this->per_page);

        return view('livewire.project-members.index', compact(['members']));
    }

    public function mount(string $projectId)
    {
        $this->project = Project::find($projectId);
    }
}
