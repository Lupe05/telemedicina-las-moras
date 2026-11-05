<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MedicalAttentionController extends Controller
{
    // Mostrar formulario de atención médica
    public function create(Appointment $appointment): View
    {
        $professional = auth()->user()->professional;

        if (
            !$professional ||
            (int) $appointment->professional_id !== (int) $professional->id
        ) {
            abort(403, 'No tienes permiso para atender esta cita.');
        }

        if ($appointment->status !== 'Aceptada') {
            abort(403, 'Solo puedes atender citas aceptadas.');
        }

        if ($appointment->medicalAttention()->exists()) {
            abort(403, 'Esta cita ya tiene una atención registrada.');
        }

        return view(
            'professional.attentions.create',
            compact('appointment')
        );
    }

    // Guardar atención, diagnóstico e indicaciones
    public function store(
        Request $request,
        Appointment $appointment
    ): RedirectResponse {

        $professional = auth()->user()->professional;

        if (
            !$professional ||
            (int) $appointment->professional_id !== (int) $professional->id
        ) {
            abort(403, 'No tienes permiso para atender esta cita.');
        }

        if ($appointment->status !== 'Aceptada') {
            abort(403, 'La cita debe estar aceptada.');
        }

        if ($appointment->medicalAttention()->exists()) {
            return redirect()
                ->route('professional.appointments.index')
                ->with('error', 'Esta cita ya tiene una atención registrada.');
        }

        $validated = $request->validate([
            'attention_date' => ['required', 'date'],
            'clinical_notes' => ['required', 'string', 'max:20000'],
            'diagnosis' => ['required', 'string', 'max:10000'],
            'indications' => ['nullable', 'string', 'max:10000'],
        ]);

        $appointment->medicalAttention()->create($validated);

        return redirect()
            ->route('professional.appointments.index')
            ->with(
                'success',
                'La atención, el diagnóstico y las indicaciones fueron registrados correctamente.'
            );
    }
}