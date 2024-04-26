<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use App\CustomFirebaseAuth;


class PasswordController extends Controller
{

    protected $auth;
    public function __construct( FirebaseAuth $auth)
    {
        // check if user is authenticated using firebase auth
        $this->auth = $auth;
    }
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            // 'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);
        // dd($validated);
        // $request->user()->update([
        //     'password' => Hash::make($validated['password']),
        // ]);

        // get firebase token


        $idToken = $request->session()->get('firebase_token');
        $verifiedIdToken = $this->auth->verifyIdToken($idToken);
        $user = $this->auth->getUser($verifiedIdToken->claims()->get('sub'));
        // $user  = CustomFirebaseAuth::call_static($request, 'getUserData');

        try {
            $this->auth->changeUserPassword($user->uid,  $request->password);
        } catch (\Exception $e) {
            return back()->withErrors(['current_password' => $e->getMessage()]);
        }


        return back();
    }
}
