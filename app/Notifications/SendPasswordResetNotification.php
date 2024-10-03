<?php 
// app/Notifications/SendPasswordResetNotification.php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class SendPasswordResetNotification extends ResetPasswordNotification
{
    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reset Password')
            ->markdown('email.password-reset', [
                'actionUrl' => $this->resetUrl($notifiable),
                'actionText' => 'Reset Password'
            ]);
    }

    /**
     * Get the password reset URL for the given notifiable.
     */
    protected function resetUrl($notifiable)
    {
        return url(config('app.url').route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false));
    }
}
