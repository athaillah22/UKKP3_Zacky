<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Middleware pembatas akses berdasarkan role.
     * Cara pakai di routes: ->middleware('role:admin') atau ->middleware('role:customer')
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika user belum login ATAU role-nya tidak sesuai, tolak akses
        if (! $request->user() || $request->user()->role !== $role) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin.');
        }

        return $next($request);
    }
}