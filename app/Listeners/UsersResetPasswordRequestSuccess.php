<?php

namespace App\Listeners;

use App\Events\UsersResetPasswordSuccess;
use App\Notifications\Frontend\ResetPasswordSuccessNotification;

class UsersResetPasswordRequestSuccess
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param UsersResetPasswordSuccess $event
     */
    public function handle(UsersResetPasswordSuccess $event)
    {
        $event->user->notify(new ResetPasswordSuccessNotification($event->user));
    }
}
