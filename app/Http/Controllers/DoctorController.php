<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return response()->json(Doctor::with('user')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['nullable', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'specialty' => ['required', 'string', 'max:255'],
            'room_number' => ['nullable', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $doctor = Doctor::create($data);

        return response()->json(['message' => 'Médecin créé', 'doctor' => $doctor], 201);
    }

    public function show(Doctor $doctor)
    {
        return response()->json($doctor->load(['user', 'appointments', 'medicalRecords']));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'user_id' => ['nullable', 'exists:users,id'],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'specialty' => ['sometimes', 'required', 'string', 'max:255'],
            'room_number' => ['nullable', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:30'],
        ]);

        $doctor->update($data);

        return response()->json(['message' => 'Médecin mis à jour', 'doctor' => $doctor]);
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return response()->json(['message' => 'Médecin supprimé']);
    }
}
