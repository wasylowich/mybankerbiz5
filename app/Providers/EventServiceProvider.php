<?php

namespace Mybankerbiz\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Mybankerbiz\Events\Customer\EnquiryWasCreated' => [
            'Mybankerbiz\Listeners\Customer\GenerateOfferChances',
            'Mybankerbiz\Listeners\Customer\SendEnquiryConfirmation',
        ],
        'Mybankerbiz\Events\Banker\OfferChanceWasCreated' => [
            'Mybankerbiz\Listeners\Banker\SendOfferChanceNotification',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
