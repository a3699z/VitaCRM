<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        // dd(session()->flash('status'));
        return Inertia::render('Auth/Login/index', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
            // 'ref' => isset($_GET['ref']) && !empty($_GET['ref']) ? $_GET['ref'] : ''
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'checked' => 'required|accepted',
        ]);

        // dd($request->all());
        try {
            $user = Auth::signInWithEmailAndPassword($request);
            if ($user != 'success') {
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ]);
            }

            // Auth::sendEmailVerificationLink($request->email);

        } catch (\Kreait\Firebase\Auth\SignIn\FailedToSignIn $e) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }


        if (!empty($request->ref) && $request->ref == 'reserve') {
            return redirect()->intended(route('reservation.create'));
        }
        return redirect()->intended(route('site.index', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::signOut();

        return redirect('/');
    }
}
