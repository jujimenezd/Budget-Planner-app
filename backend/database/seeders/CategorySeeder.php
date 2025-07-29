<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{

    public function run()
    {
        $data = [
            ['name' => 'Sueldo', 'type' => 'income'],
            ['name' => 'Comida', 'type' => 'expense'],
            ['name' => 'Transporte', 'type' => 'expense'],
            ['name' => 'Entretenimiento', 'type' => 'expense'],
            ['name' => 'Ahorros', 'type' => 'income'],
            ['name' => 'Alquiler', 'type' => 'expense'],
            ['name' => 'Servicios Públicos', 'type' => 'expense'],
            ['name' => 'Internet', 'type' => 'expense'],
            ['name' => 'Celular', 'type' => 'expense'],
            ['name' => 'Salud', 'type' => 'expense'],
            ['name' => 'Medicinas', 'type' => 'expense'],
            ['name' => 'Bonificación', 'type' => 'income'],
            ['name' => 'Premios', 'type' => 'income'],
            ['name' => 'Inversiones', 'type' => 'income'],
            ['name' => 'Regalos', 'type' => 'income'],
            ['name' => 'Ropa', 'type' => 'expense'],
            ['name' => 'Hogar', 'type' => 'expense'],
            ['name' => 'Viajes', 'type' => 'expense'],
            ['name' => 'Mascotas', 'type' => 'expense'],
            ['name' => 'Estudios', 'type' => 'expense'],
            ['name' => 'Cursos', 'type' => 'expense'],
            ['name' => 'Freelance', 'type' => 'income'],
            ['name' => 'Ventas', 'type' => 'income'],
            ['name' => 'Consultoría', 'type' => 'income'],
            ['name' => 'Intereses bancarios', 'type' => 'income'],
            ['name' => 'Donaciones', 'type' => 'income'],
            ['name' => 'Electrodomésticos', 'type' => 'expense'],
            ['name' => 'Suscripciones', 'type' => 'expense'],
            ['name' => 'Cuidado personal', 'type' => 'expense'],
            ['name' => 'Herramientas', 'type' => 'expense'],
        ];

        foreach ($data as $entry) {
            Category::create([
                'name' => $entry['name'],
                'type' => $entry['type'],
            ]);
        }
    }
}