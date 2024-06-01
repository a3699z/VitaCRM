<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Facades\Auth;
use App\Http\Facades\Database;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Intervention\Image\Drivers\Gd\Driver;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use Kreait\Firebase\Contract\Database as FirebaseDatabase;
use Intervention\Image\ImageManager;

// user query
// use Kreait\Firebase\Auth\UserInfo;
// use Kreait\Firebase\Contract\Database;
use App\Models\User;
use App\CustomFirebaseAuth;
// use Intervention\Image\ImageManager;

class ProfileController extends Controller
{

    protected $auth;

    protected $database;

    public function __construct( FirebaseAuth $auth, FirebaseDatabase $database)
    {
        // check if user is authenticated using firebase
        // dd(app('firebase.auth'));
        $this->auth = $auth;
        // get authenticated user
        // dd($this->auth->getUser(session()->get('uid')));
        // $user = UserInfo::
        $this->database = $database;


    }

    public function visit(Request $request, $key)
    {
        $loggedInUser = Auth::getUID();
        $reservation = Database::getOneReference('reservations/' . $key);
        if ($reservation['is_online'] == true) {
            $call = Database::getOneWhere('calls', 'reservation_key', $key);
        }
        if (!empty($call)) {
            $reservation['call'] = $call;
        }
        if ($reservation['employee_uid'] == $loggedInUser) {
            $reservation['patient'] = Auth::getUserData($reservation['user_uid']);
            return Inertia::render('Profile/Employee/Visit/index', [
                'reservation' => $reservation
            ]);
        } else if ($reservation['user_uid'] == $loggedInUser) {
            $reservation['employee'] = Auth::getUserData($reservation['employee_uid']);
            return Inertia::render('Profile/Patient/Visit/index', [
                'reservation' => $reservation
            ]);
        } else {
            return Redirect::route('profile.index');
        }
    }

    /**
     * Display the user's profile.
     */

    public function index(Request $request): Response
    {
        $user_data = Auth::getUserData();
        if ($user_data['user_type'] == 'employee') {
            $reservations = Database::getWhere('reservations', 'employee_uid', $user_data['uid']);
            $reservations = array_map(function($reservation) {
                $reservation['patient'] = Auth::getUserData($reservation['user_uid']);
                if (!empty($reservation['patient'])) {
                    return $reservation;
                }
            }, $reservations);
            $reservations = array_filter($reservations);
            return Inertia::render('Profile/Employee/index', [
                'user' => $user_data,
                'status' => session('status'),
                'reservations' => $reservations
            ]);
        } else {
            $reservations = Database::getWhere('reservations', 'user_uid', $user_data['uid']);
            $reservations = array_map(function($reservation) {
                $reservation['employee'] = Auth::getUserData($reservation['employee_uid']);
                // if (!empty($reservation['employee'])) {
                    return $reservation;
                // }
            }, $reservations);
            // $reservations = array_filter($reservations);
            // dd($reservations);
            return Inertia::render('Profile/Patient/index', [
                'user' => $user_data,
                'status' => session('status'),
                'reservations' => $reservations
            ]);
        }

    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $data = array();
        if ($request->hasFile('profileImage')) {
            $image = $request->file('profileImage');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('images/' . $filename);
            $request->file('profileImage')->move(public_path('images'), $filename);
            $data['profile_image'] = $filename;


            // $filename = Auth::getUID(). time() .  '.'. $image->getClientOriginalExtension();

            // $manager = new ImageManager(
            //     new \Intervention\Image\Drivers\Gd\Driver()
            // );
            // try {
            //     $manager->read($image->getPathname())->resize(100, 100)->save(public_path('images/thumbnails' . $filename));
            //     $manager->read($image->getPathname())->save(public_path('images/' . $filename));
            //     $data['profile_image'] = $filename;
            // } catch (\Exception $e) {
            //     return response()->json(['error'=>$e->getMessage()], 401);
            // }

        }
        if (!empty($request->userName)) {
            $data['username'] = $request->userName;
        }
        if (!empty($request->name)) {
            $data['name'] = $request->name;
            Auth::updateUser(Auth::getUID(), [
                'displayName' => $request->name
            ]);
        }
        if (!empty($request->email)) {
            $data['email'] = $request->email;
            Auth::updateUser(Auth::getUID(), [
                'email' => $request->email
            ]);
        }

        if (!empty($data)) {
            Database::update('users/' . Auth::getUserData()['key'], $data);
        }

        return Redirect::route('profile.index');
    }

    public function update_employee_info(Request $request) {
        $data = array();
        if (!empty($request->summary)) {
            $data['summary'] = $request->summary;
        }
        if (!empty($request->university)) {
            $data['university'] = $request->university;
        }
        if (!empty($request->department)) {
            $data['department'] = $request->department;
        }
        if (!empty($request->certificate_source)) {
            $data['certificate_source'] = $request->certificate_source;
        }
        if (!empty($request->certificate)) {
            $data['certificate'] = $request->certificate;
        }
        if (!empty($request->specializations)) {
            $data['specializations'] = $request->specializations;
        }
        if (!empty($request->profession)) {
            $data['profession'] = $request->profession;
        }
        if (!empty($data)) {
            Database::update('users/' . Auth::getUserData('5dbRVqRkk4hFAVjgx8XRtzMY7xj1')['key'], $data);
        }
        return Redirect::route('profile.index');
    }



}
