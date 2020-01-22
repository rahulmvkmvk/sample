<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RepEmail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email;
	public $order_id;
	public $club_name;
	/**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email,$order_id,$club_name)
    {
         $this->email = $email;
		 $this->order_id = $order_id;
		 $this->club_name = $club_name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
