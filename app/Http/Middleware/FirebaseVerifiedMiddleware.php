<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use App\Http\Facades\Auth;

class FirebaseVerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::emailVerifed($request)) {
            return redirect()->route('verification.notice');
            // return response()->json(['message' => 'Email not verified'], 403);
        }
        return $next($request);
    }
}
