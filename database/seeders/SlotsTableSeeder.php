<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slot;

class SlotsTableSeeder extends Seeder
{
    public function run()
    {
        $slotNames = ['A01','A02','B01','B02','C01','C02'];

        foreach ($slotNames as $name) {
            Slot::create([
                'name' => $name,
                'price' => rand(50, 100),    // prezzo
                'loa' => rand(50, 100),    // max lunghezza
                'draft' => rand(10, 20),   // max pescaggio
                'beam' => rand(10, 20),    // max larghezza
            ]);
        }
    }
}
