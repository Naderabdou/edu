<?php

namespace App\Notifications;

use App\Traits\Firebase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppNotification extends Notification
{

    use Queueable ,Firebase;
    protected $data;


    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        dd($data);
        $this->data = $data;
    }


    public function via($notifiable)
    {
        return ['database'];
    }



    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
           //
            $this->sendFcmNotification($notifiable->firebase_tokens()->pluck('token_firebase'), $this->data, app()->getLocale());


        return $this->data;
    }
}
