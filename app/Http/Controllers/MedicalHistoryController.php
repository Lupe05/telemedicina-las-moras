<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\View\View;

class MedicalHistoryController extends Controller
{
    // Consultar la historia clínica de un paciente
    public function index(Patient $patient): View
    {
        $professional = auth()->user()->professional;

        if (!$professional) {
            abort(403, 'No tienes un perfil de profesional de salud.');
        }

        // Verificar que el profesional tenga citas con este paciente
        $hasAppointment = $patient->appointments()
            ->where('professional_id', $professional->id)
            ->exists();

        if (!$hasAppointment) {
            abort(403, 'No tienes autorización para consultar esta historia clínica.');
        }

        // Obtener las atenciones clínicas de este paciente
        $appointments = $patient->appointments()
            ->where('professional_id', $professional->id)
            ->with('medicalAttention')
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view(
            'professional.medical-history.index',
            compact('patient', 'appointments')
        );
    }
}