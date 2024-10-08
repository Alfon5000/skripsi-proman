<?php

namespace App\Livewire\Notifications;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReadAll extends Component
{
    public function render()
    {
        return view('livewire.notifications.read-all');
    }

    public function readAll()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $this->dispatch('close-modal', 'read-all');
        Session::flash('status', 'All notifications has been marked as read');
        $this->redirect('notifications', true);
    }
}
