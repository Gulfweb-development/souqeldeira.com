<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization
{
    protected const ALLOWED_LOCALIZATIONS = ['en', 'ar'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $localization = $request->header('Accept-Language');
        $localization = in_array($localization, self::ALLOWED_LOCALIZATIONS, true) ? $localization : 'en';
        app()->setLocale($localization);

        $request->merge([
            'per_page' => max(min(intval($request->get('per_page' , 20)) , 50) , 10),
        ]);
        return $next($request);
    }
}
