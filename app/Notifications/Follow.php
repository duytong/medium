<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Follow extends Notification
{
    use Queueable;

    protected $owner;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($owner)
    {
        $this->owner = $owner;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'path' => $this->owner->path(),
            'pathImage' => $this->owner->pathImage(),
            'name' => $this->owner->name,
            'content' => 'started following you.'
        ];
    }
}
