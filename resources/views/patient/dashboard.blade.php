
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel del Paciente
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            {{-- Mensaje de bienvenida --}}
            <div class="bg-white p-6 rounded-lg shadow">

                <h3 class="text-2xl font-bold text-blue-700">
                    Bienvenido a Telemedicina Las Moras
                </h3>

                <p class="mt-3 text-gray-600">
                    Desde aquí podrás solicitar citas médicas,
                    consultar tus atenciones y acceder a tus
                    teleconsultas programadas.
                </p>

                <p class="mt-3 text-gray-700">
                    Hola, <strong>{{ Auth::user()->name }}</strong>.
                    Te damos la bienvenida a nuestra plataforma.
                </p>

                {{-- Módulos del paciente --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">

                    {{-- Solicitar cita --}}
                    <div class="p-5 bg-blue-50 rounded-lg border border-blue-100">
                        <h4 class="font-bold text-lg text-blue-800">
                            Solicitar cita
                        </h4>

                        <p class="text-sm text-gray-600 mt-2">
                            Solicita una nueva atención médica
                            con un profesional de salud.
                        </p>

                        <a
                            href="{{ route('patient.appointments.create') }}"
                            class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                        >
                            Solicitar ahora
                        </a>
                    </div>

                    {{-- Mis citas --}}
                    <div class="p-5 bg-green-50 rounded-lg border border-green-100">
                        <h4 class="font-bold text-lg text-green-800">
                            Mis citas
                        </h4>

                        <p class="text-sm text-gray-600 mt-2">
                            Consulta las fechas, profesionales
                            y estados de tus citas médicas.
                        </p>

                        <a
                            href="{{ route('patient.appointments.index') }}"
                            class="inline-block mt-4 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700"
                        >
                            Ver mis citas
                        </a>
                    </div>

                    {{-- Mi historial --}}
                    <div class="p-5 bg-purple-50 rounded-lg border border-purple-100">
                        <h4 class="font-bold text-lg text-purple-800">
                            Mi historial
                        </h4>

                        <p class="text-sm text-gray-600 mt-2">
                            Consulta tus atenciones y registros
                            médicos disponibles.
                        </p>

                        <span class="inline-block mt-4 px-4 py-2 bg-purple-200 text-purple-800 rounded-md">
                            Próximamente
                        </span>
                    </div>

                </div>

                {{-- Información adicional --}}
                <div class="mt-8 p-5 bg-gray-50 rounded-lg">
                    <h4 class="font-semibold text-gray-800">
                        Información importante
                    </h4>

                    <p class="mt-2 text-sm text-gray-600">
                        Recuerda revisar el estado de tus solicitudes
                        de citas médicas. Las solicitudes registradas
                        inicialmente tendrán el estado Pendiente hasta
                        que sean gestionadas por el profesional de salud.
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
