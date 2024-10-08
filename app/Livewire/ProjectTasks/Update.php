<?php

namespace App\Livewire\ProjectTasks;

use App\Models\Task;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskStatusUpdatedNotification;

class Update extends Component
{
    public Project $project;

    public Task $task;

    public string $statusId = '';

    public bool $can = false;

    public function render()
    {
        return view('livewire.project-tasks.update');
    }

    public function mount(string $projectId)
    {
        $this->project = Project::find($projectId);
    }

    #[On('update-status')]
    public function setTask($id, $statusId)
    {
        $this->task = Task::find($id);
        $this->statusId = $statusId;

        $progressWorker = Task::projectId($this->project->id)->statusId(2)->workerId($this->task->worker_id)->get()->count();
        $progressTasks = Task::projectId($this->project->id)->statusId(2)->get()->count();
        $members = $this->project->members()->get()->count();

        if ($progressWorker < 1) {
            if ($progressTasks < $members) {
                $this->can = true;
            } elseif ($progressTasks == $members && $statusId != 2) {
                $this->can = true;
            } else {
                $this->can = false;
            }
        } elseif ($progressWorker == 1 && $statusId != 2) {
            $this->can = true;
        } else {
            $this->can = false;
        }

        $this->dispatch('open-modal', 'update-task');
    }

    public function update()
    {
        $this->task->update(['status_id' => $this->statusId]);
        Notification::send($this->project->members()->get(), new TaskStatusUpdatedNotification($this->task));
        $this->dispatch('close-modal', 'update-task');
        Session::flash('status', 'The task status has been updated');
        $this->redirect(route('project.tasks', ['project' => $this->project]), true);
    }

    public function cancel()
    {
        $this->dispatch('close-modal', 'update-task');
        $this->dispatch('refresh-tasks');
    }
}
