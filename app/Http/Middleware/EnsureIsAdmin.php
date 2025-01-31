<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->is_admin) {
            return response()->json([
                'error' => 'Unauthorized. Admin access required.',
                'user' => $user,
                'is_admin' => $user ? $user->is_admin : null,
            ], 403);
        }
        return $next($request);
    }
    // public function handle(Request $request, Closure $next): Response
    // {
    //     // Check if the user is authenticated
    //     $isAuthenticated = auth()->check();
    //     $isAdmin = $isAuthenticated ? auth()->user()->is_admin : false; // Access is_admin only if authenticated

    //     // If not authenticated or not an admin, return error with debug info
    //     if (!$isAuthenticated || !$isAdmin) {
    //         return response()->json([
    //             'error' => 'Unauthorized. Admin access required.',
    //             'authenticated' => $isAuthenticated,
    //             'is_admin' => $isAdmin,
    //         ], 403);
    //     }

    //     return $next($request);
    // }
}
