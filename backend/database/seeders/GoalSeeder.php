<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Goal;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Viaje a Japón', 'deadline' => '2025-12-20'],
            ['name' => 'Compra de portátil', 'deadline' => '2025-10-15'],
            ['name' => 'Curso de inglés', 'deadline' => '2025-08-30'],
            ['name' => 'Ahorros para emergencia', 'deadline' => '2025-11-10'],
            ['name' => 'Bicicleta nueva', 'deadline' => '2025-09-01'],
            ['name' => 'Mudanza', 'deadline' => '2025-07-25'],
            ['name' => 'Pago de universidad', 'deadline' => '2025-08-15'],
            ['name' => 'Regalo de aniversario', 'deadline' => '2025-09-10'],
            ['name' => 'Renovar celular', 'deadline' => '2025-07-30'],
            ['name' => 'Viaje familiar', 'deadline' => '2025-12-05'],
            ['name' => 'Concierto favorito', 'deadline' => '2025-11-02'],
            ['name' => 'Monitor gamer', 'deadline' => '2025-08-20'],
            ['name' => 'Escritorio nuevo', 'deadline' => '2025-10-10'],
            ['name' => 'Ahorro navideño', 'deadline' => '2025-12-24'],
            ['name' => 'Matrícula del carro', 'deadline' => '2025-09-30'],
            ['name' => 'Vacaciones en playa', 'deadline' => '2025-12-01'],
            ['name' => 'Reparación del auto', 'deadline' => '2025-10-05'],
            ['name' => 'Gimnasio anual', 'deadline' => '2025-07-15'],
            ['name' => 'Pago de deudas', 'deadline' => '2025-11-15'],
            ['name' => 'Hacer un máster', 'deadline' => '2026-01-31'],
            ['name' => 'Cámara profesional', 'deadline' => '2025-10-25'],
            ['name' => 'Instrumento musical', 'deadline' => '2025-08-22'],
            ['name' => 'Ropa nueva', 'deadline' => '2025-09-05'],
            ['name' => 'Tratamiento dental', 'deadline' => '2025-10-15'],
            ['name' => 'Computador de escritorio', 'deadline' => '2025-11-01'],
            ['name' => 'Capacitación online', 'deadline' => '2025-08-12'],
            ['name' => 'Viaje de fin de año', 'deadline' => '2025-12-28'],
            ['name' => 'Mudanza a otra ciudad', 'deadline' => '2025-11-22'],
            ['name' => 'Ahorro mensual', 'deadline' => '2025-12-31'],
            ['name' => 'Mascota nueva', 'deadline' => '2025-08-01'],
        ];

        foreach ($data as $goal) {
            $target = rand(500000, 500000000);
            $saved = rand(0, $target * 0.6);

            Goal::create([
                'name' => $goal['name'],
                'target_amount' => number_format($target, 2, '.', ''),
                'saved_amount' => number_format($saved, 2, '.', ''),
                'deadline' => $goal['deadline'],
                'user_id' => rand(1, 8),
            ]);
        }
    }
}