<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class NotificationsDropdown extends Component
{
    #[On('refresh-notifications-dropdown')]
    public function render()
    {
        $unreadNotifications = Auth::user()->unreadNotifications()->get();

        return view('livewire.notifications-dropdown', compact(['unreadNotifications']));
    }

    public function readAll()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $this->dispatch('refresh-notifications-dropdown');
        $this->dispatch('refresh-notifications');
    }

    public function readOne($id)
    {
        Auth::user()->unreadNotifications->when($id ?? false, fn ($query, $id) => $query->where('id', $id))->markAsRead();
        $this->dispatch('refresh-notifications-dropdown');
        $this->dispatch('refresh-notifications');
    }
}
