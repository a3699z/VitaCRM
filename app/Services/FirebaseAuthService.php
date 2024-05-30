<?php

namespace App\Services;


// use App\Models\User;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use Kreait\Firebase\Contract\Database;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log; // Ensure you have Log facade available

use Kreait\Laravel\Firebase\Facades\Firebase;


class FirebaseAuthService
{

    protected $auth;
    protected $database;

    public function __construct()
    {
        $this->auth = Firebase::auth();
        $this->database = Firebase::database();
    }

    public function verifyIdToken(string $idToken)
    {
        try {
            $verifiedIdToken = $this->auth->verifyIdToken($idToken);
            return $verifiedIdToken;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function createUser(array $userData)
    {
        try {
            $createdUser = $this->auth->createUser($userData);
            return $createdUser;
        } catch (\Exception $e) {
            return null;
        }
    }


    public function check(Request $request): bool
    {
        try {
            // if (empty($request->session()->get('firebase_token')) && !empty($request->session()->get('firebase_refresh_token'))) {
            //     $token = $this->auth->signInWithRefreshToken($request->session()->get('firebase_refresh_token'));
            // } else {
                $token = $this->auth->verifyIdToken($request->session()->get('firebase_token'));
            // }
            if ($this->auth->getUser($token->claims()->get('sub'))) {
                $request->session()->put('uid', $token->claims()->get('sub'));
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function emailVerifed(Request $request): bool
    {
        $token = $request->bearerToken();
        try {
            $token = $this->auth->verifyIdToken($request->session()->get('firebase_token'));
            if ($this->auth->getUser($token->claims()->get('sub')) && $token->claims()->get('sub') == $request->session()->get('uid')) {
                return $this->auth->getUser($token->claims()->get('sub'))->emailVerified;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function hello() {
        return 'hello';
    }

    public function getUID(Request $request = null)
    {
        if ($request == null) {
            $request = new Request();
        }
        try {
            if ($this->check($request)) {
                return $request->session()->get('uid');
            } else {
                return null;
            }
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function getUserData($uid = null)
    {
        try {
            $user = $this->database->getReference('users')->orderByChild('uid')->equalTo($uid)->getValue();
            $key = array_keys($user)[0];
            $user[$key]['key'] = $key;
            return $user[$key];
        } catch (\Throwable $th) {
            return null;
        }
    }
}

