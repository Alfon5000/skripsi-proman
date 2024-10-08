<?php

namespace App\Livewire\ProjectTasks;

use App\Models\Task;
use App\Models\Event;
use App\Models\Status;
use App\Models\Project;
use Livewire\Component;
use App\Models\Priority;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;

class Edit extends Component
{
    public Project $project;

    public Task $task;

    public Task $oldTask;

    #[Validate(['required', 'string', 'max:255'])]
    public string $title = '';

    #[Validate(['required', 'string'])]
    public string $worker_id = '';

    #[Validate(['required', 'date'])]
    public $start_time;

    #[Validate(['required', 'date'])]
    public $end_time;

    #[Validate(['required', 'string'])]
    public string $priority_id = '';

    #[Validate(['required', 'string'])]
    public string $description = '';

    public function render()
    {
        $priorities = Priority::get();
        $statuses = Status::get();

        return view('livewire.project-tasks.edit', compact(['priorities']));
    }

    #[On('open-edit')]
    public function setTask(Task $task)
    {
        $this->project = Project::find($task->project_id);
        $this->task = $task;
        $this->oldTask = $task;
        $this->title = $task->title;
        $this->worker_id = $task->worker_id;
        $this->start_time = $task->start_time->format('Y-m-d H:i');
        $this->end_time = $task->end_time->format('Y-m-d H:i');
        $this->priority_id = $task->priority_id;
        $this->description = $task->description;
        $this->dispatch('open-modal', 'edit-task');
    }

    public function update()
    {
        $validated = $this->validate();
        $this->task->update($validated);

        $event = Event::where('owner_id', $this->oldTask->worker_id)->where('title', $this->oldTask->title)->where('start_time', $this->oldTask->start_time)->where('end_time', $this->oldTask->end_time)->where('description', $this->oldTask->description)->first();

        if ($this->task->worker_id == $this->oldTask->worker_id) {
            $event->update([
                'title' => $this->task->title,
                'start_time' => $this->task->start_time,
                'end_time' => $this->task->end_time,
                'description' => $this->task->description,
            ]);
        } else {
            $event->delete();

            Event::create([
                'owner_id' => $this->task->worker_id,
                'title' => $this->task->title,
                'start_time' => $this->task->start_time,
                'end_time' => $this->task->end_time,
                'description' => $this->task->description,
                'color' => '#22c55e',
                'textColor' => '#ffffff',
            ]);
        }

        $this->dispatch('close-modal', 'edit-task');
        $this->resetExcept('project');
        Session::flash('status', 'The task has been updated');
        $this->redirect(route('project.tasks', ['project' => $this->project]), true);
    }
}
