<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Facades\Auth;


class EmployeeController extends Controller
{
    /**
     * store employee
     */

    //  return array json of employees
    public function search(Request $request): JsonResource
    {
        $employees = new User();
        $employees = $employees->searchEmployeeByName($request->search);
        return new JsonResource($employees);
    }

    /**
     * show employee
     */
    public function show(Request $request, $uid)
    {
        $employee = Auth::getUserData($uid);
        if (!$employee) {
            return Redirect::route('site.index');
        }
        $avialable_dates = [];

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

    }

    /**
     * check reservation
     */
    public function check(Request $request): RedirectResponse
    {
        $employee = User::find($request->employee_id);
        if (Auth::check()) {
            setcookie('employee_id', $employee->id, time() + (86400 * 30), "/");
            setcookie('date', $request->date, time() + (86400 * 30), "/");
            setcookie('hour', $request->hour, time() + (86400 * 30), "/");
            return Redirect::route('reservation.create');
        } else {
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
