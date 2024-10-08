<?php

namespace App\Livewire\ProjectTasks;

use App\Models\Task;
use App\Models\Event;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;

class Delete extends Component
{
    public Task $task;

    public Task $oldTask;

    public function render()
    {
        return view('livewire.project-tasks.delete');
    }

    #[On('open-delete')]
    public function setTask(Task $task)
    {
        $this->task = $task;
        $this->oldTask = $task;
        $this->dispatch('open-modal', 'delete-task');
    }

    public function destroy()
    {
        $this->task->delete();

        $event = Event::where('owner_id', $this->oldTask->worker_id)->where('title', $this->oldTask->title)->where('start_time', $this->oldTask->start_time)->where('end_time', $this->oldTask->end_time)->where('description', $this->oldTask->description)->first();

        $event->delete();

        $this->dispatch('close-modal', 'delete-task');
        Session::flash('status', 'The task has been deleted');
        $this->redirect(route('project.tasks', ['project' => $this->task->project_id]), true);
    }
}
