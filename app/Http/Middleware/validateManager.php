<?php

namespace App\Http\Middleware;

use Closure;

class validateManager
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
        if(session('user')&&session('user')->role=="super_manager")
        {
            return $next($request);
        }
        else
        {
            return redirect('/');
        }

    }
}
