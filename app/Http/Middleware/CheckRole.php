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
        if (!auth()->check() || !auth()->user()->hasRole($role)) {
            abort(Response::HTTP_FORBIDDEN, 'You do not have permission to access this page.');
        }
        return $next($request);
    }
}
