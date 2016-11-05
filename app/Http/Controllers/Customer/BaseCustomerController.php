<?php

namespace Mybankerbiz\Http\Controllers\Customer;

// use Illuminate\Http\Request;

// use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Controllers\Controller as BaseController;

abstract class BaseCustomerController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
