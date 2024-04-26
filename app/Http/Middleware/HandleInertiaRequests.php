<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use App\Models\User;
use App\CustomFirebaseAuth;


class HandleInertiaRequests extends Middleware
{

    protected $auth;
    public function __construct( FirebaseAuth $auth)
    {
            $this->auth = $auth;
    }
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        // $idToken = $request->session()->get('firebase_token');
        // if ($idToken) {
        //     try {
        //         $verifyIdToken = $this->auth->verifyIdToken($idToken);
        //         // $request->session()->put('user', $verifyIdToken->claims());
        //         // get user data from firebase
        //         $user = $this->auth->getUser($verifyIdToken->claims()->get('sub'));
        //         // dd($user);
        //         if ($user) {
        //            $user_data =  new User();
        //            $user_data = $user_data->getByKey('uid', $user->uid);
        //         }
        //     } catch (\Throwable $th) {
        //         $user_data = null;
        //         $request->session()->forget('firebase_token');
        //         $request->session()->forget('user');
        //     }
        // } else {
        //     $user_data = null;
        // }


        $user_data = CustomFirebaseAuth::call_static($request, 'getUserData');


        return [
            ...parent::share($request),
            'auth' => [
                // 'user' => $request->session()->get('user'),
                'user' => $user_data,
            ],
        ];

        // return [
        //     ...parent::share($request),
        //     'auth' => [
        //         // 'user' => $request->session()->get('user'),
        //         'user' => $request->user(),
        //     ],
        // ];
    }
}
