<?php

namespace App\Listeners;

use App\Events\UserAuthenticated;
use App\Events\UserLoggedIn;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InsertLoginAt
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserLoggedIn $event): void
    {
        User::where('email', $event->email)->update(['login_at' => now()]);
    }
}
