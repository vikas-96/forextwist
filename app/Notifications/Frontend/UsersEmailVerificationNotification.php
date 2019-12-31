<?php

namespace App\Notifications\Frontend;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UsersEmailVerificationNotification extends Notification
{
    use Queueable;

    /**
     * The user.
     *
     * @var string
     */
    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $action_url = env('FRONT_PORTAL_URL', '').'/email_verify?token='.$notifiable->email_verification_token.'&email='.$notifiable->email;

        return (new MailMessage())
            ->subject('Forex Twist Email Verification')
            ->view('mails.user-email-verification', [
                'user' => $notifiable,
                'action_url' => $action_url,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [

        ];
    }
}
