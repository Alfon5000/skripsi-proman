<?php

namespace App\Livewire\Notifications;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DeleteAll extends Component
{
    public function render()
    {
        return view('livewire.notifications.delete-all');
    }

    public function deleteAll()
    {
        Auth::user()->notifications()->delete();
        $this->dispatch('close-modal', 'delete-all');
        Session::flash('status', 'All notifications has been deleted');
        $this->redirect('notifications', true);
    }
}
