<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Kreait\Firebase\Contract\Auth as FirebaseAuth;

class FirebaseVerifiedMiddleware
{

    protected $auth;

    public function __construct(FirebaseAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // get userdate
        $user = $this->auth->getUser($request->session()->get('uid'));
        if (!$user->emailVerified) {
            return redirect()->route('verification.notice');
        }
        return $next($request);
    }
}
