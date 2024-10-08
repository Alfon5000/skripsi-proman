<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OnlineUsers extends Component
{
    public function render()
    {
        if (Auth::user()->role_id == 1) {
            $onlineUsers = User::orderBy('login_at', 'DESC')->orderBy('name')->get();
        } else {
            $onlineUsers = User::roleId(2)->orderBy('login_at', 'DESC')->orderBy('name')->get();
        }

        return view('livewire.dashboard.online-users', compact('onlineUsers'));
    }
}
