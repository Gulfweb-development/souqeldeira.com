<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApprovedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('web')->check() && user()->is_approved == 1 && user()->hasVerifiedEmail()) {
            return $next($request);
        }
        return redirect()->route('welcome')->with('info',__('app.admin_approve_account'));
    }
}
