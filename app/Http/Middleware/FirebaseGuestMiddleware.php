<?php

// FirebaseGuestMiddleware
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Facades\Auth;
use App\CustomFirebaseAuth;

class FirebaseGuestMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        // $idToken = $request->session()->get('firebase_token');
        // if ($idToken) {
        //     $verifyIdToken = $this->auth->verifyIdToken($idToken);
        //     // $request->merge(['uid' => $verifyIdToken->claims()->get('sub')]);
        //     if ($verifyIdToken) {
        //         return redirect()->route('dashboard');
        //     }
        // }
        // if (CustomFirebaseAuth::call_static($request, 'getUserData')) {
        if (Auth::check()) {
            return redirect()->route('site.index');
        }
        return $next($request);
    }
}
