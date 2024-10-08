<?php

namespace App\Livewire\ProjectTasks;

use App\Models\Priority;
use App\Models\Task;
use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component
{
    public Project $project;

    #[Url]
    public string $priority_id = '';

    #[Url]
    public string $search = '';

    #[On('refresh-tasks')]
    public function render()
    {
        $priorities = Priority::get();
        $all = Task::projectId($this->project->id)->get();
        $dones = Task::projectId($this->project->id)->statusId(4)->get();
        $tasks = Task::projectId($this->project->id)->filter([
            'search' => $this->search,
            'priority_id' => $this->priority_id,
        ])->get();

        return view('livewire.project-tasks.index', compact(['priorities', 'all', 'dones', 'tasks']));
    }

    public function mount(string $projectId)
    {
        $this->project = Project::find($projectId);
    }
}
