<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddlware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if user has login
        if (Auth::user()) {
            // check if the user's role is admin or superadmin otherwise redirect back
            if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin') {
                // check whethere the inputted route isn't login or register
                if ($this->checkRouteName($request)) {
                    return back();
                }
                return $next($request);
            }
            return back();
        } else {
            // check whethere the inputted route is login or register
            if ($this->checkRouteName($request)) {
                return $next($request);
            }
            return back();
        }
    }
    public function checkRouteName($request)
    {
        return $request->route()->getName() == 'login' || $request->route()->getName() == 'register';
    }
}
