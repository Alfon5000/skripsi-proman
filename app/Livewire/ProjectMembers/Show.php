<?php

namespace App\Livewire\ProjectMembers;

use App\Models\Project;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public Project $project;
    public User $member;

    public function render()
    {
        return view('livewire.project-members.show');
    }

    #[On('open-details')]
    public function setMember(Project $project, User $member)
    {
        $this->project = $project;
        $this->member = $member;
        $this->dispatch('open-modal', 'member-details');
    }
}
