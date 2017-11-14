<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LikePost extends Notification
{
    use Queueable;

    protected $post, $owner;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post, $owner)
    {
        $this->post = $post;
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
            'path' => $this->post->path(),
            'pathImage' => $this->owner->pathImage(),
            'name' => $this->owner->name,
            'content' => 'likes your post.'
        ];
    }
}
