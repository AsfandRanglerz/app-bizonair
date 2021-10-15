<?php

// app/Events/MessageSent.php

namespace App\Events;

use App\User;
use App\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $connection = 'sync';
    /**
     * User that sent the message
     *
     *
     * @var User
     */
    public $user;

    /**
     * Message details
     *
     * @var Message
     */
    public $message;

    public $quoted_message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Message $message,  $quoted_message)
    {
        // dd('hekllo');
        $this->user = $user;
        $this->message = $message;
        $this->quoted_message = $quoted_message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return (new PrivateChannel('chat'));
    }
}
