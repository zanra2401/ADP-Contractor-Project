<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTelpNumValid
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
                'nomor_telp' => 'max:12|required|regex:/^[0-9]{1,12}$/|unique:App\Models\User,nomor_telepon'
            ],
            [
                'nomor_telp.*' => 'Nomor Telepon Tidak Valid'
            ]
        );

        return $next($request);
    }
}
