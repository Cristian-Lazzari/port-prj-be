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
                'draft' => rand(10, 20),   // max pescaggio
                'beam' => rand(240, 550),    // 
                'loa' => rand(840, 2000),     // 
                'pos_y' => rand(500, 700),
                'pos_x' => rand(270, 900),    
                'rotation' =>5,

            ]);
        }
    }
}
