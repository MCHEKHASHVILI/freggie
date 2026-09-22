<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromHeader
{
    /**
     * Set the application locale from the request's Accept-Language header,
     * falling back to the configured default when none of the requested
     * locales are supported.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->getPreferredLanguage(config('app.supported_locales'));

        if ($locale) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
