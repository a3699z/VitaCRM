<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
// user query
// use Kreait\Firebase\Auth\UserInfo;
use Kreait\Firebase\Contract\Database;
use App\Models\User;
use App\CustomFirebaseAuth;


class SettingsController extends Controller
{
    protected $auth;

    protected $database;

    public function __construct( FirebaseAuth $auth, Database $database)
    {
        $this->auth = $auth;
        $this->database = $database;
    }


    /**
     * Display the user's settings form.
     */
    public function edit(Request $request): Response
    {
        // dd(Auth::user());
        return Inertia::render('Settings/Edit');
    }

    /**
     * Update the user's Settings information.
     */




}
