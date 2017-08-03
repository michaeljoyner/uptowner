<?php

namespace App\Events;

use App\Menu\MenuGroup;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DeletingMenuGroup
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var MenuGroup
     */
    public $group;

    public function __construct(MenuGroup $group)
    {
        $this->group = $group;
    }
}
