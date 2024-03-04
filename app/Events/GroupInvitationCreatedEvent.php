<?php

namespace App\Events;

use App\Models\GroupInvitation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GroupInvitationCreatedEvent
{
    use Dispatchable;

    public function __construct(
        public GroupInvitation $invitation
    )
    {}
}
