<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PelangganMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user()->role;
        if ($user->nama_role != "pengunjung") {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response()->redirectToRoute("login")->with('error', "Silakan Login");
        }

        return $next($request);
    }
}
