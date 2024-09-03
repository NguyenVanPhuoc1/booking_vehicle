<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsAllowAll
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $res =  $next($request);
        return $res->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Method: HEAD, POST, PUT, PACTH, DELETE');
    }
}
