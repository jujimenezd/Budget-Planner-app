<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['type' => 'income',  'desc' => 'Sueldo mensual',         'date' => '2025-06-01', 'category_id' => 1],
            ['type' => 'expense', 'desc' => 'gasto facturas',         'date' => '2025-06-02', 'category_id' => 7],
            ['type' => 'income',  'desc' => 'trabajo extra',          'date' => '2025-06-03', 'category_id' => 22],
            ['type' => 'income',  'desc' => 'Pago freelance',         'date' => '2025-06-07', 'category_id' => 22],
            ['type' => 'expense', 'desc' => 'Compra supermercado',    'date' => '2025-06-13', 'category_id' => 2],
            ['type' => 'expense', 'desc' => 'Pago arriendo',          'date' => '2025-06-30', 'category_id' => 6],
            ['type' => 'expense', 'desc' => 'Recibo luz',             'date' => '2025-06-05', 'category_id' => 7],
            ['type' => 'income',  'desc' => 'Venta de producto',      'date' => '2025-06-22', 'category_id' => 23],
            ['type' => 'expense', 'desc' => 'Pago transporte',        'date' => '2025-06-28', 'category_id' => 3],
            ['type' => 'income',  'desc' => 'Ingreso extra',          'date' => '2025-06-04', 'category_id' => 22],
            ['type' => 'expense', 'desc' => 'Salida con amigos',      'date' => '2025-06-03', 'category_id' => 4],
            ['type' => 'expense', 'desc' => 'Pago mensual gimnasio',  'date' => '2025-06-29', 'category_id' => 29],
            ['type' => 'expense', 'desc' => 'Recarga celular',         'date' => '2025-06-11', 'category_id' => 9],
            ['type' => 'income',  'desc' => 'Reembolso salud',         'date' => '2025-06-04', 'category_id' => 11],
            ['type' => 'expense', 'desc' => 'Donación iglesia',       'date' => '2025-06-05', 'category_id' => 26],
            ['type' => 'expense', 'desc' => 'imprevisto',       'date' => '2025-06-14', 'category_id' => 29],
            ['type' => 'expense', 'desc' => 'Arreglar Vehiculo',       'date' => '2025-06-22', 'category_id' => 3],
            ['type' => 'expense', 'desc' => 'Gasolina',       'date' => '2025-06-27', 'category_id' => 3],
            ['type' => 'expense', 'desc' => 'Familia',       'date' => '2025-06-12', 'category_id' => 17],
            ['type' => 'expense', 'desc' => 'Comprar materia prima',       'date' => '2025-06-11', 'category_id' => 30],
            ['type' => 'expense', 'desc' => 'Ropa Nueva',       'date' => '2025-06-28', 'category_id' => 16],
            ['type' => 'expense', 'desc' => 'fumigacion',       'date' => '2025-06-17', 'category_id' => 17],
            ['type' => 'expense', 'desc' => 'Ahorro mensual',       'date' => '2025-06-08', 'category_id' => 14],
            ['type' => 'expense', 'desc' => 'Subscripcion streaming',       'date' => '2025-06-24', 'category_id' => 28],
            ['type' => 'income', 'desc' => 'Bonificacion por rendimiento',       'date' => '2025-06-22', 'category_id' => 12],
            ['type' => 'expense', 'desc' => 'cena restaurante',       'date' => '2025-06-11', 'category_id' => 2],
            ['type' => 'income', 'desc' => 'reembolso',       'date' => '2025-06-07', 'category_id' => 5],
            ['type' => 'income', 'desc' => 'arriendo de habitacion',       'date' => '2025-06-15', 'category_id' => 6],
            ['type' => 'expense', 'desc' => 'pago curso online',       'date' => '2025-06-27', 'category_id' => 28],
            ['type' => 'expense', 'desc' => 'regalo familiar',       'date' => '2025-06-16', 'category_id' => 30],
        ];

        foreach ($data as $entry) {
            Transaction::create([
                'amount'           => rand(1000, 10000),
                'transaction_type' => $entry['type'],
                'description'      => $entry['desc'],
                'transaction_date' => $entry['date'],
                'user_id'          => rand(1, 8),
                'category_id'      => $entry['category_id'],
            ]);
        }
    }
}