<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->role->namarole=="caleg")
            {
              return redirect('/home');
            }
            elseif ((Auth::user()->role->namarole=="timses"))
            {
              return redirect('/home');
            }
            elseif ((Auth::user()->role->namarole=="timdes"))
            {
              return redirect('/home');
            }
            elseif ((Auth::user()->role->namarole=="superadmin"))
            {
              return redirect('/home');
            }
  
          }
  
          return $next($request);
    }
}
