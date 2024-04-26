<?php

namespace App;

use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use Illuminate\Http\Request;
use App\Models\User;
use Kreait\Firebase\Contract\Database;

class CustomFirebaseAuth
{
    protected $auth;
    protected $database;
    public function __construct(FirebaseAuth $auth, Database $database)
    {
        // check if user is authenticated using firebase auth
        $this->auth = $auth;
        $this->database =  $database;
    }

    public function check(Request $request): bool
    {
        try {
            $token = $this->auth->verifyIdToken($request->session()->get('firebase_token'));
            if ($this->auth->getUser($token->claims()->get('sub')) && $token->claims()->get('sub') == $request->session()->get('uid')) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }


    public static function call_static(Request $request, $method)
    {
        // $auth = new CustomFirebaseAuth(app(FirebaseAuth::class));
        // use reselve
        $auth = resolve(CustomFirebaseAuth::class);
        return $auth->$method($request);
    }

    public function getUserData(Request $request)
    {
        try {
            if ($this->check($request)) {
                $user = $this->database->getReference('users')->orderByChild('uid')->equalTo($request->session()->get('uid'))->getValue();
                $key = array_keys($user)[0];
                $user[$key]['key'] = $key;
                return $user[$key];
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }
}
