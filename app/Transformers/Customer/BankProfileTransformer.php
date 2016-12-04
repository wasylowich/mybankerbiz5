<?php
namespace Mybankerbiz\Transformers\Customer;

use Mybankerbiz\BankProfile;
use League\Fractal;

class BankProfileTransformer extends Fractal\TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    public function transform(BankProfile $bankProfile)
    {
        return [
            'id'            => (int) $bankProfile->id,
            'annual_report' => $bankProfile->annual_report,
            'bio'           => nl2br($bankProfile->bio),

            // 'links'   => [
            //     [
            //         'rel' => 'self',
            //         'uri' => '/bankProfiles/' . $bankProfile->id,
            //     ]
            // ],
        ];
    }
}
