<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\Response;

class LevelAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            abort(403, 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();
        
        // Cek role_id user
        if ($user && $user->role_id == 1) {
            return $next($request);    
        }

        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
