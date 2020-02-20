<?php

namespace App\Http\Middleware;

use Closure;

class DriverMiddleware
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
        if (auth()->check() && auth()->user()->type === 'driver')
            return $next($request);

        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }
}
