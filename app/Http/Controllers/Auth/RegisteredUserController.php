<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

use Kreait\Firebase\Contract\Auth as FirebaseAuth;

class RegisteredUserController extends Controller
{
    protected $auth;
    public function __construct( FirebaseAuth $auth)
    {
        // check if user is authenticated using firebase auth
        $this->auth = $auth;
    }
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        // $users = User::all();
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);
        try {
            $email = $request->email;
            $password = $request->password;
            $userProperties = [
                'email' => $email,
                'password' => $password,
                'displayName' => $request->name,
            ];
            $firebase_user = $this->auth->createUser($userProperties);
        } catch (\Exception $e) {
            // dd($e);
            return back()->withErrors(['email' => 'The provided email is already registered.']);
        }
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->user_type = 'patient'; // 'employee' or 'patient'
            $user->uid = $firebase_user->uid;
            $user->saveToFirebase();

        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($email, $password);
            // check if the user is verified
            // if (!$signInResult->data()['emailVerified']) {
            //     return back()->withErrors(['email' => 'Please verify your email address.']);
            // }
            $user = $signInResult->data();
            $request->session()->put('firebase_token', $user['idToken']);
            $request->session()->put('uid', $user['localId']);

            // send verification email using firebase
            $this->auth->sendEmailVerificationLink($email);


            //

            // $user = new User($user);

            // event(new Registered($user));
            // Auth::login($user);
            // $request->session()->put('user', $user);
            // $request->session()->regenerate();

            return redirect(route('dashboard', absolute: false));
        } catch (\Kreait\Firebase\Auth\SignIn\FailedToSignIn $e) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }
}
