<?php

// FirebaseGuestMiddleware
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use App\CustomFirebaseAuth;

class FirebaseGuestMiddleware
{
    protected FirebaseAuth $auth;

    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }

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
        if (CustomFirebaseAuth::call_static($request, 'check')) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
