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

class offlineUsersPerRoom implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $roomId;
    public $message;
    public $activityMessage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($room_id, $message, $activityMessage="")
    {
        $this->roomId           =  $room_id;
        $this->message          = $message;
        $this->activityMessage = $activityMessage;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->roomId .'offlineUser');
    }


    public function broadcastAs()
    {
        return "offlineUsersPerRoom";
    }
}
