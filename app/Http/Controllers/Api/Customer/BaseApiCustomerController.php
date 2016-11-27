<?php

namespace Mybankerbiz\Http\Controllers\Api\Customer;

// use Illuminate\Http\Request;

// use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Controllers\Controller as BaseController;

abstract class BaseApiCustomerController extends BaseController
{
    public function __construct()
    {
        // $this->middleware('auth:api');
    }
}
