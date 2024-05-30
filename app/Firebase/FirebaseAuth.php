<?php

namespace App\Firebase;


// use App\Models\User;
use App\Http\Facades\Database;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log; // Ensure you have Log facade available

use Kreait\Laravel\Firebase\Facades\Firebase;
use App\Models\User;

class FirebaseAuth
{

    protected $auth;
    protected $database;

    protected $session;


    public function __construct()
    {
        $this->auth = Firebase::auth();
        $this->database = Firebase::database();
        $this->session = session();
    }

    // get id token from refresh token if id token is expired
    public function getIdToken()
    {
        // check if user is authenticated using firebase auth

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


    public function renewIdToken( $refreshToken = null)
    {

        try {
            $newToken = $this->auth->signInWithRefreshToken($refreshToken);
            return $newToken;
        } catch (\Exception $e) {
            return null;
        }
    }


    public function check(): bool
    {
        $firebase_token = $this->session->get('firebase_token');
        if (empty($firebase_token)) {
            return false;
        }
        try {
            $token = $this->auth->verifyIdToken($firebase_token);
            $this->session->put('uid', $token->claims()->get('sub'));
            return true;
        } catch (\Kreait\Firebase\Exception\AuthException $e) {
            if (!empty($this->session->get('firebase_refresh_token'))) {
                $idToken = $this->renewIdToken(session('firebase_refresh_token'));
                if ($idToken) {
                    $this->session->put('firebase_token', $idToken->idToken());
                    $this->session->put('uid', $this->auth->verifyIdToken($idToken->idToken())->claims()->get('sub'));
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public function createUser(Request $request)
    {
        try {
            $email = $request->email;
            $password = $request->password;
            $userProperties = [
                'email' => $email,
                'password' => $password,
                'displayName' => $request->name,
            ];
            $firebase_user = $this->auth->createUser($userProperties);
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'The provided email is already registered.']);
        }

        try {

            Database::push('users', [
                'username' => $request->username,
                'user_type' => 'patient',
                'uid' => $firebase_user->uid,
            ]);
            $this->signInWithEmailAndPassword($request);
            $this->sendEmailVerificationLink($email);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function sendEmailVerificationLink($email)
    {
        try {
            $this->auth->sendEmailVerificationLink($email);
        } catch (\Throwable $th) {
            return null;
        }
    }

    // make this email verified using oobCode and apiKey
    // public function verifyEmail(Request $request)
    // {
    //     try {
    //         $this->auth->verifyEmail($request->oobCode);
    //     } catch (\Throwable $th) {
    //         return null;
    //     }
    // }

    public function signOut()
    {
        try {
            $this->auth->revokeRefreshTokens($this->session->get('uid'));
            $this->session->forget('firebase_token');
            $this->session->forget('uid');
            $this->session->forget('firebase_refresh_token');
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function signInWithEmailAndPassword(Request $request)
    {
        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($request->email, $request->password);
            $user = $signInResult->data();
            $request->session()->put('firebase_token', $user['idToken']);
            $request->session()->put('uid', $user['localId']);
            $request->session()->put('firebase_refresh_token', $user['refreshToken']);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function revokeRefreshTokens(string $uid)
    {
        try {
            return $this->auth->revokeRefreshTokens($uid);
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function emailVerifed(Request $request): bool
    {
        // $token = $request->bearerToken();
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


    public function getUID()
    {
        return $this->session->get('uid');
    }

    public function getUserData($uid = null)
    {
        if ($uid == null) {
            $uid = $this->getUID();
        }
        try {
            $user = $this->auth->getUser($uid);
            $user_data = $this->database->getReference('users')->orderByChild('uid')->equalTo($uid)->getValue();
            $user_data = array_map(function ($value, $key) {
                $value['key'] = $key;
                return $value;
            }, $user_data, array_keys($user_data));
            $user_data = $user_data[0];
            $user_data['emailVerified'] = $user->emailVerified;
            $user_data['email'] = $user->email;
            $user_data['name'] = $user->displayName;
            return $user_data;
        } catch (\Throwable $th) {
            return null;
        }
    }

    public function employee()
    {
        $user = $this->getUserData();
        if ($user['user_type'] == 'employee') {
            return true;
        } else {
            return false;
        }
    }


    public function patient()
    {
        $user = $this->getUserData();
        if ($user['user_type'] == 'patient') {
            return true;
        } else {
            return false;
        }
    }
}

