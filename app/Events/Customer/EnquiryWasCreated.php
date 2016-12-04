<?php

namespace Mybankerbiz\Events\Customer;

use Mybankerbiz\Enquiry;
use Mybankerbiz\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EnquiryWasCreated
{
    use InteractsWithSockets, SerializesModels;

    /**
     * The enquiry
     *
     * @var Mybankerbiz\Enquiry
     */
    public $enquiry;

    /**
     * The user to posted the enquiry
     *
     * @var Mybankerbiz\User
     */
    public $enquirer;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Enquiry $enquiry, User $enquirer)
    {
        $this->enquiry  = $enquiry;
        $this->enquirer = $enquirer;
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
