<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LikeComment extends Notification
{
    use Queueable;

    protected $comment, $owner;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comment, $owner)
    {
        $this->comment = $comment;
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
            'path' => $this->comment->post->path(),
            'pathImage' => $this->owner->pathImage(),
            'name' => $this->owner->name,
            'content' => 'likes your comment.'
        ];
    }
}
