<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class UserMiddleware
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
        if(Session::has('studentLoggedIn') && Session::get('studentLoggedIn')) {
            return $next($request);
        }
        return redirect('alltest');
    }
}
