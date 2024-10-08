<?php

namespace App\Livewire\ProjectDiscussions;

use App\Models\Department;
use App\Models\Discussion;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
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
    public string $department_id = '';

    #[Url]
    public int $per_page = 0;

    #[On('refresh-discussions')]
    public function render()
    {
        $departments = Department::orderBy('name')->get();

        if (Auth::user()->role_id == 1 || Auth::id() == $this->project->manager_id) {
            $discussions = Discussion::projectId($this->project->id)
                ->filter(['search' => $this->search, 'department_id' => $this->department_id])
                ->latest()
                ->paginate($this->per_page);
        } else {
            $discussions = Discussion::projectId($this->project->id)
                ->departmentId(null)
                ->departmentId(Auth::user()->department_id)
                ->filter(['search' => $this->search])
                ->latest()
                ->paginate($this->per_page);
        }

        return view('livewire.project-discussions.index', compact(['discussions', 'departments']));
    }

    public function mount(string $projectId)
    {
        $this->project = Project::find($projectId);
    }
}
