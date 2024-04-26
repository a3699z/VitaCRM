<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use App\CustomFirebaseAuth;


class FirebaseAuthMiddleware
{
    protected $auth;

    public function __construct( FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!CustomFirebaseAuth::call_static($request, 'check')) {
            return redirect()->route('login');
        }

        // dd(CustomFirebaseAuth::call_static($request, 'check'));

        // $idToken = $request->session()->get('firebase_token');

        //     // dd($request->session()->get('firebase_token'));
        //     // dd($idToken);
        // if (!$idToken) {
        //     return redirect()->route('login');
        // }
        // try {
        //     $verifyIdToken = $this->auth->verifyIdToken($idToken);
        //     $request->merge(['uid' => $verifyIdToken->claims()->get('sub')]);
        // } catch (\Throwable $th) {
        //     return redirect()->route('login');
        // }

        return $next($request);
    }
}
