<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Notifications\WebNotifications;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;

class SendWebNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users;
    protected $data;
    public function __construct($users, $data)
    {

        $this->users = $users;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
       Notification::send($this->users , new WebNotifications($this->data));

    }
}
