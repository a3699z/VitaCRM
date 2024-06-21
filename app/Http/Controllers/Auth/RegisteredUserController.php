<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Facades\Auth;
use App\Http\Facades\Database;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        // $users = User::all();
        return Inertia::render('Auth/Register/index');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255',
            'password' => ['required', Rules\Password::defaults()],
            'checked' => 'required|accepted',
        ]);

        try {

            $auth = Auth::createUser($request);
            if (!$auth) {
                return back()->withErrors([
                    'email' => 'The provided email is already registered.',
                ]);
            }


            $data =  [
                'username' => $request->username,
                'user_type' => $request->user_type ? $request->user_type : 'patient',
                'uid' => $auth->uid,
                'name' => $request->name,
            ];
            if (isset($request->team_key)) {
                $data['team_key'] = $request->team_key;
            }

            // Database::push('users', $data);

            Database::set('users/'. $auth->uid, $data);

            Auth::signInWithEmailAndPassword($request);

            Auth::sendEmailVerificationLink($request->email);

            return redirect(route('site.index', absolute: false));
        } catch (\Kreait\Firebase\Auth\SignIn\FailedToSignIn $e) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }
}
