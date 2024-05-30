<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use Kreait\Firebase\Contract\Database;

use App\Http\Facades\Auth;

class SiteController extends Controller
{
    //
    protected $auth;
    protected $database;

    public function __construct(FirebaseAuth $auth, Database $database)
    {

        // dd(Auth::hello('ahmed'));
        // check if user is authenticated using firebase auth
        $this->auth = $auth;
        $this->database = $database;
    }

    public function index()
    {

        $employees = $this->database->getReference('users')->orderByChild('user_type')->equalTo('employee')->getValue();
        $employees = array_map(function ($employee, $key) {
            $employee['key'] = $key;
            return $employee;
        }, $employees, array_keys($employees));
        // dd($employees);
        return Inertia::render('Welcome/index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'employees' => $employees
        ]);
    }
}
