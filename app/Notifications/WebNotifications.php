<?php

namespace App\Notifications;

use App\Traits\Firebase;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WebNotifications extends Notification
{
    use Queueable , Firebase;

    Protected $data;
    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }


    /**
     * Get the notification's delivery channels.
     */

    public function via($notifiable)
    {
        return ['database'];
    }
    


    public function toArray(object $notifiable)
    {

        $this->sendFcmNotification($notifiable->firebase_tokens()->pluck('token_firebase'), $this->data, app()->getLocale());
        return $this->data;
    }

}
