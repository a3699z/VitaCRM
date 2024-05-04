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

class ProfileController extends Controller
{

    protected $auth;

    protected $database;

    public function __construct( FirebaseAuth $auth, Database $database)
    {
        // check if user is authenticated using firebase
        // dd(app('firebase.auth'));
        $this->auth = $auth;
        // get authenticated user
        // dd($this->auth->getUser(session()->get('uid')));
        // $user = UserInfo::
        $this->database = $database;


    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        // dd(Auth::user());
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        // $request->user()->save();

        $user = CustomFirebaseAuth::call_static($request, 'getUserData');
        try {
            $userKey = $user['key'];
            $user = $this->database->getReference('users/' . $userKey)->getSnapshot()->getValue();
            $user['name'] = $request->name;
            $user['middle_name'] = $request->middle_name;
            $user['surname'] = $request->surname;
            $user['date_of_birth'] = $request->date_of_birth;
            $this->database->getReference('users/' . $userKey)->set($user);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return Redirect::route('profile.edit');
    }

    public function update_patientinfo(Request $request): RedirectResponse
    {
        $user = CustomFirebaseAuth::call_static($request, 'getUserData');
        try {
            $userKey = $user['key'];
            $user = $this->database->getReference('users/' . $userKey)->getSnapshot()->getValue();
            $user['legal_guardian'] = $request->legal_guardian;
            $user['level_of_care'] = $request->level_of_care;

            $this->database->getReference('users/' . $userKey)->set($user);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // update_dates
    public function update_dates(Request $request): RedirectResponse
    {
        $dates = $request->dates;
        $avialable_dates = array();
        foreach($dates as $date) {
            // check if date is today or in the future
            if ($date['date'] != null && !empty($date['hours']) && strtotime($date['date']) >= strtotime(date('Y-m-d'))) {
                $hours = array();
                foreach ($date['hours'] as $hour) {
                    if (!empty($hour) && strtotime($date['date'] . ' ' . $hour) >= strtotime(date('Y-m-d H:i'))) {
                        $hours[] = $hour;
                    }
                }
                $avialable_dates[] = array(
                    'date' => $date['date'],
                    'hours' => $hours
                );

            }
        }
        $user = CustomFirebaseAuth::call_static($request, 'getUserData');
        try {
            $userKey = $user['key'];
            $this->database->getReference('users/' . $userKey . '/available_dates')->set($avialable_dates);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }




        // $user = Auth::user();
        // if ($user->user_type != 'employee') {
        //     return Redirect::route('profile.edit');
        // }
        // $user->available_dates = $avialable_dates;
        // $user->save();

        return Redirect::route('profile.edit');
    }

    // update_contacts
    public function update_contacts(Request $request): RedirectResponse
    {
        // $contacts = $request->contacts;
        $user = CustomFirebaseAuth::call_static($request, 'getUserData');
        try {
            $userKey = $user['key'];
            // foreach of request contacts
            $contacts = $request->all();
            // update user
            foreach ($contacts as $key => $value) {
                if ($key != '_token' && $key != '_method') {
                    $this->database->getReference('users/' . $userKey . '/' . $key)->set($value);
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        // $user = Auth::user();
        // if ($user->user_type != 'employee') {
        //     return Redirect::route('profile.edit');
        // }
        // $user->contacts = $contacts;
        // $user->save();

        return Redirect::route('profile.edit');
    }

    public function update_professional(Request $request): RedirectResponse
    {
        $user = CustomFirebaseAuth::call_static($request, 'getUserData');
        try {
            $userKey = $user['key'];
            // foreach of request contacts
            $professional = $request->all();
            // update user
            foreach ($professional as $key => $value) {
                if ($key != '_token' && $key != '_method') {
                    $this->database->getReference('users/' . $userKey . '/' . $key)->set($value);
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return Redirect::route('profile.edit');
    }
}
