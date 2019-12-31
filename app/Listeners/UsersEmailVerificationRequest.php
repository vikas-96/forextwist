<?php

namespace App\Listeners;

use App\Events\UsersEmailVerification;
use App\Notifications\Frontend\UsersEmailVerificationNotification;
use Illuminate\Support\Str;

class UsersEmailVerificationRequest
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
    public function handle(UsersEmailVerification $event)
    {
        $event->user->email_verification_token = Str::random(60);   // update token for email verification
        $event->user->save();
        $event->user->notify(new UsersEmailVerificationNotification($event->user));
    }
}
