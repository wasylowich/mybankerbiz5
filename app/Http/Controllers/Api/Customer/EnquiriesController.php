<?php

namespace Mybankerbiz\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;
use Mybankerbiz\User;
use Mybankerbiz\Currency;
use Mybankerbiz\DepositType;
use Mybankerbiz\DepositorProfile;
use Mybankerbiz\Enquiry;
use Mybankerbiz\Enumerations\EnumDepositType;
use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Requests\Customer\EnquiryRequest;
use Mybankerbiz\Transformers\Customer\EnquiryTransformer;
// use Mybankerbiz\Http\Controllers\Controller;

class EnquiriesController extends BaseApiCustomerController
{
    protected $enquiry;

    public function __construct(Enquiry $enquiry)
    {
        $this->enquiry = $enquiry;

        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquiries = Enquiry::with(
                'depositorProfile',
                'depositType',
                'currency',
                'offers.bank',
                'offerChances.bank'
            )
            ->whereEnquirerId(Auth::user()->id)
            ->get();

        // return $enquiries;

        // $enquiries = Auth::user()->enquiries()
        //                 ->with('depositorProfile', 'depositType', 'currency', 'offers.bank', 'offerChances.bank')
        //                 ->get();

        return fractal()
            ->collection($enquiries, new EnquiryTransformer())
            ->serializeWith(new \Spatie\Fractal\ArraySerializer());
    }
}
