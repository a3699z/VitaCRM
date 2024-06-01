<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

Route::get('/', [SiteController::class, 'index'])->name('site.index');

Route::get('/video', [VideoController::class, 'video1'])->name('video.video1');
Route::get('/video2', [VideoController::class, 'video2'])->name('video.video2');
Route::get('/video3', [VideoController::class, 'video3'])->name('video.video3');
Route::get('/video1_api', [VideoController::class, 'video1_api'])->name('video.video1_api');
Route::get('/video2_api', [VideoController::class, 'video2_api'])->name('video.video2_api');
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['firebase', 'firebaseVerified'])->name('dashboard');

Route::get('/employee/{uid}', [EmployeeController::class, 'show'])->name('employee.show');
Route::post('/reservation/check/', [ReservationController::class, 'check'])->name('reservation.check');
Route::get('/reservation/get_hours/', [ReservationController::class, 'get_hours'])->name('reservation.get_hours');

// Route::middleware('auth')->group(function () {
Route::middleware(['firebase', 'firebaseVerified'])->group(function () {

    Route::middleware('employee')->group(function () {
        Route::get('/reservation/accept/{key}', [ReservationController::class, 'accept'])->name('reservation.accept');
        Route::get('/reservation/decline/{key}', [ReservationController::class, 'decline'])->name('reservation.decline');
    });

    Route::get('call/{key}', [VideoController::class, 'call'])->name('call');
    Route::get('/api/call/{key}', [VideoController::class, 'api_call'])->name('api_call');

    // reach assets folder in public folder
    Route::get('/call/assets', function () {
        return response()->file(public_path('assets/'));
    });

    Route::post('/update_profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/update_employee_info', [ProfileController::class, 'update_employee_info'])->name('profile.update_employee');


    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/visit/{key}', [ProfileController::class, 'visit'])->name('visit');

    Route::middleware('patient')->group(function () {
        Route::get('/reservation/create', [ReservationController::class, 'create'])->name('reservation.create');
        Route::get('/reservation/session', function( Request $request) {
            return $request->session()->get('reservation');
        })->name('reservation.session');
        Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');
    });
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
