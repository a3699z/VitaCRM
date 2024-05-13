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
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use Kreait\Firebase\Contract\Database;
use App\CustomFirebaseAuth;
use App\Events\ReservationBooked;
use App\Mail\ReservationBooked as MailReservationBooked;
// mail
use Illuminate\Support\Facades\Mail;


class ReservationController extends Controller
{
    protected $auth;
    protected $database;

    public function __construct(FirebaseAuth $auth, Database $database)
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
        $employee = new User();
        $employee = $employee->getByUID($request->employee);

        // session(['reservation' => [
        //     'employee' => $employee,
        //     'date' => $request->date,
        //     'time' => $request->hour
        // ]]);
        // session_start();
        // $_SESSION['reservation'] =  [
        //     'employee' => $employee,
        //     'date' => $request->date,
        //     'time' => $request->hour
        // ];
        $request->session()->put('reservation', [
            'employee' => $employee,
            'date' => $request->date,
            'time' => $request->hour
        ]);
        // cech if user is authenticated in firebase
        if (CustomFirebaseAuth::call_static($request, 'check')) {
            return Redirect::route('reservation.create', ['employee' =>$request->emplyee, 'date'=>$request->date,'hour'=>$request->hour]);
        } else {
            return Redirect::route('login', ['ref' => 'reserve']);
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $reservation_session = $request->session()->get('reservation');
            // $reservation = $this->database->getReference('reservations')->push([
            //     'employee_key' => $reservation_session['employee']['key'],
            //     'date' => $reservation_session['date'],
            //     'time' => $reservation_session['time'],
            //     'insurance_type' => $request->insurance_type,
            //     'insurance_policy_number' => $request->insurance_policy_number,
            //     'user_key' => CustomFirebaseAuth::call_static($request, 'getUserData')['key'],
            //     'status' => 'pending'
            // ]);
            $avialable_dates = $this->database->getReference('users/'.$reservation_session['employee']['key'].'/available_dates')->getValue();
            // dd($avialable_dates);
            foreach ($avialable_dates as $avialable_date) {
                if ($avialable_date['date'] == $reservation_session['date']) {
                    foreach ($avialable_date['hours'] as $hour) {
                        if ($hour == $reservation_session['time']) {
                            $reservation = $this->database->getReference('reservations')->push([
                                'employee_key' => $reservation_session['employee']['key'],
                                'date' => $reservation_session['date'],
                                'time' => $reservation_session['time'],
                                'insurance_type' => $request->insurance_type,
                                'insurance_policy_number' => $request->insurance_policy_number,
                                'user_key' => CustomFirebaseAuth::call_static($request, 'getUserData')['key'],
                                'status' => 'pending'
                            ]);
                            if ($reservation->getKey()) {
                                $time_index = array_search($reservation_session['time'], $avialable_date['hours']);
                                $date_index = array_search($reservation_session['date'], array_column($avialable_dates, 'date'));
                                if ($time_index !== false) {
                                    unset($avialable_dates[$date_index]['hours'][$time_index]);
                                }
                                // update
                                $this->database->getReference('users/'.$reservation_session['employee']['key'].'/available_dates')->set($avialable_dates);
                                break;
                            }
                        }
                    }
                    if (isset($reservation) && !empty($reservation->getKey())) {
                        break;
                    }
                }
            }

            Mail::to($request->session()->get('reservation')['employee']['email'])->send(new MailReservationBooked($reservation->getKey()));

        } catch (\Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->with('error', 'Error occured while booking reservation');
        }
        return Redirect::route('dashboard');
    }

    public function index ( Request $request )
    {
        $user = CustomFirebaseAuth::call_static($request, 'getUserData');
        if ($user['user_type'] == 'employee') {
            $reservations = $this->database->getReference('reservations')->orderByChild('employee_key')->equalTo($user['key'])->getValue();
            $reservations = array_map(function($reservation, $key) {
                return [
                    'key' => $key,
                    'reservation_with' => $this->database->getReference('users/'.$reservation['user_key'])->getValue(),
                    'date' => $reservation['date'],
                    'time' => $reservation['time'],
                    'insurance_type' => $reservation['insurance_type'],
                    'insurance_policy_number' => $reservation['insurance_policy_number'],
                    'status' => $reservation['status']
                ];
            }, $reservations, array_keys($reservations));
        } else {
            $reservations = $this->database->getReference('reservations')->orderByChild('user_key')->equalTo($user['key'])->getValue();
            $reservations = array_map(function($reservation, $key) {
                return [
                    'key' => $key,
                    'reservation_with' => $this->database->getReference('users/'.$reservation['employee_key'])->getValue(),
                    'date' => $reservation['date'],
                    'time' => $reservation['time'],
                    'insurance_type' => $reservation['insurance_type'],
                    'insurance_policy_number' => $reservation['insurance_policy_number'],
                    'status' => $reservation['status']
                ];
            }, $reservations, array_keys($reservations));
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
                dd($authToken);
                $config->setAccessToken($authToken);
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

}
