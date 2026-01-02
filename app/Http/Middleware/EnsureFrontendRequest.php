<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureFrontendRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check for a custom header that your frontend should send
        // Note: This is not 100% secure as it can be spoofed, but prevents accidental/casual misuse.
        // For browser-based protection, rely on CORS.
        
        $expectedSecret = env('FRONTEND_SECRET');

        // If no secret is configured, we might skip or fail. Let's assume we want to enforce it if set.
        if ($expectedSecret && $request->header('X-Frontend-Secret') !== $expectedSecret) {
            return response()->json(['message' => 'Unauthorized source.'], 403);
        }

        return $next($request);
    }
}
