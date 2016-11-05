<?php

namespace Mybankerbiz\Http\Controllers\Depositor;

// use Illuminate\Http\Request;

// use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Controllers\Controller as BaseController;

abstract class BaseDepositorController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
