<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\CustomFirebaseAuth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/dashboard');
        }

        // $request->user()->sendEmailVerificationNotification();

        // send a verifiacation email to the user from the firebase
        $user = CustomFirebaseAuth::call_static($request, 'getUserData');
        if ($user) {
            dd($user['uid'], $user['email']);
            $url = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $user['uid'],
                    'hash' => sha1($user['email']),
                ]
            );
            dd($url);
        }



        return response()->json(['status' => 'verification-link-sent']);
    }
}
