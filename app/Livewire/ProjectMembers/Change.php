<?php

namespace App\Livewire\ProjectMembers;

use App\Models\User;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ManagerChangedNotification;
use App\Notifications\ProjectManagerChangedNotification;

class Change extends Component
{
    public Project $project;

    public string $manager_id = '';

    public function render()
    {
        return view('livewire.project-members.change');
    }

    #[On('open-change')]
    public function setManager(Project $project, User $member)
    {
        $this->project = $project;
        $this->manager_id = $member->id;
        $this->dispatch('open-modal', 'change-manager');
    }

    public function change()
    {
        $this->project->update(['manager_id' => $this->manager_id]);
        Notification::send($this->project->members()->get(), new ManagerChangedNotification($this->project));
        Notification::send($this->project->members()->get(), new ProjectManagerChangedNotification($this->project));
        $this->dispatch('close-modal', 'change-manager');
        Session::flash('status', 'The manager has been changed');
        $this->redirect(route('project.members', ['project' => $this->project]), true);
    }
}
