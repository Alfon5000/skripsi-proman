<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public Task $task;

    public function render()
    {
        return view('livewire.tasks.show');
    }

    #[On('open-details')]
    public function setTask(Task $task)
    {
        $this->task = $task;
        $this->dispatch('open-modal', 'task-details');
    }
}
