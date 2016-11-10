<?php

namespace Mybankerbiz\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

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

        return $next($request);
    }
}
