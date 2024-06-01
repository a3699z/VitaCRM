<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Facades\Auth;
use App\Http\Facades\Database;

class AdminController extends Controller
{
    //
    public function dashboard(){
        $totals = [
            'users' => count(Database::getReferences('users')),
            'employees' => Database::countWhere('users', 'user_type', 'employees'),
            'reservations' => count(Database::getReferences('reservations')),
            'teams' => count(Database::getReferences('teams')),
        ];
        return view('admin.dashboard', ['totals' => $totals]);
    }
}
