<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Facades\Auth;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::getUserData();
        Auth::sendEmailVerificationLink($user['email']);
        return back()->with('status', 'verification-link-sent');
    }
}
