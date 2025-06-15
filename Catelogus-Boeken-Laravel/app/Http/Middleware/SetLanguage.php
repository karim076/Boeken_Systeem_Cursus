<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class SetLanguage
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
        // Standaard Nederlands, tenzij cookie Arabisch aangeeft
        $lang = $request->cookie('lang', 'nl');

        // Alleen vertalen voor Arabisch
        if ($lang === 'ar') {
            Config::set('app.auto_translate', true);
        }

        App::setLocale($lang);

        return $next($request);
    }
}
