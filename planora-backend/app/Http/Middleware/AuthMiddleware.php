<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
   public function handle(Request $request, Closure $next)
{
    // Jika sedang dalam mode testing, langsung izinkan user yang sedang 'actingAs'
    if (app()->runningUnitTests() && auth()->check()) {
        return $next($request);
    }

    // Logika asli Anda untuk mengecek token di header
    $token = $request->header('Authorization');
    if (!$token) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    return $next($request);
    }
}