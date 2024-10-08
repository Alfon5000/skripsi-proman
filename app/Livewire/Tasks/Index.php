<?php

namespace App\Livewire\Tasks;

use App\Models\Priority;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public string $project_id = '';

    #[Url]
    public string $priority_id = '';

    #[Url]
    public string $status_id = '';

    #[Url]
    public int $per_page = 0;

    public function render()
    {
        return view('livewire.tasks.index', [
            'tasks' => Task::workerId(Auth::id())->filter([
                'search' => $this->search,
                'project_id' => $this->project_id,
                'priority_id' => $this->priority_id,
                'status_id' => $this->status_id,
            ])->paginate($this->per_page),
            'projects' => Project::isMember()->orderBy('name')->get(),
            'priorities' => Priority::get(),
            'statuses' => Status::get(),
        ]);
    }
}
