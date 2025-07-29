<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    // Seeders para roles de administrador y usuario
    public function run()
    {
        Role::create([
            'name' => 'Administrador',
            'label' => 'admin',
            'description' => 'Administrador del sistema'
        ]);

        Role::create([
            'name' => 'Usuario',
            'label' => 'user',
            'description' => 'Usuario del sistema'
        ]);
    }
}