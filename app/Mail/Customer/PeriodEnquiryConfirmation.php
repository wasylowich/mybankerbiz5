<?php

namespace Mybankerbiz\Mail\Customer;

use Mybankerbiz\User;
use Mybankerbiz\Enquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PeriodEnquiryConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $enquirer, Enquiry $enquiry)
    {
        $this->enquirer = $enquirer;
        $this->enquiry  = $enquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('emails.customer.enquiryPeriodConfirmation');
        return $this->text('emails.customer.enquiryPeriodConfirmation_plain')
                    ->with([
                        'userName'                => $this->enquirer->name,
                        'amount'                  => $this->enquiry->amount,
                        'currencyCode'            => $this->enquiry->currency->code,
                        'fixationPeriodStartDate' => $this->enquiry->fixation_period_start_date,
                        'fixationPeriodEndDate'   => $this->enquiry->fixation_period_end_date,
                        'biddingDeadline'         => $this->enquiry->bidding_deadline,
                    ]);
    }
}
