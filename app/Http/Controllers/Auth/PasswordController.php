<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
// use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use App\Http\Facades\Auth;
use App\CustomFirebaseAuth;


class PasswordController extends Controller
{

    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        if (!Auth::checkCurrentPassword(Auth::getUID(), $request->current_password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        try {
            Auth::changeUserPassword(Auth::getUID(), $request->password);
        } catch (\Exception $e) {
            return back()->withErrors(['current_password' => $e->getMessage()]);
        }


        return back();
    }
}
