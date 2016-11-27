<?php
namespace Mybankerbiz\Transformers;

use Mybankerbiz\Currency;
use League\Fractal;

class CurrencyTransformer extends Fractal\TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    public function transform(Currency $currency)
    {
        return [
            'id'         => (int) $currency->id,
            'name'       => $currency->name,
            'code'       => $currency->code,
            'precision'  => $currency->precision,

            // 'links'   => [
            //     [
            //         'rel' => 'self',
            //         'uri' => '/currencies/' . $currency->id,
            //     ]
            // ],
        ];
    }
}
