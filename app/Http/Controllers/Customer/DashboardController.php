<?php

namespace Mybankerbiz\Http\Controllers\Customer;

use Illuminate\Http\Request;

use Auth;
use Mybankerbiz\DepositorProfile;
use Mybankerbiz\Enquiry;
use Mybankerbiz\Http\Requests;
// use Mybankerbiz\Http\Controllers\Controller;

class DashboardController extends BaseCustomerController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depositorProfiles = DepositorProfile::whereUserId(Auth::user()->id)->get();
        $enquiries = Enquiry::with('depositorProfile', 'depositType', 'currency', 'offers.bank', 'offerChances.bank')->whereEnquirerId(Auth::user()->id)->get();

        return view('customer.dashboard.index', compact('depositorProfiles', 'enquiries'));
    }
}
