<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Budget;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['month' => '2025-04-15', 'limit' => 500000.00],
            ['month' => '2025-05-18', 'limit' => 860000.00],
            ['month' => '2025-01-23', 'limit' => 7200000.00],
            ['month' => '2025-07-11', 'limit' => 2500000.00],
            ['month' => '2025-06-21', 'limit' => 290000.00],
            ['month' => '2025-06-11', 'limit' => 750000.00],
            ['month' => '2025-06-26', 'limit' => 96400.00],
            ['month' => '2025-02-20', 'limit' => 557000.00],
            ['month' => '2025-06-01', 'limit' => 570000.00],
            ['month' => '2025-06-01', 'limit' => 1200000.00],
            ['month' => '2025-06-11', 'limit' => 500000.00],
            ['month' => '2025-06-25', 'limit' => 500000.00],
            ['month' => '2025-06-03', 'limit' => 500000.00],
            ['month' => '2025-06-06', 'limit' => 500000.00],
            ['month' => '2025-06-08', 'limit' => 500000.00],
            ['month' => '2025-04-15', 'limit' => 500000.00],
            ['month' => '2025-05-18', 'limit' => 860000.00],
            ['month' => '2025-01-23', 'limit' => 7200000.00],
            ['month' => '2025-07-11', 'limit' => 2500000.00],
            ['month' => '2025-06-21', 'limit' => 290000.00],
            ['month' => '2025-06-11', 'limit' => 750000.00],
            ['month' => '2025-06-26', 'limit' => 96400.00],
            ['month' => '2025-02-28', 'limit' => 557000.00],
            ['month' => '2025-06-01', 'limit' => 570000.00],
            ['month' => '2025-06-01', 'limit' => 1200000.00],
            ['month' => '2025-06-11', 'limit' => 500000.00],
            ['month' => '2025-06-25', 'limit' => 500000.00],
            ['month' => '2025-06-03', 'limit' => 500000.00],
            ['month' => '2025-06-06', 'limit' => 500000.00],
            ['month' => '2025-06-08', 'limit' => 500000.00],
        ];

        foreach ($data as $entry) {
            Budget::create([
                'month'=> $entry['month'],
                'limit'=> number_format($entry['limit'], 2, '.', ''), 
                'user_id'=> rand(1, 8),
                'category_id'=> rand(1, 30),
            ]);
        }
    }
}
