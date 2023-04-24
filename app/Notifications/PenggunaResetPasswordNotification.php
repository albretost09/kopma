<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PenggunaResetPasswordNotification extends Notification
{
    use Queueable;

    private $token, $email, $role;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $role)
    {
        $this->token = $token;
        $this->email = $email;
        $this->role = $role;
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
        $routeUrl = $this->role == 'PENGURUS' ? 'pengurus.recovery-password.reset' : 'recovery-password.reset';

        return (new MailMessage)
            ->subject('Reset Password Notification')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', url(route($routeUrl, [
                'token' => $this->token,
                'email' => $this->email,
            ], false)))
            ->line('If you did not request a password reset, no further action is required.');
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
