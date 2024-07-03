<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Facades\Auth;
use App\Http\Facades\Database;


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
        // one month early
        $date = date('Y-m-d', strtotime('-1 month'));
        $end_date = date('Y-m-d', strtotime('+1 month', strtotime($date)));
        $germanDaysOfWeek = [
            'Sunday' => 'Sonntag',
            'Monday' => 'Montag',
            'Tuesday' => 'Dienstag',
            'Wednesday' => 'Mittwoch',
            'Thursday' => 'Donnerstag',
            'Friday' => 'Freitag',
            'Saturday' => 'Samstag'
        ];
        $germanMonths = [
            'January' => 'Januar',
            'February' => 'Februar',
            'March' => 'März',
            'April' => 'April',
            'May' => 'Mai',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'August',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Dezember'
        ];
        while (strtotime($date) <= strtotime($end_date)) {
            $dates[] = [
                'date' => $date,
                // 'day' => date('d M', strtotime($date)),
                'day' => date('d', strtotime($date)) . ' ' . $germanMonths[date('F', strtotime($date))],
                // 'weekday' => date('l', strtotime($date)),
                'weekday' => $germanDaysOfWeek[date('l', strtotime($date))],
            ];
            $date = date('Y-m-d', strtotime($date . ' +1 day'));
        }

        // dd($dates);


        $date = date('Y-m-d');
        $data = $this->quick_hour($date, $uid);
        if (!empty($data['hour'])) {
            $employee['quick_date'] = $data['date'];
            $employee['quick_hour'] = $data['hour'];
        }

        return Inertia::render('Employee/index', [
            'employee' => $employee,
            'dates' => $dates
        ]);

    }

    public function quick_hour($date, $uid) {
        $start_hour = '08:00';
        $end_hour = '15:00';
        if (strtotime(date('H:i')) > strtotime('15:00')) {
            $date = date('Y-m-d', strtotime($date . ' +1 day'));
        }
        $hour = '';
        // dd($date, $hour, $end_hour);
        $reservations = Database::getWhere('reservations', 'employee_uid', $uid);
        while (strtotime($start_hour) <= strtotime($end_hour)) {
            $isBooked = false;

            foreach ($reservations as $reservation) {
                if ($reservation['date'] == $date && $reservation['hour'] == $start_hour) {
                    $isBooked = true;
                    break;
                }
            }
            if ($isBooked) {
                $start_hour = date('H:i', strtotime($start_hour . ' +60 minutes'));
            } else {
                $hour = $start_hour;
                break;
            }
        }
        if (empty($hour)) {
            $hour = $this->quick_hour(date('Y-m-d', strtotime($date . ' +1 day')), $uid);
        }
        return array(
            'hour' => $hour,
            'date' => $date
        );
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
