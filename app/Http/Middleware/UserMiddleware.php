<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Auth;

class UserMiddleware
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
        if(Auth::check()) {
            // admin role == 'admin'
            // user role == 'user'

            if(Auth::user()->role == 'user'){
                return $next($request);
            } else {
                return redirect(RouteServiceProvider::HOME);
            }
        } else {
            return redirect()->route('login')->with('message', 'Login to access the website');
        }
        return $next($request);
    }
}
