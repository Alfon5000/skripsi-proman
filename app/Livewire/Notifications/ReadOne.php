<?php

namespace App\Livewire\Notifications;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;

class ReadOne extends Component
{
    public $notification;

    public function render()
    {
        return view('livewire.notifications.read-one');
    }

    #[On('open-read-one')]
    public function setNotification($notification)
    {
        $this->notification = $notification;
        $this->dispatch('open-modal', 'read-one');
    }

    public function readOne(string $notificationId)
    {
        auth()->user()->unreadNotifications->when($notificationId ?? false, fn ($query) => $query->where('id', $notificationId))->markAsRead();
        $this->dispatch('close-modal', 'read-one');
        Session::flash('status', 'The notification has been marked as read');
        $this->redirect('notifications', true);
    }
}
