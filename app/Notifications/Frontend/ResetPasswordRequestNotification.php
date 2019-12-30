<?php

namespace App\Notifications\Frontend;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The user.
     *
     * @var string
     */
    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
        // $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $action_url = env('USER_PORTAL_URL', '').'/reset-password?token='.$this->token->token.'&email='.$notifiable->email;

        return (new MailMessage())
            ->subject('Forex Twist Password Reset Request')
            ->view('mails.resetpassword', [
                'user' => $notifiable,
                'action_url' => $action_url,
                'expire_at' => $this->token->expire_at,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
