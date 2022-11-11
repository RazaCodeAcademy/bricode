<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CheckUserStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;

    public $userType; //  1: vendor-online || 2: expert-online || 3: expert-online

    public function __construct($userId, $userType)
    {
        $this->userId = $userId;

        $this->userType = $userType;
    } 

    public function broadcastOn()
    {
        return ['UserStatus'];
    }
}
