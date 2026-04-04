<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return response()->json(Appointment::with(['patient', 'doctor'])->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'scheduled_at' => ['required', 'date'],
            'status' => ['required', 'in:pending,approved,cancelled'],
            'reason' => ['nullable', 'string'],
        ]);

        $appointment = Appointment::create($data);

        return response()->json(['message' => 'Rendez-vous créé', 'appointment' => $appointment], 201);
    }

    public function show(Appointment $appointment)
    {
        return response()->json($appointment->load(['patient', 'doctor', 'medicalRecords']));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'patient_id' => ['sometimes', 'required', 'exists:users,id'],
            'doctor_id' => ['sometimes', 'required', 'exists:doctors,id'],
            'scheduled_at' => ['sometimes', 'required', 'date'],
            'status' => ['sometimes', 'required', 'in:pending,approved,cancelled'],
            'reason' => ['nullable', 'string'],
        ]);

        $appointment->update($data);

        return response()->json(['message' => 'Rendez-vous mis à jour', 'appointment' => $appointment]);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return response()->json(['message' => 'Rendez-vous supprimé']);
    }
}
