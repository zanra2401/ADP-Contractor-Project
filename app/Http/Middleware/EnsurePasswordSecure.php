<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePasswordSecure
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $validated = $request->validate(
            [
                'password' => 'required|regex:/^(?=.*[A-Za-z])(?=.*[0-9]).{8,}$/|confirmed',
            ],
            [
                'password.*' => 'Password Tidak Valid'
            ],
        );
        
        return $next($request);
    }
}
