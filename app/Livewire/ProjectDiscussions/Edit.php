<?php

namespace App\Livewire\ProjectDiscussions;

use App\Models\Department;
use Livewire\Component;
use App\Models\Discussion;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;

class Edit extends Component
{
    public Project $project;

    public Discussion $discussion;

    #[Validate(['required', 'string', 'max:255'])]
    public string $title = '';

    // #[Validate('required', message: 'The department field is required.')]
    public $department_id = '';

    #[Validate(['required', 'string'])]
    public string $description = '';

    public function render()
    {
        return view('livewire.project-discussions.edit', [
            'departments' => Department::orderBy('name')->get(),
        ]);
    }

    #[On('open-edit')]
    public function setDiscussion(Discussion $discussion)
    {
        $this->discussion = $discussion;
        $this->title = $discussion->title;
        $this->department_id = $discussion->department_id;
        $this->description = $discussion->description;
        $this->dispatch('open-modal', 'edit-discussion');
    }

    public function update()
    {
        $validated = $this->validate();

        if (Auth::user()->role_id == 1 || Auth::id() == $this->project->manager_id) {
            if ($this->department_id) {
                $validated['department_id'] = $this->department_id;
            } else {
                $validated['department_id'] = null;
            }
        }

        $this->discussion->update($validated);
        $this->dispatch('close-modal', 'edit-discussion');
        $this->resetExcept('discussion');
        Session::flash('status', 'The discussion has been updated');
        $this->redirect(route('project.discussions', ['project' => $this->discussion->project_id]), true);
    }

    public function mount(string $projectId)
    {
        $this->project = Project::find($projectId);
    }
}
