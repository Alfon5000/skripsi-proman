<?php

namespace App\Livewire\Notifications;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DeleteOne extends Component
{
    public $notification;

    public function render()
    {
        return view('livewire.notifications.delete-one');
    }

    #[On('open-delete-one')]
    public function setNotification($notification)
    {
        $this->notification = $notification;
        $this->dispatch('open-modal', 'delete-one');
    }

    public function deleteOne($notificationId)
    {
        Auth::user()->notifications()->when($notificationId ?? false, fn ($query) => $query->where('id', $notificationId))->delete();
        $this->dispatch('close-modal', 'delete-one');
        Session::flash('status', 'The notification has been deleted');
        $this->redirect('notifications', true);
    }
}
