
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Panel del Administrador
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-2xl font-bold text-blue-700">
                    Administración de Telemedicina Las Moras
                </h3>

                <p class="mt-3 text-gray-600">
                    Desde este panel podrás administrar los
                    usuarios y supervisar la configuración
                    general de la plataforma.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="p-4 bg-blue-50 rounded-lg">
                        <h4 class="font-bold">Usuarios</h4>
                        <p class="text-sm">Gestiona las cuentas registradas.</p>
                    </div>

                    <div class="p-4 bg-green-50 rounded-lg">
                        <h4 class="font-bold">Profesionales</h4>
                        <p class="text-sm">Consulta los profesionales registrados.</p>
                    </div>

                    <div class="p-4 bg-purple-50 rounded-lg">
                        <h4 class="font-bold">Citas</h4>
                        <p class="text-sm">Supervisa las citas de la plataforma.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
