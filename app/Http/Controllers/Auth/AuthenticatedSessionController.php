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
use App\Models\User;
// use firebase auth
use Kreait\Firebase\Contract\Auth as FirebaseAuth;


class AuthenticatedSessionController extends Controller
{
    protected $auth;
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
        // $verifyIdToken = $this->auth->verifyIdToken('eyJhbGciOiJSUzI1NiIsImtpZCI6ImEyMzhkZDA0Y2JhYTU4MGIzMDRjODgxZTFjMDA4ZWMyOGZiYmFkZGMiLCJ0eXAiOiJKV1QifQ.eyJuYW1lIjoiYWhtZWQgbW9oYW1lZCBtYWhtb3VkIiwiaXNzIjoiaHR0cHM6Ly9zZWN1cmV0b2tlbi5nb29nbGUuY29tL2phbWVkYS04NGVhMCIsImF1ZCI6ImphbWVkYS04NGVhMCIsImF1dGhfdGltZSI6MTcxMzk0NzQ3MCwidXNlcl9pZCI6InlwdkQzQUpXVzJYTFlMdVNwMjBOVDhwV0pFajIiLCJzdWIiOiJ5cHZEM0FKV1cyWExZTHVTcDIwTlQ4cFdKRWoyIiwiaWF0IjoxNzEzOTQ3NDcwLCJleHAiOjE3MTM5NTEwNzAsImVtYWlsIjoiemlkYW5haG1lZDA4NEBnbWFpbC5jb20iLCJlbWFpbF92ZXJpZmllZCI6dHJ1ZSwiZmlyZWJhc2UiOnsiaWRlbnRpdGllcyI6eyJlbWFpbCI6WyJ6aWRhbmFobWVkMDg0QGdtYWlsLmNvbSJdfSwic2lnbl9pbl9wcm92aWRlciI6InBhc3N3b3JkIn19.BiVq9MBKlvpxSAtWGeHEKfkKT3znfF4sNsIfnxcJwy2G5wb2mByGmM7wZbKZENU4W8aQs-02NbNFRS0EKtAywfRr1mS6tgOO5mDe3fTvK7-Xx2yP-oDJcQz-vWTw4hXkiY24RfJTBTcpC7x5bpJuBCdnYgXSkMSnkCViOPofMU-S9qFoSCXQrUmGSqDWCtxZASLkbInaQjbBCiLS4SdZJxYm78sUppCPrJTao5tX5fuG3Cf2tjKTcQPZlWc7GH8nC8Y2yXov5FP2zblsd-cxpo48JD4RaurnJjzzpR3C8m5-zFINT0RL_M9saNjGZgL-XOEYuBsnwQNNyC58r4pBnw');
        // dd($verifyIdToken->claims());
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

        try {
            $email = $request->email;
            $password = $request->password;
            $signInResult = $this->auth->signInWithEmailAndPassword($email, $password);
            $user = $signInResult->data();
            // dd($user);
            $request->session()->put('firebase_token', $user['idToken']);
            $request->session()->put('uid', $user['localId']);
            // dd(Auth::attempt(['email' => $email, 'password' => $password]));
            // dd($request->session()->get('firebase_token'));

            if (!empty($request->ref) && $request->ref == 'reserve') {
                return redirect()->intended(route('reservation.create'));
            }
            return redirect()->intended(route('dashboard', absolute: false));
        } catch (\Kreait\Firebase\Auth\SignIn\FailedToSignIn $e) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
