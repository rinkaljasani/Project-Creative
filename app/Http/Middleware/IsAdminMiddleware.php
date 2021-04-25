<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class IsAdminMiddleware
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
        if(!auth()->user()->isAdmin){
            Auth::logout();
            $request->session()->flush();
            $request->session()->regenerate();
        }
        
        return $next($request);

    }
}
