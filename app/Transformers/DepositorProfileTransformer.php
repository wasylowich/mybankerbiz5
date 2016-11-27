<?php
namespace Mybankerbiz\Transformers;

use Mybankerbiz\DepositorProfile;
use League\Fractal;

class DepositorProfileTransformer extends Fractal\TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    public function transform(DepositorProfile $depositorProfile)
    {
        return [
            'id'         => (int) $depositorProfile->id,
            'name'       => $depositorProfile->name,
            'vatin'      => $depositorProfile->vatin,
            'pin'        => $depositorProfile->pin,
            'is_primary' => $depositorProfile->is_primary,
            'is_active'  => $depositorProfile->is_active,

            'links'   => [
                [
                    'rel' => 'self',
                    'uri' => '/depositorProfiles/' . $depositorProfile->id,
                ]
            ],
        ];
    }
}
