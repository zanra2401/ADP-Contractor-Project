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


class MessageSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $chat_id;
    public $user;
    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, Chat $message)
    {
        $penerima = $message->penerima_id;
        $pengirim = $user->id;
        $this->user = $user;
        $this->message = $message;

        $this->chat_id = "chat." . (($pengirim > $penerima) ? $penerima . "." . $pengirim : $pengirim . "." .  $penerima);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('a'),
        ];
    }
}
