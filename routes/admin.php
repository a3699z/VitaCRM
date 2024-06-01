<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\TeamsController;
use App\Http\Controllers\Admin\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
// auth
use Illuminate\Support\Facades\Auth;


Route::middleware(['firebase','admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/employees', [UserController::class, 'employees'])->name('admin.users.employees');
    Route::get('/admin/users/patients', [UserController::class, 'patients'])->name('admin.users.patients');
    Route::get('/admin/users/show/{uid}', [UserController::class, 'show'])->name('admin.users.show');
    Route::post('/admin/users/update/{uid}', [UserController::class, 'update'])->name('admin.users.update');
    Route::post('/admin/users/delete/{uid}', [UserController::class, 'delete'])->name('admin.users.delete');
    Route::get('/admin/users/reservations/{uid}', [UserController::class, 'reservations'])->name('admin.users.reservations');
    Route::get('/admin/employees/create', [UserController::class, 'create'])->name('admin.employees.create');
    Route::post('/admin/employees/store', [UserController::class, 'store'])->name('admin.employees.store');

    Route::get('/admin/reservations', [ReservationController::class, 'index'])->name('admin.reservations');
    Route::get('/admin/reservations/show/{key}', [ReservationController::class, 'show'])->name('admin.reservations.show');
    Route::post('/admin/reservations/delete/{key}', [ReservationController::class, 'delete'])->name('admin.reservations.delete');
    Route::post('/admin/reservations/update/{key}', [ReservationController::class, 'update'])->name('admin.reservations.update');

    Route::get('/admin/teams', [TeamsController::class, 'index'])->name('admin.teams');
    Route::get('/admin/teams/show/{key}', [TeamsController::class, 'show'])->name('admin.teams.show');
    Route::post('/admin/teams/delete/{key}', [TeamsController::class, 'delete'])->name('admin.teams.delete');
    Route::post('/admin/teams/update/{key}', [TeamsController::class, 'update'])->name('admin.teams.update');
    Route::get('/admin/teams/create', [TeamsController::class, 'create'])->name('admin.teams.create');
    Route::post('/admin/teams/store', [TeamsController::class, 'store'])->name('admin.teams.store');



    // Route::get('/admin/employees', [ EmployeeController::class, 'index'])->name('admin.employees');
    // Route::get('/admin/employee/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
    // Route::post('/admin/employee/store', [EmployeeController::class, 'store'])->name('admin.employee.store');
    // Route::get('/admin/employee/edit/{uid}',[EmployeeController::class, 'edit'])->name('admin.employee.edit');
    // Route::post('/admin/employee/update', [EmployeeController::class, 'update'])->name('admin.employee.update');
    // Route::post('/admin/employee/delete', [EmployeeController::class, 'delete'])->name('admin.employee.delete');


    // Route::get('/admin/team/create', function () {
    //     return Inertia::render('Admin/CreateTeam');
    // })->name('admin.team.create');
    // Route::get('/admin/team/show/{key}', [EmployeeController::class, 'show_team'])->name('admin.team.show');
    // Route::post('/admin/team/store', [EmployeeController::class, 'store_team'])->name('admin.team.store');
    // Route::get('/admin/team/edit/{key}', [EmployeeController::class, 'edit_team'])->name('admin.team.edit');
    // Route::post('/admin/team/update', [EmployeeController::class, 'update_team'])->name('admin.team.update');
    // Route::get('/admin/team/delete/{key}', [EmployeeController::class, 'delete_team'])->name('admin.team.delete');
    // Route::get('/admin/teams', [EmployeeController::class, 'index_team'])->name('admin.teams');

});
