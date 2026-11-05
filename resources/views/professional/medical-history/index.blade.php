
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Historia clínica del paciente
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Datos del paciente --}}
                <div class="mb-6 p-4 bg-gray-100 rounded-lg">

                    <h3 class="text-lg font-bold mb-3">
                        Datos del paciente
                    </h3>

                    <p>
                        <strong>Nombre:</strong>
                        {{ $patient->user->name }}
                    </p>

                    <p>
                        <strong>Teléfono:</strong>
                        {{ $patient->phone ?? 'No registrado' }}
                    </p>

                    <p>
                        <strong>Dirección:</strong>
                        {{ $patient->address ?? 'No registrada' }}
                    </p>

                </div>

                <h3 class="text-lg font-bold mb-4">
                    Historial de atenciones médicas
                </h3>

                @php
                    $attentionsFound = $appointments->contains(
                        fn ($appointment) => $appointment->medicalAttention !== null
                    );
                @endphp

                @if (!$attentionsFound)

                    <div class="bg-blue-50 text-blue-800 p-4 rounded">
                        Este paciente todavía no tiene atenciones médicas
                        registradas por este profesional.
                    </div>

                @else

                    <div class="space-y-6">

                        @foreach ($appointments as $appointment)

                            @if ($appointment->medicalAttention)

                                <div class="border border-gray-200 rounded-lg p-5">

                                    <div class="flex flex-wrap justify-between gap-2 mb-4">

                                        <h4 class="font-bold text-lg">
                                            Atención médica
                                        </h4>

                                        <span class="text-sm text-gray-600">
                                            {{ $appointment->medicalAttention->attention_date
                                                ? $appointment->medicalAttention->attention_date->format('d/m/Y H:i')
                                                : 'Fecha no registrada' }}
                                        </span>

                                    </div>

                                    <div class="mb-4">
                                        <p class="font-semibold">
                                            Motivo de la cita
                                        </p>

                                        <p class="text-gray-700">
                                            {{ $appointment->reason }}
                                        </p>
                                    </div>

                                    <div class="mb-4">
                                        <p class="font-semibold">
                                            Notas clínicas
                                        </p>

                                        <p class="text-gray-700 whitespace-pre-line">
                                            {{ $appointment->medicalAttention->clinical_notes }}
                                        </p>
                                    </div>

                                    <div class="mb-4">
                                        <p class="font-semibold">
                                            Diagnóstico
                                        </p>

                                        <p class="text-gray-700 whitespace-pre-line">
                                            {{ $appointment->medicalAttention->diagnosis ?? 'No registrado' }}
                                        </p>
                                    </div>

                                    <div>
                                        <p class="font-semibold">
                                            Indicaciones médicas
                                        </p>

                                        <p class="text-gray-700 whitespace-pre-line">
                                            {{ $appointment->medicalAttention->indications ?? 'No registradas' }}
                                        </p>
                                    </div>

                                </div>

                            @endif

                        @endforeach

                    </div>

                @endif

                <div class="mt-6">

                    <a href="{{ route('professional.appointments.index') }}"
                       class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded inline-block">
                        Volver a la agenda
                    </a>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
