<?php

namespace App\Listeners;

use App\Events\UsersResetPassword;
use App\Models\PasswordReset;
use App\Notifications\Frontend\ResetPasswordRequestNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class UsersResetPasswordRequest implements ShouldQueue
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
     * @param UsersResetPassword $event
     */
    public function handle(UsersResetPassword $event)
    {
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $event->user->email],
            [
                'email' => $event->user->email,
                'token' => Str::random(60),
                'expire_at' => Carbon::now()->addMinutes(60),
            ]
        );

        $event->user->notify(new ResetPasswordRequestNotification($passwordReset));
    }
}
