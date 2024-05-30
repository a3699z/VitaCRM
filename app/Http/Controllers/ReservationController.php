<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Facades\Auth;
use App\Http\Facades\Database;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use Kreait\Firebase\Contract\Database as FirebaseDatabase;
use App\CustomFirebaseAuth;
use App\Events\ReservationBooked;
use App\Mail\ReservationBooked as MailReservationBooked;
// mail
use Illuminate\Support\Facades\Mail;


class ReservationController extends Controller
{
    protected $auth;
    protected $database;

    public function __construct(FirebaseAuth $auth, FirebaseDatabase $database)
    {
        // check if user is authenticated using firebase auth
        $this->auth = $auth;
        $this->database =  $database;
    }

    /**
     * check reservation
     */
    public function check(Request $request): RedirectResponse
    {
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
            return Redirect::route('dashboard');
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
        return Redirect::route('dashboard');
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



    public function accept (Request $request)
    {
        $this->database->getReference('reservations/'.$request->key.'/status')->set('accepted');
        return response()->json([
            'status' => 'success',
            'message' => 'Reservation accepted'
        ]);

    }

    public function decline (Request $request)
    {
        try {
            $reservation = $this->database->getReference('reservations/'.$request->key)->getValue();
            $available_dates = $this->database->getReference('users/'.$reservation['employee_key'].'/available_dates')->getValue();
            $date_index = array_search($reservation['date'], array_column($available_dates, 'date'));
            if ($date_index === false) {
                $available_dates[] = [
                    'date' => $reservation['date'],
                    'hours' => [$reservation['time']]
                ];
            } else {
                if (!in_array($reservation['time'], $available_dates[$date_index]['hours'])) {
                    $available_dates[$date_index]['hours'][] = $reservation['time'];
                }
            }
            $this->database->getReference('users/'.$reservation['employee_key'].'/available_dates')->set($available_dates);
            $this->database->getReference('reservations/'.$request->key)->remove();

            return response()->json([
                'status' => 'success',
                'message' => 'Reservation declined'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error occured while declining reservation'
            ]);
        }
    }


    public function start_session( Request $request, $key )
    {
        $user = CustomFirebaseAuth::call_static($request, 'getUserData');
        $reservation = $this->database->getReference('reservations/'.$key)->getValue();
        $room_name = $reservation['date'].'-'.$reservation['time'].'-'.$key;
        if ($reservation['status'] == 'accepted') {
            if ($user['user_type'] == 'employee' && $reservation['employee_key'] == $user['key']) {
                $config = \Patientus\OVS\SDK\Configuration::getDefaultConfiguration();
                $config->setHost('https://sandbox.patientus.de/');

                $authorization = new \Patientus\OVS\SDK\Handlers\AuthorizationHandler(
                    $config
                );
                $authToken = $authorization->getAuthToken('vipvitalisten', '.2lH#GVr}X7p*rW7');
                $config->setAccessToken($authToken);
                // create doctor session
                $ovsSessionHandler = new \Patientus\OVS\SDK\Handlers\OvsSessionHandler(
                    $config
                );
                $ovsSession = $ovsSessionHandler->getOvsSession(
                    $room_name,
                    \Patientus\OVS\SDK\Consts\ParticipantType::MODERATOR
                );
                dd($ovsSession);
            } else if ($user['user_type'] == 'patient' && $reservation['user_key'] == $user['key']) {
                $config = \Patientus\OVS\SDK\Configuration::getDefaultConfiguration();
                $config->setHost('https://sandbox.patientus.de/');

                $authorization = new \Patientus\OVS\SDK\Handlers\AuthorizationHandler(
                    $config
                );

                $authToken = $authorization->getAuthToken('vipvitalisten', '.2lH#GVr}X7p*rW7');
                $config->setAccessToken($authToken);
                $ovsSessionHandler = new \Patientus\OVS\SDK\Handlers\OvsSessionHandler(
                    $config
                );
                $ovsSession = $ovsSessionHandler->getOvsSession(
                    $room_name,
                    \Patientus\OVS\SDK\Consts\ParticipantType::PUBLISHER
                );
                dd($ovsSession);
            }
        }
        return Redirect::route('dashboard');

    }

    public function get_hours(Request $request)
    {
        // get hours for the selected date
        $date = $request->date;
        $online = $request->online;

        // echo $date;exit;

        // hours from 8:00 to 15:00
        $hours = [];
        $hour = '08:00';
        $end_hour = '15:00';
        while (strtotime($hour) <= strtotime($end_hour)) {
            $hours[] = $hour;
            $hour = date('H:i', strtotime($hour . ' +60 minutes'));
        }
        return response()->json([
            'hours' => $hours
        ]);
    }

}
