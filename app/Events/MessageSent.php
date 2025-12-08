<?php

namespace App\Events;

use App\Http\Requests\MessageRequest;
use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;


class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $chat_id;
    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct(Chat $message)
    {
        $penerima = $message->penerima_id;
        $pengirim = $message->pengirim_id;
        $this->message = $message;
        
        $this->chat_id = "chat." . (($pengirim > $penerima) ? $penerima . "." . $pengirim : $pengirim . "." .  $penerima);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel
    {
        return new Channel($this->chat_id);
    }
}
