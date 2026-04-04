<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_users' => User::count(),
            'doctors' => Doctor::count(),
            'patients' => User::where('role', 'patient')->count(),
            'appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'recent_appointments' => Appointment::with(['patient', 'doctor'])->latest('scheduled_at')->take(10)->get(),
        ]);
    }
}
