<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        session(['url.intended' => $request->url()]);
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'You need to log in to purchase items. If you don\'t have an account, register here.');
        }

        return $next($request);
    }
}
