<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check()) {
            abort(403, 'You do not have permission to access this page.');
        }
        if (auth()->user()->hasRole('super_admin')) {
            return $next($request);
        }
        $role = strtolower($role);
        if (!auth()->user()->hasRole($role)) {
            abort(403, 'You do not have permission to access this page.');
        }
        return $next($request);
    }
}
