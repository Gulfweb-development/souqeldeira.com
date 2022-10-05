<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrontendLangMiddleware
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
        app()->setLocale(config('app.locale'));
        if (session()->has('front-locale')) {
            app()->setLocale(session('front-locale'));
        }
        return $next($request);
    }
}
