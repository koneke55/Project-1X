<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        return response()->json(MedicalRecord::with(['patient', 'doctor', 'appointment'])->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'appointment_id' => ['nullable', 'exists:appointments,id'],
            'diagnosis' => ['required', 'string'],
            'prescription' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        $record = MedicalRecord::create($data);

        return response()->json(['message' => 'Dossier médical créé', 'medical_record' => $record], 201);
    }

    public function show(MedicalRecord $medicalRecord)
    {
        return response()->json($medicalRecord->load(['patient', 'doctor', 'appointment']));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $data = $request->validate([
            'patient_id' => ['sometimes', 'required', 'exists:users,id'],
            'doctor_id' => ['sometimes', 'required', 'exists:doctors,id'],
            'appointment_id' => ['nullable', 'exists:appointments,id'],
            'diagnosis' => ['sometimes', 'required', 'string'],
            'prescription' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        $medicalRecord->update($data);

        return response()->json(['message' => 'Dossier médical mis à jour', 'medical_record' => $medicalRecord]);
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();

        return response()->json(['message' => 'Dossier médical supprimé']);
    }
}
