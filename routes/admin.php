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
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
// auth
use Illuminate\Support\Facades\Auth;


Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/employees', [ EmployeeController::class, 'index'])->name('admin.employees');

    Route::get('/admin/employee/create', function () {
        return Inertia::render('Admin/CreateEmployee');
    })->name('admin.employee.create');
    // Route::post('/admin/employee/store', [EmployeeController::class, 'store'])->name('admin.employee.store');
    Route::post('/admin/employee/store', [EmployeeController::class, 'store_fire'])->name('admin.employee.store');

    Route::get('/admin/employee/edit/{id}',[EmployeeController::class, 'edit'])->name('admin.employee.edit');
    Route::post('/admin/employee/update/{id}', [EmployeeController::class, 'update'])->name('admin.employee.update');
    Route::post('/admin/employee/delete', [EmployeeController::class, 'delete'])->name('admin.employee.delete');
});
