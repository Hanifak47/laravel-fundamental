<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ParamMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    // ada 2 parameter tambahan yaitu key dan status
    public function handle(Request $request, Closure $next, string $key, int $status)
    {
        $apikey = $request->header('X-API-KEY');
        if ($apikey == $key) {
            return $next($request);
        } else {
            return response('Access Denied', $status);
        }

    }
}
