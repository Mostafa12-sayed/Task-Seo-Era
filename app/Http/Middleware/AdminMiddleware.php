<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Access denied. Admin privileges required.'
            ], 403);
        }

        // Check if token has admin scope
        if (!$request->user()->tokenCan('admin-users') && !$request->user()->tokenCan('admin-posts')) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient token permissions'
            ], 403);
        }

        return $next($request);
    }
}
