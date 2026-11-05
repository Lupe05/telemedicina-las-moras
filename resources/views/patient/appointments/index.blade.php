<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mis citas médicas
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-700">
                        Historial de solicitudes de citas
                    </h3>

                    <a
                        href="{{ route('patient.appointments.create') }}"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                    >
                        + Solicitar cita
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($appointments->isEmpty())
                    <div class="p-6 text-center text-gray-500">
                        Todavía no tienes citas médicas registradas.
                    </div>
                @else

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="p-3 border">Profesional</th>
                                    <th class="p-3 border">Especialidad</th>
                                    <th class="p-3 border">Fecha y hora</th>
                                    <th class="p-3 border">Motivo</th>
                                    <th class="p-3 border">Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td class="p-3 border">
                                            {{ $appointment->professional->user->name ?? 'No disponible' }}
                                        </td>

                                        <td class="p-3 border">
                                            {{ $appointment->professional->specialty ?? 'No disponible' }}
                                        </td>

                                        <td class="p-3 border">
                                            {{ $appointment->appointment_date->format('d/m/Y H:i') }}
                                        </td>

                                        <td class="p-3 border">
                                            {{ $appointment->reason }}
                                        </td>

                                        <td class="p-3 border">
                                            {{ $appointment->status }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @endif

            </div>
        </div>
    </div>
</x-app-layout>