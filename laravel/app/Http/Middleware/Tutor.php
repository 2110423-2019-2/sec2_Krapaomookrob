<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Tutor
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
        if( Auth::check() && Auth::user()->isTutor() ) {
            return $next($request);
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
}
