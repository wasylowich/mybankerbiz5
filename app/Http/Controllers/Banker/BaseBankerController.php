<?php

namespace Mybankerbiz\Http\Controllers\Banker;

// use Illuminate\Http\Request;

// use Mybankerbiz\Http\Requests;
use Mybankerbiz\Http\Controllers\Controller as BaseController;

abstract class BaseBankerController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
