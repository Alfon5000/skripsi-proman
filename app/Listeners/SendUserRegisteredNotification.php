<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\MemberRegisteredNotification;
use App\Notifications\UserRegisteredNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendUserRegisteredNotification
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
    public function handle(Registered $event): void
    {
        Notification::send(User::roleId(1)->get(), new UserRegisteredNotification($event->user));
        Notification::send(User::roleId(2)->get(), new MemberRegisteredNotification($event->user));
    }
}
