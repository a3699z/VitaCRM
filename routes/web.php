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

Route::get('/employees/search', [EmployeeController::class, 'search'])->name('employees.search');
Route::get('/employee/{uid}', [EmployeeController::class, 'show'])->name('employee.show');
Route::post('/reservation/check/', [ReservationController::class, 'check'])->name('reservation.check');
Route::get('/reservation/get_hours/', [ReservationController::class, 'get_hours'])->name('reservation.get_hours');

// Route::middleware('auth')->group(function () {
Route::middleware(['firebase', 'firebaseVerified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/dates', [ProfileController::class, 'update_dates'])->name('dates.update');
    Route::patch('/contacts', [ProfileController::class, 'update_contacts'])->name('contacts.update');
    Route::patch('/professional', [ProfileController::class, 'update_professional'])->name('professional.update');
    Route::patch('/patientinfo', [ProfileController::class, 'update_patientinfo'])->name('patientinfo.update');

    // Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    // Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::middleware('patient')->group(function () {
        Route::get('/reservation/create', [ReservationController::class, 'create'])->name('reservation.create');
        Route::get('/reservation/session', function( Request $request) {
            return $request->session()->get('reservation');
        })->name('reservation.session');
        Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');
    });
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');


    Route::middleware('employee')->group(function () {
        Route::post('/reservation/accept/', [ReservationController::class, 'accept'])->name('reservation.accept');
        Route::post('/reservation/decline/', [ReservationController::class, 'decline'])->name('reservation.decline');
    });


    Route::get('/session/{key}', [ReservationController::class, 'start_session'])->name('session.start');


});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
