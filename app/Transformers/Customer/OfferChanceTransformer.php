<?php
namespace Mybankerbiz\Transformers\Customer;

use Mybankerbiz\OfferChance;
use League\Fractal;

class OfferChanceTransformer extends Fractal\TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'bank'
    ];

    public function transform(OfferChance $offerChance)
    {
        return [
            'id'    => (int) $offerChance->id,
            'state' => $offerChance->state,

            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/offerChances/' . $offerChance->id,
                ]
            ],
        ];
    }

    /**
     * Include Bank
     *
     * @param OfferChance $offerChance
     * @return \League\Fractal\Resource\Item
     */
    public function includeBank(OfferChance $offerChance)
    {
        $bank = $offerChance->bank;

        return $this->item($bank, new BankTransformer);
    }
}
