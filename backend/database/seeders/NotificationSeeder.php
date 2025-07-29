<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['message' => 'Tu meta "Viaje a Japón" está a punto de cumplirse.', 'date' => '2025-06-01'],
            ['message' => 'Has recibido un nuevo ingreso en tu cuenta.', 'date' => '2025-06-03'],
            ['message' => 'Recuerda revisar tus gastos de esta semana.', 'date' => '2025-06-05'],
            ['message' => '¡Felicidades! Alcanzaste el 50% de tu objetivo "Nuevo PC".', 'date' => '2025-06-06'],
            ['message' => 'Tu suscripción al gimnasio vence pronto.', 'date' => '2025-06-07'],
            ['message' => 'Recibiste una transferencia de un contacto.', 'date' => '2025-06-08'],
            ['message' => 'Has creado una nueva meta: "Curso de Inglés".', 'date' => '2025-06-10'],
            ['message' => 'Tu gasto en transporte aumentó este mes.', 'date' => '2025-06-11'],
            ['message' => 'Revisa tus presupuestos para el mes de julio.', 'date' => '2025-06-12'],
            ['message' => 'Tu meta "Vacaciones familiares" está estancada.', 'date' => '2025-06-13'],
            ['message' => 'Has leído todos tus mensajes.', 'date' => '2025-06-14'],
            ['message' => 'Hay nuevas categorías disponibles para tus gastos.', 'date' => '2025-06-15'],
            ['message' => 'Tu saldo actual permite cubrir el 80% de tus metas.', 'date' => '2025-06-16'],
            ['message' => 'Agrega una categoría para "Regalos de cumpleaños".', 'date' => '2025-06-17'],
            ['message' => 'Recuerda actualizar tus metas financieras.', 'date' => '2025-06-18'],
            ['message' => '¡Bienvenido de nuevo! Esperamos que estés ahorrando bien.', 'date' => '2025-06-19'],
            ['message' => 'Tu gasto en entretenimiento ha disminuido.', 'date' => '2025-06-20'],
            ['message' => 'Revisa tus ingresos mensuales.', 'date' => '2025-06-21'],
            ['message' => '¡Meta completada! "Matrícula de la universidad".', 'date' => '2025-06-22'],
            ['message' => 'Actualiza tus ingresos para un mejor seguimiento.', 'date' => '2025-06-23'],
            ['message' => 'Nuevo consejo de ahorro disponible.', 'date' => '2025-06-24'],
            ['message' => 'Tu amigo Juan te envió una recomendación.', 'date' => '2025-06-25'],
            ['message' => 'Hoy vencen varias metas, revísalas.', 'date' => '2025-06-26'],
            ['message' => 'Has superado tu presupuesto en comida.', 'date' => '2025-06-27'],
            ['message' => 'Objetivo mensual alcanzado.', 'date' => '2025-06-28'],
            ['message' => 'Tu cuenta fue accedida desde un nuevo dispositivo.', 'date' => '2025-06-29'],
            ['message' => 'Meta duplicada detectada: "Viaje a playa".', 'date' => '2025-06-30'],
            ['message' => 'Ahorro registrado correctamente.', 'date' => '2025-07-01'],
            ['message' => 'Transacción grande registrada, verifica el origen.', 'date' => '2025-07-02'],
            ['message' => 'Tu resumen financiero está listo.', 'date' => '2025-07-03'],
        ];

        foreach ($data as $entry) {
            Notification::create([
                'message'  => $entry['message'],
                'date'     => $entry['date'],
                'read'     => rand(0, 1),
                'user_id'  => rand(1, 8),
            ]);
        }
    }
}