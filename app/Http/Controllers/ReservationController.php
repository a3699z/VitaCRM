<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Facades\Auth;
use App\Http\Facades\Database;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use App\Mail\ReservationBooked as MailReservationBooked;
use Illuminate\Support\Facades\Mail;


class ReservationController extends Controller
{

    /**
     * check reservation
     */
    public function check(Request $request): RedirectResponse
    {
        // validate request
        $request->validate([
            'employeeUID' => 'required',
            'date' => 'required',
            'hour' => 'required',
        ]);
        // dd($request->all());
        $request->session()->put('reservation', [
            'employee_uid' => $request->employeeUID,
            'date' => $request->date,
            'hour' => $request->hour,
            'is_online' => $request->online
        ]);
        $check = $this->reservation_exists($request->session()->get('reservation'));
        if ($check) {
            $request->session()->forget('reservation');
            return Redirect::back()->with('error', 'Reservation already exists for the selected date and time');
        }
        if (Auth::check()) {
            return Redirect::route('reservation.create');
        } else {
            return Redirect::route('login', ['ref' => 'reserve']);
        }
    }

    public function create(Request $request)
    {
        if (!$request->session()->has('reservation')) {
            return Redirect::route('site.index');
        }
        $check = $this->reservation_exists($request->session()->get('reservation'));
        if ($check) {
            $request->session()->forget('reservation');
            return Redirect::back()->with('error', 'Reservation already exists for the selected date and time');
        }
        $reservation_session = $request->session()->get('reservation');
        $employee = Auth::getUserData($reservation_session['employee_uid']);
        return Inertia::render('Reservation/Create/index', [
            'employee' => $employee,
            'date' => $reservation_session['date'],
            'hour' => $reservation_session['hour'],
            'is_online' => $reservation_session['is_online']
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'insurance_type' => 'required',
            'insurance_policy_number' => 'required',
            'is_online' => 'required',
            'employee_uid' => 'required',
            'date' => 'required',
            'hour' => 'required',
        ]);
        try {
            $check = $this->reservation_exists(array(
                'employee_uid' => $request->employee_uid,
                'date' => $request->date,
                'hour' => $request->hour
            ));
            if ($check) {
                $request->session()->forget('reservation');
                return Redirect::back()->with('error', 'Reservation already exists for the selected date and time');
            }

            $employee = Auth::getUserData($request->employee_uid);
            $reservation = [
                'user_uid' => Auth::getUID(),
                'employee_uid' => $employee['uid'],
                'date' => $request->date,
                'hour' => $request->hour,
                'insurance_type' => $request->insurance_type,
                'insurance_policy_number' => $request->insurance_policy_number,
                'is_online' => $request->is_online ? true : false,
                'status' => 'pending'
            ];
            $reservation = Database::push('reservations', $reservation);
            $request->session()->forget('reservation');

            Mail::to($employee['email'])->send(new MailReservationBooked($reservation->getKey()));

        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Error occured while booking reservation');
        }
        return Redirect::route('site.index');
    }

    public function reservation_exists($reservation)
    {
        $reservations = Database::getWhere('reservations', 'employee_uid', $reservation['employee_uid']);
        $reservations = array_filter($reservations, function($res) use ($reservation) {
            return $res['date'] == $reservation['date'] && $res['hour'] == $reservation['hour'];
        });
        if (!empty($reservations)) {
            return true;
        }
    }

    public function index ( Request $request )
    {
        if (Auth::employee()) {
            $reservations = Database::getWhere('reservations', 'employee_uid', Auth::getUID());
            $reservations = array_map(function ($reservation) {
                $reservation['reservation_with'] = Auth::getUserData($reservation['user_uid']);
                return $reservation;
            }, $reservations);
        } else {
            $reservations = Database::getWhere('reservations', 'user_uid', Auth::getUID());
            $reservations = array_map(function ($reservation) {
                $reservation['reservation_with'] = Auth::getUserData($reservation['employee_uid']);
                return $reservation;
            }, $reservations);
        }
        return Inertia::render('Reservation/Index', [
            'reservations' => $reservations
        ]);
    }



    public function accept (Request $request, $key)
    {
        Database::set('reservations/'.$key.'/status', 'accepted');
        $reservation = Database::getOneReference('reservations/'.$key);
        if ($reservation['is_online']) {
            $reservation['reservation_with'] = Auth::getUserData($reservation['user_uid']);
            $call = [
                'employee_uid' => $reservation['employee_uid'],
                'patient_uid' => $reservation['user_uid'],
                'date' => $reservation['date'],
                'hour' => $reservation['hour'],
                'reservation_key' => $key,
                'room_name' => 'call_'.$key,
                'topic' => 'Call with '.$reservation['reservation_with']['name'].' on '.$reservation['date'].' at '.$reservation['hour'].'.'
            ];
            Database::push('calls', $call);
        }
        return Redirect::back()->with('status', 'Reservation accepted');
    }

    public function decline (Request $request, $key)
    {
        Database::delete('reservations/'.$key);
        return Redirect::back()->with('status', 'Reservation declined');
    }

    public function get_hours(Request $request)
    {
        $date = $request->date;
        $online = $request->online;
        $employee_uid = $request->employeeUID;

        $hours = [];
        $hour = '08:00';
        $end_hour = '15:00';
        $reservations = Database::getWhere('reservations', 'employee_uid', $employee_uid);
        while (strtotime($hour) <= strtotime($end_hour)) {
            foreach ($reservations as $reservation) {
                if (($reservation['date'] == $date && $reservation['hour'] == $hour) || (strtotime($date . ' ' . $hour) < time())) {
                    break;
                }
            }
            $hours[] = $hour;
            $hour = date('H:i', strtotime($hour . ' +60 minutes'));

        }
        return response()->json([
            'hours' => $hours
        ]);
    }

}
