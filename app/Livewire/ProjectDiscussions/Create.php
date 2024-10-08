<?php

namespace App\Livewire\ProjectDiscussions;

use App\Models\Department;
use App\Models\Project;
use Livewire\Component;
use App\Models\Discussion;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DiscussionAddedNotification;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public Project $project;

    #[Validate(['required', 'string', 'max:255'])]
    public string $title = '';

    // #[Validate('required', message: 'The department field is required.')]
    public $department_id = '';

    #[Validate(['required', 'string'])]
    public string $description = '';

    public function render()
    {
        return view('livewire.project-discussions.create', [
            'departments' => Department::orderBy('name')->get(),
        ]);
    }

    public function store()
    {
        $validated = $this->validate();

        if (Auth::user()->role_id == 1 || Auth::id() == $this->project->manager_id) {
            if ($this->department_id) {
                $validated['department_id'] = $this->department_id;
            } else {
                $validated['department_id'] = null;
            }
        }

        $validated['creater_id'] = Auth::id();
        $validated['project_id'] = $this->project->id;
        $discussion = Discussion::create($validated);
        Notification::send($this->project->members()->get(), new DiscussionAddedNotification($discussion));
        $this->dispatch('close-modal', 'add-discussion');
        $this->resetExcept('project');
        Session::flash('status', 'New discussion has been added');
        $this->redirect(route('project.discussions', ['project' => $this->project]), true);
    }

    public function mount(string $projectId)
    {
        $this->project = Project::find($projectId);
    }
}
