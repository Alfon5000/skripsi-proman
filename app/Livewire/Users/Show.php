<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public User $user;

    public function render()
    {
        return view('livewire.users.show');
    }

    #[On('open-details')]
    public function setUser(User $user)
    {
        $this->user = $user;
        $this->dispatch('open-modal', 'user-details');
    }
}
