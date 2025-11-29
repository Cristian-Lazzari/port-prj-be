<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Str;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        // Creiamo 10 clienti di esempio
        for ($i = 0; $i < 10; $i++) {
            Client::create([
                'name' => fake()->name(),
                'surname' => fake()->name(),
                'mail' => fake()->unique()->safeEmail(),
                'phone' => fake()->phoneNumber(),
            ]);
        }
    }
}
