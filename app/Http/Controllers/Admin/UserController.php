<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Facades\Auth;
use App\Http\Facades\Database;

class UserController extends Controller
{

    public function index()
    {
        $users = Database::getAllUsers();
        return view('admin.users.list', [
            'users' => $users,
            'emptyMessage' => 'No users found.'
        ]);
    }

    public function show(Request $request, $uid)
    {
        $user = Auth::getUserData($uid);
        $user = (object) $user;
        $teams = Database::getReferences('teams');
        return view('admin.users.detail', [
            'user' => $user,
            'teams' => $teams
        ]);
    }

    public function update (ProfileUpdateRequest $request, $uid)
    {
        $data = array();
        if (!empty($request->username)) {
            $data['username'] = $request->username;
        }
        if (!empty($request->name)) {
            $data['name'] = $request->name;
            Auth::updateUser($uid, [
                'displayName' => $request->name
            ]);
        }
        if (!empty($request->email)) {
            $data['email'] = $request->email;
            Auth::updateUser($uid, [
                'email' => $request->email
            ]);
        }

        if (!empty($request->email_verified)) {
            Auth::updateUser($uid, [
                'emailVerified' => $request->email_verified
            ]);
        }

        if (!empty($request->team_key)) {
            $data['team_key'] = $request->team_key;
        }

        if (!empty($data)) {
            Database::update('users/' . Auth::getUserData($uid)['key'], $data);
        }

        return Redirect::route('admin.users.show', ['uid' => $uid]);
    }

    public function delete (Request $request, $uid)
    {
        Database::delete('users/' . Auth::getUserData($uid)['key']);
        Auth::deleteUser($uid);
        return Redirect::route('admin.users');
    }


    public function reservations (Request $request, $uid)
    {
        $user = Auth::getUserData($uid);
        if (empty($user)) {
            return Redirect::route('admin.users');
        }
        if ($user['user_type'] == 'employee') {
            $reservations = Database::getWhere('reservations', 'employee_uid', $uid);
        } else {
            $reservations = Database::getWhere('reservations', 'user_uid', $uid);
        }
        $reservations = array_map(function ($item) {
            $item['user'] = Auth::getUserData($item['user_uid']);
            if (!empty($item['user'])) {
                return $item;
            }
        }, $reservations);
        $reservations = array_filter($reservations);
        return view('admin.users.reservations', [
            'reservations' => $reservations,
            'emptyMessage' => 'No reservations found.'
        ]);
    }

    public function employees()
    {
        $users = Database::getWhere('users', 'user_type', 'employee');
        $users = array_map(function ($user) {
            return Auth::getUserData($user['uid']);
        }, $users);
        $users = array_filter($users);
        return view('admin.users.list', [
            'users' => $users,
            'emptyMessage' => 'No employees found.'
        ]);
    }

    public function patients()
    {
        $users = Database::getWhere('users', 'user_type', 'patient');
        $users = array_map(function ($user) {
            return Auth::getUserData($user['uid']);
        }, $users);
        $users = array_filter($users);
        return view('admin.users.list', [
            'users' => $users,
            'emptyMessage' => 'No patients found.'
        ]);
    }

    public function create()
    {
        $teams = Database::getReferences('teams');
        return view('admin.users.create' , [
            'teams' => $teams
        ]);
    }

    public function store(Request $request)
    {
        $request->merge([
            'user_type' => 'employee',
        ]);
        $auth = Auth::createUser($request);
        if (!$auth) {
            return back()->withErrors([
                'email' => 'The provided email is already registered.',
            ]);
        }
        $data =  [
            'username' => $request->username,
            'user_type' => $request->user_type ? $request->user_type : 'patient',
            'uid' => $auth->uid,
            'name' => $request->name,
        ];
        if (isset($request->team_key)) {
            $data['team_key'] = $request->team_key;
        }


        Database::push('users', $data);

        Auth::sendEmailVerificationLink($request->email);

        return Redirect::route('admin.users.employees');
    }

}
