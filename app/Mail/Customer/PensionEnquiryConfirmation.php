<?php

namespace Mybankerbiz\Mail\Customer;

use Mybankerbiz\User;
use Mybankerbiz\Enquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PensionEnquiryConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The customer who opened the enquiry.
     *
     * @var User
     */
    protected $enquirer;

    /**
     * The enquiry instance.
     *
     * @var Enquiry
     */
    protected $enquiry;

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
        // return $this->view('emails.customer.enquiryPensionConfirmation');
        return $this->text('emails.customer.enquiryPensionConfirmation_plain')
                    ->with([
                        'userName'        => $this->enquirer->name,
                        'amount'          => $this->enquiry->amount,
                        'currencyCode'    => $this->enquiry->currency->code,
                        'biddingDeadline' => $this->enquiry->bidding_deadline,
                    ]);
    }
}
