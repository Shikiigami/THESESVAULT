<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestApprovedNotification extends Notification
{
    use Queueable;

    protected $editRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct($editRequest)
    {
        $this->editRequest = $editRequest;
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
        $user = $this->editRequest->user;
        $research = $this->editRequest->research;
    
        $mailMessage = (new MailMessage)
            ->subject('Your Request Status')
            ->view('email.approved', ['user' => $user, 'research' => $research]);
    
        if ($this->editRequest->receive_thru === 'Email') {
            $approvalSheetPath = public_path('storage/approvalSheet/' . $this->editRequest->research->approvalSheet);
    
            $mailMessage->attach($approvalSheetPath, [
                'mime' => 'application/pdf',
            ]);
        }
    
        return $mailMessage;
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

