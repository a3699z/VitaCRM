<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CustomFirebaseAuth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        // if (!Auth::check() || !Auth::user()->is_admin) {
        if (!CustomFirebaseAuth::check($request) || !CustomFirebaseAuth::call_static($request, 'getUserData')['is_admin']) {
            // inherita admin layout
            return redirect('/');
        }
        return $next($request);

    }
}
