<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Solicitar una cita médica
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <h3 class="text-lg font-semibold text-gray-700 mb-6">
                    Formulario de solicitud de cita
                </h3>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('patient.appointments.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="professional_id" class="block font-medium text-gray-700 mb-2">
                            Profesional de salud
                        </label>

                        <select
                            name="professional_id"
                            id="professional_id"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                            required
                        >
                            <option value="">Seleccione un profesional</option>

                            @foreach ($professionals as $professional)
                                <option
                                    value="{{ $professional->id }}"
                                    {{ old('professional_id') == $professional->id ? 'selected' : '' }}
                                >
                                    {{ $professional->user->name }}
                                    - {{ $professional->specialty }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="appointment_date" class="block font-medium text-gray-700 mb-2">
                            Fecha y hora de la cita
                        </label>

                        <input
                            type="datetime-local"
                            name="appointment_date"
                            id="appointment_date"
                            value="{{ old('appointment_date') }}"
                            min="{{ now()->format('Y-m-d\TH:i') }}"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                            required
                        >
                    </div>

                    <div class="mb-6">
                        <label for="reason" class="block font-medium text-gray-700 mb-2">
                            Motivo de la consulta
                        </label>

                        <textarea
                            name="reason"
                            id="reason"
                            rows="4"
                            class="w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Describa brevemente el motivo de su consulta..."
                            required
                        >{{ old('reason') }}</textarea>
                    </div>

                    <div class="flex items-center gap-3">
                        <button
                            type="submit"
                            class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                        >
                            Solicitar cita
                        </button>

                        <a
                            href="{{ route('patient.appointments.index') }}"
                            class="px-5 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300"
                        >
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>