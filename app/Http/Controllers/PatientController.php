<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        return response()->json(User::where('role', 'patient')->get());
    }

    public function show(User $patient)
    {
        if ($patient->role !== 'patient') {
            return response()->json(['message' => 'Utilisateur non patient'], 404);
        }

        return response()->json($patient->load(['appointmentsAsPatient.doctor', 'medicalRecords.doctor']));
    }

    public function update(Request $request, User $patient)
    {
        if ($patient->role !== 'patient') {
            return response()->json(['message' => 'Utilisateur non patient'], 404);
        }

        $data = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'email', 'max:255', 'unique:users,email,' . $patient->id],
        ]);

        $patient->update($data);

        return response()->json(['message' => 'Patient mis à jour', 'patient' => $patient]);
    }
}
