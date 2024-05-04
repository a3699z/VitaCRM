<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
// suer firebase databse
use  Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
// firebase fail to create user
use Kreait\Firebase\Exception\Auth\EmailExists;

class UserController extends Controller
{
    protected $database;
    protected $auth;
    public function __construct( Database $database, FirebaseAuth $auth)
    {
        $this->database = $database;
        $this->auth = $auth;
    }

    public function index(): Response
    {
        $users = $this->database->getReference('users')->getValue();
        $users = array_map(function($user, $key){
            $user['key'] = $key;
            $user['team'] = isset($user['team_key']) ? $this->database->getReference('teams/'.$user['team_key'])->getValue() : [];
            return $user;
        }, $users, array_keys($users));
        return Inertia::render('Admin/Users', [
            'users' => $users
        ]);
    }

    public function show(Request $request, $uid): Response
    {
        $user = new User();
        $user = $user->getByUID($uid);
        return Inertia::render('Admin/ShowUser', [
            'user' => $user
        ]);
    }

    public function delete (Request $request): RedirectResponse
    {
        $user = new User();
        $user = $user->getByUID($request->uid);
        // dd($user);
        $this->database->getReference('users/'.$user['key'])->remove();
        $this->auth->deleteUser($request->uid);
        return Redirect::route('admin.users');
    }


}
