<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Administrateur',
            'email' => 'admin@example.com',
            'role' => User::ROLE_ADMIN,
        ]);

        $doctorUser = User::factory()->create([
            'name' => 'Dr. Sophie Martin',
            'email' => 'doctor@example.com',
            'role' => User::ROLE_DOCTOR,
        ]);

        $patientUser = User::factory()->create([
            'name' => 'Patient Exemple',
            'email' => 'patient@example.com',
            'role' => User::ROLE_PATIENT,
        ]);

        $doctor = Doctor::create([
            'user_id' => $doctorUser->id,
            'name' => 'Dr. Sophie Martin',
            'specialty' => 'Cardiologie',
            'room_number' => '201',
            'phone' => '+33 1 23 45 67 89',
        ]);

        $appointment = Appointment::create([
            'patient_id' => $patientUser->id,
            'doctor_id' => $doctor->id,
            'scheduled_at' => now()->addDays(2),
            'status' => 'pending',
            'reason' => 'Consultation de suivi',
        ]);

        MedicalRecord::create([
            'patient_id' => $patientUser->id,
            'doctor_id' => $doctor->id,
            'appointment_id' => $appointment->id,
            'diagnosis' => 'Hypertension artérielle légère',
            'prescription' => 'Atorvastatine 10mg, 1 fois par jour',
            'notes' => 'Suivi recommandé dans 3 mois',
        ]);
    }
}
