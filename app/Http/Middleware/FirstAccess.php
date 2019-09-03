<?php

namespace App\Http\Middleware;

use Closure;

class FirstAccess
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
        $user = \Auth::user();

        if ($user) {
            if ( ! $user->validated) {
                \Auth::logout();
                return redirect('/login');
            }
        } else {
            return redirect('/login');
        }

        return $next($request);
    }
}
