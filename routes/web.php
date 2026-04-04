<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

// Routes nommées pour la compatibilité avec la vue
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('auth/user', [AuthController::class, 'user']);
    Route::post('auth/logout', [AuthController::class, 'logout'])->name('logout');

    // Web routes for views
    Route::get('patients', function () {
        return view('patients.index');
    })->name('patients.index');

    Route::get('doctors', function () {
        return view('doctors.index');
    })->name('doctors.index');

    Route::get('appointments', function () {
        return view('appointments.index');
    })->name('appointments.index');

    Route::get('medical-records', function () {
        return view('medical-records.index');
    })->name('medical-records.index');

    // API routes for data
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::apiResource('api/doctors', DoctorController::class);
    Route::apiResource('api/patients', PatientController::class)->only(['index', 'show', 'update']);
    Route::apiResource('api/appointments', AppointmentController::class);
    Route::apiResource('api/medical-records', MedicalRecordController::class);
});
