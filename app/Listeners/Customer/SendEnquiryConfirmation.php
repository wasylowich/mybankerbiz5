<?php

namespace Mybankerbiz\Listeners\Customer;

use Mybankerbiz\Events\Customer\EnquiryWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEnquiryConfirmation
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
     * @param  EnquiryWasCreated  $event
     * @return void
     */
    public function handle(EnquiryWasCreated $event)
    {
        // Send an enquiry confirmation email to the customer
    }
}
