<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ConnectionRequestNotification extends Notification
{
    use Queueable;

    protected $sender;
    protected $message;
    protected $link;

    public function __construct(User $sender, string $message = 'sent you a connection request', string $link = '')
    {
        $this->sender  = $sender;
        $this->message = $message;
        $this->link    = $link;
    }

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'sender_id'    => $this->sender->id,
            'sender_name'  => $this->sender->name,
            'sender_image' => $this->sender->image,
            'message'      => $this->message,
            'link'         => $this->link,
        ];
    }
}