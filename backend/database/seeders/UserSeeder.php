<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => 'Juan' . $i,
                'role_id' => rand(1, 2),
                'email' => 'Juan' . $i . '@gmail.com',
                'password' => bcrypt('12345'),
                'remember_token' => '10',
            ]);
        }
    }
}