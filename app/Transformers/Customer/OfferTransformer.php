<?php
namespace Mybankerbiz\Transformers\Customer;

use Mybankerbiz\Offer;
use League\Fractal;

class OfferTransformer extends Fractal\TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'bank'
    ];

    public function transform(Offer $offer)
    {
        return [
            'id'       => (int) $offer->id,
            'state'    => $offer->state,
            'interest' => $offer->interest,
            'amount'   => $offer->amount,
            'deadline' => $offer->deadline,

            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/offers/' . $offer->id,
                ]
            ],
        ];
    }

    /**
     * Include Bank
     *
     * @param Offer $offer
     * @return \League\Fractal\Resource\Item
     */
    public function includeBank(Offer $offer)
    {
        $bank = $offer->bank;

        return $this->item($bank, new BankTransformer);
    }
}
