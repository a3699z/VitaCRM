<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
// firebase auth
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
// firebase database
use Kreait\Firebase\Contract\Database;
use App\CustomFirebaseAuth;

class EmailVerificationPromptController extends Controller
{

    protected $auth;
    protected $database;
    public function __construct( FirebaseAuth $auth, Database $database)
    {
        // check if user is authenticated using firebase auth
        $this->auth = $auth;
        $this->database = $database;
    }
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        // return $request->user()->hasVerifiedEmail()
        //             ? redirect()->intended(route('dashboard', absolute: false))
        //             : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);

        $user = CustomFirebaseAuth::call_static($request, 'getUserData');

        if ($user) {
            return isset($user['email_verified_at'])
                ? redirect()->intended(route('site.index', absolute: false))
                : Inertia::render('Auth/VerifyEmail', ['status' => session('status')]);
        } else {
            return redirect()->route('login');
        }

    }
}
