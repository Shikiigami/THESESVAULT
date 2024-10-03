<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use App\Models\tokens;

class FullTextRequestNotification extends Notification
{
    use Queueable;

    protected $editFullRequest;

    /**
     * Create a new notification instance.
     */
    public function __construct($editFullRequest)
    {
        $this->editFullRequest = $editFullRequest;
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
         $user = $this->editFullRequest->full_userId;
         $research_link = $this->editFullRequest->full_researchId->drive_link;
         $request =$this->editFullRequest->id;
     
         $token = Str::random(32); 
     
         tokens::create([
             'request_id' =>$request,
             'email' => $user->email,
             'token' => $token,
         ]);
     
         $research_link .= '?token=' . $token;
     
         // Return MailMessage with the subject and view
         return (new MailMessage)
             ->subject('Request Full Text Thesis in PalSu ThesesVault')
             ->markdown('email.full-text', ['research_link' => $research_link]);
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
