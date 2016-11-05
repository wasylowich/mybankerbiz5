<?php

namespace Mybankerbiz\Http\Controllers\Depositor;

use Illuminate\Http\Request;

use Mybankerbiz\Http\Requests;
// use Mybankerbiz\Http\Controllers\Controller;

class DashboardController extends BaseDepositorController
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
        return view('depositor.dashboard.index');
    }
}
