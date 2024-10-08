<?php

namespace App\Livewire\ProjectMembers;

use App\Models\Event;
use App\Models\User;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MemberAddedNotification;
use App\Notifications\ProjectMemberAddedNotification;

class Create extends Component
{
    public Project $project;

    public Project $oldProject;

    #[Validate(['required', 'string'])]
    public string $member_id = '';

    public function render()
    {
        $members = User::where('role_id', 2)->get()->diff($this->project->members()->get());

        return view('livewire.project-members.create', compact(['members']));
    }

    public function mount(string $projectId)
    {
        $this->project = Project::find($projectId);
        $this->oldProject = Project::find($projectId);
    }

    public function store()
    {
        $validated = $this->validate();
        $this->project->members()->attach($validated['member_id']);

        Event::create([
            'owner_id' => $validated['member_id'],
            'title' => $this->oldProject->name,
            'start_time' => $this->oldProject->start_time,
            'end_time' => $this->oldProject->end_time,
            'description' => $this->oldProject->description,
            'color' => '#ef4444',
            'textColor' => '#ffffff',
        ]);

        $user = User::find($validated['member_id']);
        Notification::send($user, new MemberAddedNotification($this->project));
        Notification::send($this->project->members()->get(), new ProjectMemberAddedNotification($this->project, $user));
        $this->dispatch('close-modal', 'add-member');
        $this->reset('member_id');
        Session::flash('status', 'New member has been added');
        $this->redirect(route('project.members', ['project' => $this->project]), true);
    }
}
