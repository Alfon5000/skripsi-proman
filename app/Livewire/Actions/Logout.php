<?php

namespace App\Livewire\Actions;

use App\Events\UserLoggedOut;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(): void
    {
        $user = User::find(Auth::id());
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();
        UserLoggedOut::dispatch($user);
    }
}
