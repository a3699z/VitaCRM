<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\CustomFirebaseAuth;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use App\Models\User;
// mail
use Illuminate\Support\Facades\Mail;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;

class EmailVerificationNotificationController extends Controller
{
    protected $auth;

    public function __construct(FirebaseAuth $auth)
    {
        // check if user is authenticated using firebase auth
        $this->auth = $auth;
    }
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        // send verification email using firebase
        $user = $this->auth->getUser($request->session()->get('uid'));
        // dd($user);
        if (!$user->emailVerified) {
            // send email verification

            $this->auth->sendEmailVerificationLink($user->email);
        }
        // $request->user()->sendEmailVerificationNo
        // if ($request->user()->hasVerifiedEmail()) {
        //     return redirect()->intended(route('dashboard', absolute: false));
        // }
        $user = CustomFirebaseAuth::call_static($request, 'getUserData');
        if ($user) {
            if (isset($user['email_verified_at'])) {
                return redirect()->intended(route('dashboard', absolute: false));
            }
        }
        $user = CustomFirebaseAuth::call_static($request, 'getUserData');
        if ($user) {
            // dd($user['uid'], $user['email']);
            // $url = URL::temporarySignedRoute(
            //     'verification.verify',
            //     Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            //     [
            //         'id' => $user['uid'],
            //         'hash' => sha1($user['email']),
            //     ]
            // );

        }
        // // send a verification email to the user from the firebase
        // $message = new MailMessage();
        // $message->greeting('Hello!');
        // $message->subject('Verify your email address');
        // $message->line('Please click the button below to verify your email address.');
        // $message->action('Verify Email Address', $url);
        // $message->line('If you did not create an account, no further action is required.');
        // $message->salutation('Thank you!');

        // $send = new VerifyEmail($message);
        // send email to user from the firebase
        // Mail::to($user['email'])->send($message);
        // dd($message);

        // $request->user()->sendEmailVerificationNotification();
        $user = new User();
        $user->email = $user['email'];
        $user->email_verified_at = null;
        $user->sendEmailVerificationNotification();



        return back()->with('status', 'verification-link-sent');
    }
}
