<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TopicAccepted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $topic;
    public $mess;
    public $moderatorId;

    public function __construct($topic, $mess, $moderatorId)
    {
        $this->topic = $topic;
        $this->mess = $mess;
        $this->moderatorId = $moderatorId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
         
         return new Channel('admin-message');
        
    }
    public function broadcastAs(){
        return 'topic-accept'.$this->moderatorId;
    }
}
