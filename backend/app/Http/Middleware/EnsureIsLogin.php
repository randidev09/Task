<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class EnsureIsLogin
{
    public function handle(Request $request, Closure $next)
    {
        // dd(session('is_login'));
        // dd($request->request);
        $token   = $request->token;
        $user_id = $request->user_id;
        $user    = User::find($user_id);
        
        if (empty($user->token_auth) || $user->token_auth != $token) {
            return response()->json([
                'code' => '401',
                'message' => 'Unauthorized'
            ]);
        }

        return $next($request);
    }
}
