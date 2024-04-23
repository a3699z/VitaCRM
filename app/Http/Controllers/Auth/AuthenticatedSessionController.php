<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
// use firebase auth
use Kreait\Firebase\Contract\Auth as FirebaseAuth;


class AuthenticatedSessionController extends Controller
{
    public function __construct( FirebaseAuth $auth)
    {
        // check if user is authenticated using firebase auth


        // $this->middleware('guest')->except('logout');
        $this->auth = $auth;
    }


    /**
     * Display the login view.
     */
    public function create(): Response
    {
        // // check if user is authenticated using firebase auth
        $verifyIdToken = $this->auth->verifyIdToken('eyJhbGciOiJSUzI1NiIsImtpZCI6IjJkOWI0ZTY5ZTMyYjc2MTVkNGNkN2NhZmI4ZmM5YjNmODFhNDFhYzAiLCJ0eXAiOiJKV1QifQ.eyJuYW1lIjoiQWhtZWQgTW9oYW1lZCBJYnJhaGltIE1hIiwiaXNzIjoiaHR0cHM6Ly9zZWN1cmV0b2tlbi5nb29nbGUuY29tL2phbWVkYS04NGVhMCIsImF1ZCI6ImphbWVkYS04NGVhMCIsImF1dGhfdGltZSI6MTcxMzg3MDgzNCwidXNlcl9pZCI6IjhaYmlRbDFDWmxZS1hrN1VtN2JTZndtU1Y2RTIiLCJzdWIiOiI4WmJpUWwxQ1psWUtYazdVbTdiU2Z3bVNWNkUyIiwiaWF0IjoxNzEzODcwODM0LCJleHAiOjE3MTM4NzQ0MzQsImVtYWlsIjoiZGV2ZWxvcGVyQHZpaS52aXAtdml0YWxpc3Rlbi5kZSIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiZmlyZWJhc2UiOnsiaWRlbnRpdGllcyI6eyJlbWFpbCI6WyJkZXZlbG9wZXJAdmlpLnZpcC12aXRhbGlzdGVuLmRlIl19LCJzaWduX2luX3Byb3ZpZGVyIjoicGFzc3dvcmQifX0.pq8-28cDhPGD18PCNG7ddG7ylLXmWQNwxqMdDSiYJdoOTIIpaKwQ7s4lfUzI0BhuNg8tTez-_1qfL8guRbd6pa3cclTDEs23lZ7RZHwq_cJo8rDPdykDK967Io4jMlLRK-dedZLPPt2Q47e1ieB8OrmwFBJj_EhllzD2NWQF7ck7yiX47oUPQrdDPqAo66ISys1bH90gzhZgOmMgIWw0LkCimFIVaUPd8xn3CO2-gkA57Ckvm-nfcYYPdShGzZ5Z2UIvDRv5TlfZ9YWaltFKE_yEOPbVNj2vqeUYXXiIv_WI7e-ZxVPTwmnpepMFc_cvbmm44iTOYzKdRqV9xjIUPA');
        // $uid = $verifyIdToken->getClaim('sub');
        dd($verifyIdToken);
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
            // 'ref' => isset($_GET['ref']) && !empty($_GET['ref']) ? $_GET['ref'] : ''
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $request->authenticate();

        // $request->session()->regenerate();

        // if (!empty($request->ref) && $request->ref == 'reserve') {
        //     return redirect()->intended(route('reservation.create'));
        // }


        // return redirect()->intended(route('dashboard', absolute: false));
        $email = $request->email;
        $password = $request->password;
        $signInResult = $this->auth->signInWithEmailAndPassword($email, $password);
        $user = $signInResult->data();
        dd($user);
        $request->session()->put('user', $user);
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
