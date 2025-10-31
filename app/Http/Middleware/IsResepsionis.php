<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsResepsionis
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    if (! auth()->check()) {
        abort(403, 'Unauthorized.');
    }

    $roleUser = auth()->user()->roleUser()->where('status', 1)->with('role')->first();
    if (! $roleUser || strtolower($roleUser->role->nama_role ?? '') !== 'resepsionis') {
        abort(403, 'Unauthorized.');
    }

    return $next($request);
}

}
