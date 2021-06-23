<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureIsLogin
{
    public function handle(Request $request, Closure $next)
    {
        // dd(session('is_login'));
        if (!session()->exists('is_login')) {
            return response()->json([
                'code' => '401',
                'message' => 'Unauthorized'
            ]);
        }

        return $next($request);
    }
}
