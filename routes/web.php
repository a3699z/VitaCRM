<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

Route::get('/', function () {

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
})->middleware(['firebase'])->name('dashboard');

Route::get('/employees/search', [EmployeeController::class, 'search'])->name('employees.search');
Route::get('/employee/{uid}', [EmployeeController::class, 'show'])->name('employee.show');
Route::get('/reservation/check/', [ReservationController::class, 'check'])->name('reservation.check');

// Route::middleware('auth')->group(function () {
Route::middleware('firebase')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/dates', [ProfileController::class, 'update_dates'])->name('dates.update');
    Route::patch('/contacts', [ProfileController::class, 'update_contacts'])->name('contacts.update');
    Route::patch('/professional', [ProfileController::class, 'update_professional'])->name('professional.update');
    Route::patch('/patientinfo', [ProfileController::class, 'update_patientinfo'])->name('patientinfo.update');

    // Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    // Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');


    Route::get('/reservation/create', function() {
        return Inertia::render('Reservation/Create');
    })->name('reservation.create');
    Route::get('/reservation/session', function( Request $request) {
        return $request->session()->get('reservation');
    })->name('reservation.session');
    Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');


    Route::post('/reservation/accept/', [ReservationController::class, 'accept'])->name('reservation.accept');
    Route::post('/reservation/decline/', [ReservationController::class, 'decline'])->name('reservation.decline');


});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
