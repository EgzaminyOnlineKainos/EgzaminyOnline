<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use App;
use Redirect;

class Language
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
        // Make sure current locale exists.
        $locale = $request->segment(1);

        if ( ! array_key_exists($locale, Config::get('app.locales'))) {
            $segments = $request->segments();
            $segments[0] = Config::get('app.fallback_locale');

            $newUrl = implode('/', $segments);
            if (array_key_exists('QUERY_STRING', $_SERVER))
                $newUrl .= '?'.$_SERVER['QUERY_STRING'];
            return Redirect::to($newUrl);
        }

        App::setLocale($locale);

        return $next($request);
    }
}
