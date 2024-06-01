<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

use App\Http\Facades\Auth;
use App\Http\Facades\Database;

class ReservationController extends Controller
{

    public function index()
    {
        $reservations  = Database::getReferences('/reservations');
        $reservations = array_map(function ($item) {
            $item['employee'] = Auth::getUserData($item['employee_uid']);
            $item['user'] = Auth::getUserData($item['user_uid']);
            if (!empty($item['employee']) && !empty($item['user'])) {
                return $item;
            }
        }, $reservations);
        $reservations = array_filter($reservations);
        return view('admin.reservations.list', [
            'reservations' => $reservations,
            'emptyMessage' => 'No reservations found.'
        ]);
    }

    public function show (Request $request, $key)
    {
        $reservation = Database::getOneReference('/reservations/'.$key);
        $reservation = (object) $reservation;
        $reservation->employee = Auth::getUserData($reservation->employee_uid);
        $reservation->user = Auth::getUserData($reservation->user_uid);
        return view('admin.reservations.detail', [
            'reservation' => $reservation
        ]);
    }

    public function delete (Request $request, $key)
    {
        Database::delete('/reservations/'.$key);
        return Redirect::route('admin.reservations');
    }

    public function update (Request $request, $key)
    {
        $data = $request->all();
        $data['updated_at'] = date('Y-m-d H:i:s');
        if (empty($data['status'])) {
            $data['status'] = 'pending';
        } else {
            $data['status'] = 'accepted';
        }
        Database::update('/reservations/'.$key, $data);

        return Redirect::route('admin.reservations.show', ['key' => $key]);
    }
}
