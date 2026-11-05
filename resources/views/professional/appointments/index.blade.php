
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Agenda médica
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h3 class="text-lg font-bold mb-4">
                    Solicitudes de citas médicas
                </h3>

                {{-- Mensajes del sistema --}}
                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Errores de validación --}}
                @if ($errors->any())
                    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($appointments->isEmpty())

                    <p class="text-gray-600">
                        Actualmente no tienes solicitudes de citas médicas.
                    </p>

                @else

                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200">

                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-3 border">Paciente</th>
                                    <th class="p-3 border">Fecha y hora</th>
                                    <th class="p-3 border">Motivo</th>
                                    <th class="p-3 border">Estado</th>
                                    <th class="p-3 border">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        {{-- Paciente --}}
                                        <td class="p-3 border">
                                            {{ $appointment->patient->user->name }}
                                        </td>

                                        {{-- Fecha --}}
                                        <td class="p-3 border">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y H:i') }}
                                        </td>

                                        {{-- Motivo --}}
                                        <td class="p-3 border">
                                            {{ $appointment->reason }}
                                        </td>

                                        {{-- Estado --}}
                                        <td class="p-3 border">
                                            @if ($appointment->status === 'Pendiente')
                                                <span class="text-yellow-700 font-semibold">
                                                    Pendiente
                                                </span>
                                            @elseif ($appointment->status === 'Aceptada')
                                                <span class="text-green-700 font-semibold">
                                                    Aceptada
                                                </span>
                                            @elseif ($appointment->status === 'Rechazada')
                                                <span class="text-red-700 font-semibold">
                                                    Rechazada
                                                </span>
                                            @else
                                                <span class="text-gray-600">
                                                    {{ $appointment->status }}
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Acciones --}}
                                        <td class="p-3 border">
                                            <div class="flex flex-col gap-2">

                                                {{-- Aceptar o rechazar --}}
                                                @if ($appointment->status === 'Pendiente')

                                                    <form method="POST"
                                                        action="{{ route('professional.appointments.updateStatus', $appointment) }}">
                                                        @csrf
                                                        @method('PATCH')

                                                        <input type="hidden"
                                                            name="status"
                                                            value="Aceptada">

                                                        <button type="submit"
                                                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded">
                                                            Aceptar
                                                        </button>
                                                    </form>

                                                    <form method="POST"
                                                        action="{{ route('professional.appointments.updateStatus', $appointment) }}">
                                                        @csrf
                                                        @method('PATCH')

                                                        <input type="hidden"
                                                            name="status"
                                                            value="Rechazada">

                                                        <button type="submit"
                                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">
                                                            Rechazar
                                                        </button>
                                                    </form>

                                                @endif

                                                {{-- Registrar atención médica --}}
                                                @if ($appointment->status === 'Aceptada')

                                                    @if (!$appointment->medicalAttention)
                                                        <a href="{{ route('professional.attentions.create', $appointment) }}"
                                                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-center px-3 py-2 rounded">
                                                            Registrar atención
                                                        </a>
                                                    @else
                                                        <span class="text-green-700 font-semibold">
                                                            Atención registrada
                                                        </span>
                                                    @endif

                                                @endif

                                                {{-- Ver historia clínica --}}
                                                <a href="{{ route('professional.medical-history.index', $appointment->patient_id) }}"
                                                    class="inline-block bg-purple-600 hover:bg-purple-700 text-white text-center px-3 py-2 rounded">
                                                    Ver historia clínica
                                                </a>

                                                {{-- Solicitud rechazada --}}
                                                @if ($appointment->status === 'Rechazada')
                                                    <span class="text-gray-500">
                                                        Solicitud rechazada
                                                    </span>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                @endif

                {{-- Regresar al panel --}}
                <div class="mt-6">
                    <a href="{{ route('professional.dashboard') }}"
                        class="text-blue-600 hover:underline">
                        Volver al panel principal
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
