
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Registro de atención médica
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-bold mb-5">
                    Información clínica del paciente
                </h3>

                {{-- Datos de la cita --}}
                <div class="mb-6 p-4 bg-gray-100 rounded-lg">

                    <h4 class="font-bold mb-3">
                        Datos de la cita
                    </h4>

                    <p>
                        <strong>Paciente:</strong>
                        {{ $appointment->patient->user->name }}
                    </p>

                    <p>
                        <strong>Fecha de cita:</strong>
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y H:i') }}
                    </p>

                    <p>
                        <strong>Motivo:</strong>
                        {{ $appointment->reason }}
                    </p>

                    <p>
                        <strong>Estado:</strong>
                        {{ $appointment->status }}
                    </p>

                </div>

                {{-- Mensajes de error --}}
                @if ($errors->any())
                    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">

                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif

                <form method="POST"
                    action="{{ route('professional.attentions.store', $appointment) }}">

                    @csrf

                    {{-- Fecha de atención --}}
                    <div class="mb-5">

                        <label class="block font-medium mb-2">
                            Fecha y hora de atención
                        </label>

                        <input
                            type="datetime-local"
                            name="attention_date"
                            value="{{ old('attention_date', now()->format('Y-m-d\TH:i')) }}"
                            required
                            class="w-full border-gray-300 rounded-md shadow-sm">

                        @error('attention_date')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Notas clínicas --}}
                    <div class="mb-5">

                        <label class="block font-medium mb-2">
                            Notas de atención médica
                        </label>

                        <textarea
                            name="clinical_notes"
                            rows="5"
                            maxlength="20000"
                            required
                            class="w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Registre las observaciones de la atención...">{{ old('clinical_notes') }}</textarea>

                        @error('clinical_notes')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Diagnóstico --}}
                    <div class="mb-5">

                        <label class="block font-medium mb-2">
                            Diagnóstico médico
                        </label>

                        <textarea
                            name="diagnosis"
                            rows="4"
                            maxlength="10000"
                            required
                            class="w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Registre el diagnóstico determinado por el profesional...">{{ old('diagnosis') }}</textarea>

                        @error('diagnosis')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Indicaciones --}}
                    <div class="mb-5">

                        <label class="block font-medium mb-2">
                            Indicaciones médicas
                        </label>

                        <textarea
                            name="indications"
                            rows="5"
                            maxlength="10000"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Registre las indicaciones, cuidados o recomendaciones proporcionadas al paciente...">{{ old('indications') }}</textarea>

                        @error('indications')
                            <p class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Botones --}}
                    <div class="flex flex-wrap gap-3">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">

                            Guardar atención médica

                        </button>

                        <a
                            href="{{ route('professional.appointments.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">

                            Cancelar

                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
