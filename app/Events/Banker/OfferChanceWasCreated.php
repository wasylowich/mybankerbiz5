<?php

namespace Mybankerbiz\Events\Banker;

use Mybankerbiz\OfferChance;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OfferChanceWasCreated
{
    use InteractsWithSockets, SerializesModels;

    /**
     * The offerChance
     *
     * @var Mybankerbiz\OfferChance
     */
    public $offerChance;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(OfferChance $offerChance)
    {
        $this->offerChance = $offerChance;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
