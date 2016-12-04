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
    protected $defaultIncludes = [
        'profile'
    ];

    public function transform(Bank $bank)
    {
        return [
            'id'                  => (int) $bank->id,
            'name'                => $bank->name,
            'logo'                => $bank->logo(),
            'interest_convention' => $bank->interestConvention->convention,
            'website'             => $bank->website,
            'is_active'           => $bank->is_active,

            // 'links'   => [
            //     [
            //         'rel' => 'self',
            //         'uri' => '/banks/' . $bank->id,
            //     ]
            // ],
        ];
    }

    /**
     * Include Profile
     *
     * @param Bank $bank
     * @return \League\Fractal\Resource\Item
     */
    public function includeProfile(Bank $bank)
    {
        $profile = $bank->profile;

        return $this->item($profile, new BankProfileTransformer);
    }
}
