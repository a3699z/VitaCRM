<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
// session_start();
// dd( $_SESSION['reservation']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/employees/search', [EmployeeController::class, 'search'])->name('employees.search');
Route::get('/employee/{id}', [EmployeeController::class, 'show'])->name('employee.show');
Route::get('/reservation/check/', [ReservationController::class, 'check'])->name('reservation.check');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/dates', [ProfileController::class, 'update_dates'])->name('dates.update');

    Route::get('/reservation/create', function() {
        return Inertia::render('Reservation/Create');
    })->name('reservation.create');
    Route::get('/reservation/session', function() {
        session_start();
        return $_SESSION['reservation'];
    });
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
