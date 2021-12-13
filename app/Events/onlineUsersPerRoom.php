<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class onlineUsersPerRoom implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $roomId;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($room_id, $message)
    {
        $this->roomId =  $room_id;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->roomId .'onlineUser');
    }


    public function broadcastAs()
    {
        return "onlineUsersPerRoom";
    }
}
