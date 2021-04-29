<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiLanguageResponse
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
        if ($request->hasHeader("language")) {
            app()->setLocale($request->header("language"));
        }
        return $next($request);
    }
}
