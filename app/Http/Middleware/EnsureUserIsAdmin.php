<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{

    const ADMIN_USER = 1;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ((int)$request->user()->id !== self::ADMIN_USER) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
