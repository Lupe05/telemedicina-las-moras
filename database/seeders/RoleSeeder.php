<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrador',
                'description' => 'Gestiona usuarios y configuración del sistema.'
            ],
            [
                'name' => 'Profesional de salud',
                'description' => 'Gestiona citas y registra atenciones médicas.'
            ],
            [
                'name' => 'Paciente',
                'description' => 'Solicita citas y consulta su información médica.'
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role['name']],
                ['description' => $role['description']]
            );
        }
    }
}