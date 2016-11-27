<?php
namespace Mybankerbiz\Transformers\Customer;

use Mybankerbiz\Bank;
use League\Fractal;

class BankTransformer extends Fractal\TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    public function transform(Bank $bank)
    {
        return [
            'id'        => (int) $bank->id,
            'name'      => $bank->name,
            'website'   => $bank->website,
            'is_active' => $bank->is_active,

            // 'links'   => [
            //     [
            //         'rel' => 'self',
            //         'uri' => '/banks/' . $bank->id,
            //     ]
            // ],
        ];
    }
}
