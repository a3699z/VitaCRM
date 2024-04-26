<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;


class EmployeeController extends Controller
{
    /**
     * show all employees
     */

    public function index(): Response
    {
        $employees = User::where('user_type', 'employee')->get();
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
        // $employees = User::where('user_type', 'employee')->get();
        $employees = new User();
        $employees = $employees->searchEmployeeByName($request->search);
        return new JsonResource($employees);
    }

    /**
     * show employee
     */
    public function show($uid): Response
    {
        // $employee = User::find($id);
        $employee = new User();
        $employee = $employee->getByUID($uid);


        return Inertia::render('Employee', [
            'employee' => $employee
        ]);
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
}
