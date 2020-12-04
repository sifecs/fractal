<?php

namespace App\Http\Middleware;

use App\Services\Localization\LocalizationService;
use Closure;

class setLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $local = LocalizationService::locale();

        if ($local) {
            \App::setLocale($local);
        }

        return $next($request);
    }
}
