<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (Auth::check() && ($user->isAdmin() || $user->role === 'Superadmin')) {
            return $next($request);
        }

        return response()->json(['message' => 'Anda tidak memiliki izin untuk mengakses operasi ini'], 403);
    }
}
