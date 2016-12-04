<?php

namespace Mybankerbiz\Listeners\Banker;

use Mybankerbiz\Events\Banker\OfferChanceWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOfferChanceNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OfferChanceWasCreated  $event
     * @return void
     */
    public function handle(OfferChanceWasCreated $event)
    {
        // Send a notification to the bank (all bank users?) about the offer chance
    }
}
