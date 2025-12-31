<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || (Auth::user()->role !== 'super_admin' && Auth::user()->role !== 'admin')) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Access denied.'], 403);
            }
            abort(403, 'Access denied. Admins only.');
        }

        return $next($request);
    }
}
