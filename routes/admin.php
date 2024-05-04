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
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
// auth
use Illuminate\Support\Facades\Auth;


Route::middleware(['firebase','admin'])->group(function () {
    Route::get('/admin', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/admin/user/show/{uid}', [UserController::class, 'show'])->name('admin.user.show');
    // Route::get('/admin/user/edit/{uid}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::post('/admin/user/update', [UserController::class, 'update'])->name('admin.user.update');
    Route::post('/admin/user/delete', [UserController::class, 'delete'])->name('admin.user.delete');

    Route::get('/admin/reservations', [ReservationController::class, 'index'])->name('admin.reservations');
    Route::post('/admin/reservation/delete', [ReservationController::class, 'delete'])->name('admin.reservation.delete');

    Route::get('/admin/employees', [ EmployeeController::class, 'index'])->name('admin.employees');
    Route::get('/admin/employee/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
    Route::post('/admin/employee/store', [EmployeeController::class, 'store'])->name('admin.employee.store');
    Route::get('/admin/employee/edit/{uid}',[EmployeeController::class, 'edit'])->name('admin.employee.edit');
    Route::post('/admin/employee/update', [EmployeeController::class, 'update'])->name('admin.employee.update');
    Route::post('/admin/employee/delete', [EmployeeController::class, 'delete'])->name('admin.employee.delete');

    Route::get('/admin/team/create', function () {
        return Inertia::render('Admin/CreateTeam');
    })->name('admin.team.create');
    Route::get('/admin/team/show/{key}', [EmployeeController::class, 'show_team'])->name('admin.team.show');
    Route::post('/admin/team/store', [EmployeeController::class, 'store_team'])->name('admin.team.store');
    Route::get('/admin/team/edit/{key}', [EmployeeController::class, 'edit_team'])->name('admin.team.edit');
    Route::post('/admin/team/update', [EmployeeController::class, 'update_team'])->name('admin.team.update');
    Route::get('/admin/team/delete/{key}', [EmployeeController::class, 'delete_team'])->name('admin.team.delete');
    Route::get('/admin/teams', [EmployeeController::class, 'index_team'])->name('admin.teams');
});
