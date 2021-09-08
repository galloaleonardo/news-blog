<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class EnsureUserIsNotDisabled
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
        if (!(bool)$request->user()->active) {
            Auth::logout();
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
