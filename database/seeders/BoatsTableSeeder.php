<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Boat;
use App\Models\Client;

class BoatsTableSeeder extends Seeder
{
    public function run()
    {
        $clients = Client::all();

        foreach ($clients as $client) {
            // Ogni cliente ha 1-2 barche
            $boatsCount = rand(1, 2);
            for ($i = 0; $i < $boatsCount; $i++) {
                Boat::create([
                    'client_id' => $client->id,
                    'name' => 'Boat ' . strtoupper(fake()->lexify('???')),
                    'loa' => rand(20, 100),    // lunghezza in decimetri
                    'draft' => rand(5, 20),    // pescaggio in decimetri
                    'beam' => rand(5, 20),     // larghezza in decimetri
                    'serial_code' => rand(5, 20),     // larghezza in decimetri
                    'type' => rand(1, 3),     // larghezza in decimetri
                ]);
            }
        }
    }
}
