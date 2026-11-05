<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AppointmentController extends Controller
{
    // Mostrar las citas del paciente
    public function index(): View
    {
        $patient = auth()->user()->patient;

        if (!$patient) {
            abort(403, 'No tienes un perfil de paciente.');
        }

        $appointments = $patient->appointments()
            ->with('professional.user')
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('patient.appointments.index', compact('appointments'));
    }

    // Mostrar formulario para solicitar una cita
    public function create(): View
    {
        $patient = auth()->user()->patient;

        if (!$patient) {
            abort(403, 'No tienes un perfil de paciente.');
        }

        $professionals = Professional::with('user')->get();

        return view('patient.appointments.create', compact('professionals'));
    }

    // Registrar solicitud de cita
    public function store(Request $request): RedirectResponse
    {
        $patient = auth()->user()->patient;

        if (!$patient) {
            abort(403, 'No tienes un perfil de paciente.');
        }

        $validated = $request->validate([
            'professional_id' => ['required', 'exists:professionals,id'],
            'appointment_date' => ['required', 'date', 'after:now'],
            'reason' => ['required', 'string', 'max:1000'],
        ]);

        $patient->appointments()->create([
            'professional_id' => $validated['professional_id'],
            'appointment_date' => $validated['appointment_date'],
            'reason' => $validated['reason'],
            'status' => 'Pendiente',
        ]);

        return redirect()
            ->route('patient.appointments.index')
            ->with('success', 'Tu solicitud de cita fue registrada correctamente.');
    }

    // Mostrar las citas asignadas al profesional
    public function professionalIndex(): View
    {
        $professional = auth()->user()->professional;

        if (!$professional) {
            abort(403, 'No tienes un perfil de profesional de salud.');
        }

        $appointments = $professional->appointments()
            ->with('patient.user')
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view(
            'professional.appointments.index',
            compact('appointments')
        );
    }

    // Aceptar o rechazar una solicitud
    public function updateStatus(
        Request $request,
        Appointment $appointment
    ): RedirectResponse {

        $professional = auth()->user()->professional;

        if (!$professional) {
            abort(403, 'No tienes un perfil de profesional de salud.');
        }

        // Verificar que la cita pertenece al profesional
        if ((int) $appointment->professional_id !== (int) $professional->id) {
            abort(403, 'No tienes permiso para modificar esta cita.');
        }

        $validated = $request->validate([
            'status' => ['required', 'in:Aceptada,Rechazada'],
        ]);

        // Solo modificar citas pendientes
        if ($appointment->status !== 'Pendiente') {
            return back()->with('error', 'Esta solicitud ya fue procesada.');
        }

        $appointment->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('professional.appointments.index')
            ->with('success', 'El estado de la solicitud se actualizó correctamente.');
    }
}