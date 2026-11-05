<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Panel del Profesional de Salud
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            <div class="bg-white p-6 rounded-lg shadow">

                <h3 class="text-2xl font-bold text-blue-700">
                    Bienvenido, {{ Auth::user()->name }}
                </h3>

                <p class="mt-3 text-gray-600">
                    Desde este panel podrás gestionar tus citas,
                    realizar teleconsultas y registrar atenciones médicas.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">

                    <!-- Agenda médica -->
                    <div class="p-5 bg-blue-50 rounded-lg">
                        <h4 class="font-bold text-blue-800">
                            Agenda médica
                        </h4>

                        <p class="text-sm text-gray-600 mt-2">
                            Consulta las solicitudes de citas registradas por tus pacientes.
                        </p>

                        <a href="{{ route('professional.appointments.index') }}"
                           class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Ver mis citas
                        </a>
                    </div>

                    <!-- Teleconsultas -->
                    <div class="p-5 bg-green-50 rounded-lg">
                        <h4 class="font-bold text-green-800">
                            Teleconsultas
                        </h4>

                        <p class="text-sm text-gray-600 mt-2">
                            Accede a las teleconsultas programadas con tus pacientes.
                        </p>

                        <span class="inline-block mt-4 px-4 py-2 bg-gray-300 text-gray-700 rounded-md">
                            Próximamente
                        </span>
                    </div>

                    <!-- Atenciones médicas -->
                    <div class="p-5 bg-purple-50 rounded-lg">
                        <h4 class="font-bold text-purple-800">
                            Atenciones médicas
                        </h4>

                        <p class="text-sm text-gray-600 mt-2">
                            Registra diagnósticos, observaciones e indicaciones médicas.
                        </p>

                        <span class="inline-block mt-4 px-4 py-2 bg-gray-300 text-gray-700 rounded-md">
                            Próximamente
                        </span>
                    </div>

                </div>

                <!-- Información adicional -->
                <div class="mt-8 p-5 border rounded-lg">
                    <h4 class="font-semibold text-gray-700">
                        Información del profesional
                    </h4>

                    <p class="mt-2 text-gray-600">
                        Nombre: {{ Auth::user()->name }}
                    </p>

                    <p class="mt-1 text-gray-600">
                        Correo electrónico: {{ Auth::user()->email }}
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
