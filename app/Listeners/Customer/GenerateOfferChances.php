<?php

namespace Mybankerbiz\Listeners\Customer;

use Mybankerbiz\Bank;
use Mybankerbiz\Events\Banker\OfferChanceWasCreated;
use Mybankerbiz\Events\Customer\EnquiryWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateOfferChances
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
        // TODO: Fix the seeders, then remove the users relation from this Banks collection
        //       It is only included here to satisfy the check below
        $banks = Bank::with('users')->whereIsActive(true)->get();

        foreach ($banks as $bank) {
            // TODO: Fix the seeders, then remove this check for users
            //       Checking if the bank has any users shouldn't be necessary
            //       This check is only included here due to dodgy DB table seeders
            if ($bank->users->count()) {
                $offerChance = $event->enquiry->offerChances()->create([
                    'bank_id' => $bank->id,
                    'state'   => 'under_consideration',
                ]);

                // Fire an event indicating that an OfferChance was created
                event(new OfferChanceWasCreated($offerChance));
            }
        }
    }
}
