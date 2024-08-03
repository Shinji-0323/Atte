<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClearSessionDaily
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $lastClear = Session::get('last_clear', now()->subDay());

        if (now()->diffInDays($lastClear) > 0) {
            Session::forget('state');
            Session::put('last_clear', now());
        }
        return $next($request);
    }
}
