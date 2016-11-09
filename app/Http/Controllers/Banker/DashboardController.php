<?php

namespace Mybankerbiz\Http\Controllers\Banker;

use Illuminate\Http\Request;

use Auth;
use Mybankerbiz\DepositorProfile;
use Mybankerbiz\Http\Requests;
// use Mybankerbiz\Http\Controllers\Controller;

class DashboardController extends BaseBankerController
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
        return view('banker.dashboard.index');
    }
}
