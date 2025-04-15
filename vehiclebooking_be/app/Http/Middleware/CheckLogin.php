<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && $user->role == 1) {
            // Nếu user đăng nhập và có role = 1 => Cho qua middleware
            return $next($request);
        }
        // Nếu không phải admin, trả về response 403 hoặc redirect
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
