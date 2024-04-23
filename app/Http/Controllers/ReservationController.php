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


class ReservationController extends Controller
{

    /**
     * check reservation
     */
    public function check(Request $request): RedirectResponse
    {
        $employee = User::find($request->employee);

        session(['reservation' => [
            'employee' => $employee,
            'date' => $request->date,
            'time' => $request->hour
        ]]);
        session_start();
        $_SESSION['reservation'] =  [
            'employee' => $employee,
            'date' => $request->date,
            'time' => $request->hour
        ];

        if (Auth::check()) {
            return Redirect::route('reservation.create', ['employee' =>$request->emplyee, 'date'=>$request->date,'hour'=>$request->hour]);
        } else {
            return Redirect::route('login', ['ref' => 'reserve']);
        }
    }
}
