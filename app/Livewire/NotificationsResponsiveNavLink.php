<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationsResponsiveNavLink extends Component
{
    public function render()
    {
        return view('livewire.notifications-responsive-nav-link', [
            'unreadNotifications' => Auth::user()->unreadNotifications()->get(),
        ]);
    }
}
