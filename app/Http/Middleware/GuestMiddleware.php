<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'guest') {
            return $next($request);
        }

        return redirect()->route('login.page')->with('failed', 'Access Denied');
    }
}
