<?php

namespace App\Livewire\ProjectTasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public Task $task;

    public function render()
    {
        return view('livewire.project-tasks.show');
    }

    #[On('open-details')]
    public function setTask(Task $task)
    {
        $this->task = $task;
        $this->dispatch('open-modal', 'task-details');
    }
}
