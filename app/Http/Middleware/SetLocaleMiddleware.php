<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocaleMiddleware
{

    public function handle($request, Closure $next)
    {
        $locale = session('locale','es');
        App::setlocale($locale); 
        // For each request we read the value of "locale" in session and configure the global language of the app

        return $next($request);
    }
}
