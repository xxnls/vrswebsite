<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class EnsureTokenIsValid
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
        if (!Session::has('token')) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        return $next($request);
    }
}
