<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
// suer firebase databse
use  Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
// firebase fail to create user
use Kreait\Firebase\Exception\Auth\EmailExists;

class ReservationController extends Controller
{

    protected $database;
    protected $auth;

    public function __construct( Database $database, FirebaseAuth $auth)
    {
        $this->database = $database;
        $this->auth = $auth;
    }

    public function index(): Response
    {
        $reservations = $this->database->getReference('reservations')->getValue();
        if (!empty($reservations)) {
            $reservations = array_map(function($reservation, $key){
                $reservation['key'] = $key;
                $reservation['patient'] = $this->database->getReference('users/'.$reservation['user_key'])->getValue();
                $reservation['employee'] = $this->database->getReference('users/'.$reservation['employee_key'])->getValue();
                return $reservation;
            }, $reservations, array_keys($reservations));
        } else {
            $reservations = [];
        }

        return Inertia::render('Admin/Reservations', [
            'reservations' => $reservations
        ]);
    }

    public function delete (Request $request): RedirectResponse
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
        } catch (\Exception $e) {
            return Redirect::route('admin.reservations')->with('error', 'Failed to delete reservation');
        }

        return Redirect::route('admin.reservations')->with('success', 'Reservation deleted');
    }

}
