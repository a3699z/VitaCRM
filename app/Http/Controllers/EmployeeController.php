<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use App\CustomFirebaseAuth;

use App\Http\Facades\Auth;
// firebase auth

use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use Kreait\Firebase\Contract\Database;

class EmployeeController extends Controller
{

    protected $auth;
    protected $database;

    public function __construct(FirebaseAuth $auth, Database $database)
    {
        // check if user is authenticated using firebase auth
        $this->auth = $auth;
        $this->database = $database;
    }
    /**
     * show all employees
     */

    public function index(): Response
    {
        // get employees from database

        return Inertia::render('Admin/Employees', [
            'employees' => $employees
        ]);
    }
    /**
     * store employee
     */

    //  return array json of employees
    public function search(Request $request): JsonResource
    {
        // get teh toekn from the header
        // $token = $request->header('Authorization');
        // // get the toke from the token
        // $token = explode('Bearer ', $token)[1];
        // dd($token);
        // // check if the token is valid
        // $user = $this->auth->getUser($token);


        // $employees = User::where('user_type', 'employee')->get();
        $employees = new User();
        $employees = $employees->searchEmployeeByName($request->search);
        return new JsonResource($employees);
    }

    /**
     * show employee
     */
    public function show(Request $request, $uid)
    {

        // $log_user = $this->auth->getUser($request->session()->get('uid'));
        // dd($log_user);
        // $employee = User::find($id);
        // $employee = new User();
        // $employee = $employee->getByUID($uid);
        $employee = Auth::getUserData($uid);
        if (!$employee) {
            return Redirect::route('dashboard');
        }
        $avialable_dates = [];

        // // check if employy->available_dates is in the future
        // if (!empty($employee['avialable_dates'])) {
        //     foreach ($employee['avialable_dates'] as $date) {
        //         if (strtotime($date['date']) >= strtotime(date('Y-m-d'))) {
        //             $hours = [];
        //             foreach ($date['hours'] as $hour) {
        //                 if ( strtotime($date['date'] . ' ' . $hour) >= strtotime(date('Y-m-d H:i'))) {
        //                     $hours[] = $hour;
        //                 }
        //             }
        //             $avialable_dates[] = [
        //                 'date' => $date['date'],
        //                 'hours' => $hours
        //             ];
        //         }
        //     }
        // }
        // $employee['avialable_dates'] = $avialable_dates;

        // dates and hours dates for whole month and hours from 8:00 to 15:00
        $dates = [];
        $date = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime('+1 month', strtotime($date)));
        while (strtotime($date) <= strtotime($end_date)) {
            $dates[] = [
                'date' => $date,
                'day' => date('d M', strtotime($date)),
                'weekday' => date('l', strtotime($date)),
            ];
            $date = date('Y-m-d', strtotime($date . ' +1 day'));
        }


        return Inertia::render('Employee/index', [
            'employee' => $employee,
            'dates' => $dates
        ]);


        // return Inertia::render('Employee/index', [
        //     'employee' => $employee
        // ]);
    }

    /**
     * check reservation
     */
    public function check(Request $request): RedirectResponse
    {
        $employee = User::find($request->employee_id);
        // $reservation = $employee->reservations()->where('date', $request->date)->first();
        // check if the user is authenticated or not
        if (Auth::check()) {
            // save cookies
            setcookie('employee_id', $employee->id, time() + (86400 * 30), "/");
            setcookie('date', $request->date, time() + (86400 * 30), "/");
            setcookie('hour', $request->hour, time() + (86400 * 30), "/");
            // return to reservation page
            return Redirect::route('reservation.create');
        } else {
            // redirect to login page with redirect_url
            return Redirect::route('login', ['redirect_url' => 'reservations.create']);
        }
    }

    /**
     * get all employees
     */
    public function getEmployees(): JsonResource
    {
        $employees = User::where('user_type', 'employee')->get();
        return new JsonResource($employees);
    }
}
