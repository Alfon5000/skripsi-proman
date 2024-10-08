<?php

namespace App\Livewire\ProjectTasks;

use App\Models\Event;
use App\Models\Task;
use App\Models\Status;
use App\Models\Project;
use Livewire\Component;
use App\Models\Priority;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Notifications\TaskAddedNotification;
use Illuminate\Support\Facades\Notification;

class Create extends Component
{
    public Project $project;

    #[Validate(['required', 'string', 'max:255'])]
    public string $title = '';

    #[Validate(['required', 'date'])]
    public $start_time;

    #[Validate(['required', 'date'])]
    public $end_time;

    #[Validate(['string'])]
    public string $worker_id = '';

    #[Validate(['required', 'string'])]
    public string $priority_id = '';

    #[Validate(['required', 'string'])]
    public string $description = '';

    public function render()
    {
        $priorities = Priority::get();
        $workers = $this->project->members()->orderBy('name')->get();

        return view('livewire.project-tasks.create', compact(['priorities', 'workers']));
    }

    public function mount(string $projectId)
    {
        $this->project = Project::find($projectId);
    }

    public function store()
    {
        $valdated = $this->validate();

        if (Auth::user()->role_id != 1 && $this->project->manager_id != Auth::id()) {
            $valdated['worker_id'] = Auth::id();
        }

        $valdated['project_id'] = $this->project->id;
        $valdated['status_id'] = 1;
        $task = Task::create($valdated);

        Event::create([
            'owner_id' => $task->worker_id,
            'title' => $task->title,
            'start_time' => $task->start_time,
            'end_time' => $task->end_time,
            'description' => $task->description,
            'color' => '#22c55e',
            'textColor' => '#ffffff',
        ]);

        Notification::send($this->project->members()->get(), new TaskAddedNotification($task));
        $this->dispatch('close-modal', 'add-task');
        $this->resetExcept('project');
        Session::flash('status', 'New task has been added');
        $this->redirect(route('project.tasks', ['project' => $this->project]), true);
    }
}
