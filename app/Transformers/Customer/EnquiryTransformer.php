<?php
namespace Mybankerbiz\Transformers\Customer;

use Mybankerbiz\Enquiry;
use League\Fractal;
use Mybankerbiz\Transformers\CurrencyTransformer;
use Mybankerbiz\Transformers\DepositTypeTransformer;
use Mybankerbiz\Transformers\DepositorProfileTransformer;

class EnquiryTransformer extends Fractal\TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'currency',
        'depositorProfile',
        'depositType',
        'offerChances',
        'offers',
    ];

    public function transform(Enquiry $enquiry)
    {
        $fixationStart = ! is_null($enquiry->fixation_period_start_date)
                            ? $enquiry->fixation_period_start_date->toDateString()
                            : null;

        $fixationEnd   = ! is_null($enquiry->fixation_period_end_date)
                            ? $enquiry->fixation_period_end_date->toDateString()
                            : null;
        return [
            'id'                         => (int) $enquiry->id,
            'bidding_deadline'           => $enquiry->bidding_deadline->toDateString(),
            'amount'                     => (int) $enquiry->amount,
            'fixation_period_start_date' => $fixationStart,
            'fixation_period_end_date'   => $fixationEnd,
            'is_active'                  => $enquiry->is_active,
            'status'                     => $enquiry->status,
            'offers_deadline'            => $enquiry->offers_deadline,
            'fixation_period'            => $enquiry->fixation_period,

            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/enquiries/' . $enquiry->id,
                ]
            ],
        ];
    }

    /**
     * Include Currency
     *
     * @param Enquiry $enquiry
     * @return \League\Fractal\Resource\Item
     */
    public function includeCurrency(Enquiry $enquiry)
    {
        $currency = $enquiry->currency;

        return $this->item($currency, new CurrencyTransformer);
    }

    /**
     * Include DepositorProfile
     *
     * @param Enquiry $enquiry
     * @return \League\Fractal\Resource\Item
     */
    public function includeDepositorProfile(Enquiry $enquiry)
    {
        $depositorProfile = $enquiry->depositorProfile;

        return $this->item($depositorProfile, new DepositorProfileTransformer);
    }

    /**
     * Include DepositType
     *
     * @param Enquiry $enquiry
     * @return \League\Fractal\Resource\Item
     */
    public function includeDepositType(Enquiry $enquiry)
    {
        $depositType = $enquiry->depositType;

        return $this->item($depositType, new DepositTypeTransformer);
    }

    /**
     * Include OfferChances
     *
     * @param Enquiry $enquiry
     * @return \League\Fractal\Resource\Item
     */
    public function includeOfferChances(Enquiry $enquiry)
    {
        $offerChances = $enquiry->offerChances;

        return $this->collection($offerChances, new OfferChanceTransformer);
    }

    /**
     * Include Offers
     *
     * @param Enquiry $enquiry
     * @return \League\Fractal\Resource\Item
     */
    public function includeOffers(Enquiry $enquiry)
    {
        $offers = $enquiry->offers;

        return $this->collection($offers, new OfferTransformer);
    }
}
