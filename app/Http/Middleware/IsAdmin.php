<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permiso para acceder aquí.');
        }

        return $next($request);
    }
}
