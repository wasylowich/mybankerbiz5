<?php

namespace Mybankerbiz\Listeners\Customer;

use Mail;
use Mybankerbiz\Enumerations\EnumDepositType;
use Mybankerbiz\Mail\Customer\PensionEnquiryConfirmation;
use Mybankerbiz\Mail\Customer\PeriodEnquiryConfirmation;
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
        $enquirer = $event->enquirer;
        $enquiry  = $event->enquiry;

        if ($enquiry->deposit_type_id == EnumDepositType::PENSION) {
            Mail::to($enquirer)->send(new PensionEnquiryConfirmation($enquirer, $enquiry));
        } else {
            Mail::to($enquirer)->send(new PeriodEnquiryConfirmation($enquirer, $enquiry));
        }
    }
}
