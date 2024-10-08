<?php

namespace App\Livewire\ProjectMembers;

use App\Models\User;
use App\Models\Event;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;

class Delete extends Component
{
    public Project $project;

    public Project $oldProject;

    public User $member;

    public function render()
    {
        return view('livewire.project-members.delete');
    }

    #[On('open-delete')]
    public function setMember(Project $project, User $member)
    {
        $this->project = $project;
        $this->oldProject = $project;
        $this->member = $member;
        $this->dispatch('open-modal', 'delete-member');
    }

    public function destroy()
    {
        $this->project->members()->detach($this->member->id);

        $event = Event::where('owner_id', $this->member->id)->where('title', $this->oldProject->name)->where('start_time', $this->oldProject->start_time)->where('end_time', $this->oldProject->end_time)->where('description', $this->oldProject->description)->first();

        $event->delete();

        $this->dispatch('close-modal', 'delete-member');
        Session::flash('status', 'The member has been removed');
        $this->redirect(route('project.members', ['project' => $this->project]), true);
    }
}
