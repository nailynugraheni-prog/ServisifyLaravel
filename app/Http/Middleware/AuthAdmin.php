<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = session('user');
        if (!$user || $user['role'] !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses ditolak. Hanya admin yang bisa masuk.');
        }
        return $next($request);
    }
}