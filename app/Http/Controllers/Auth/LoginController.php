<?php

namespace Mybankerbiz\Http\Controllers\Auth;

use Auth;
use Mybankerbiz\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * The user has been authenticated.
     * Method copied from "Illumunate\Foundation\Auth\AuthenticateUsers.php"
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if (Auth::user()->hasAnyRole('sys-admin', 'admin')) {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::user()->hasAnyRole('bidder')) {
            return redirect()->route('banker.dashboard');
        }

        if (Auth::user()->hasAnyRole('depositor')) {
            return redirect()->route('customer.dashboard');
        }

        return redirect('/');
    }
}
