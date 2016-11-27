<?php
namespace Mybankerbiz\Transformers;

use Mybankerbiz\DepositType;
use League\Fractal;

class DepositTypeTransformer extends Fractal\TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    public function transform(DepositType $depositType)
    {
        return [
            'id'         => (int) $depositType->id,
            'name'       => $depositType->name,

            // 'links'   => [
            //     [
            //         'rel' => 'self',
            //         'uri' => '/depositTypes/' . $depositType->id,
            //     ]
            // ],
        ];
    }
}
