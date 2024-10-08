<?php

namespace App\Livewire\Members;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public User $member;

    public function render()
    {
        return view('livewire.members.show');
    }

    #[On('open-details')]
    public function setMember(User $member)
    {
        $this->member = $member;
        $this->dispatch('open-modal', 'member-details');
    }
}
