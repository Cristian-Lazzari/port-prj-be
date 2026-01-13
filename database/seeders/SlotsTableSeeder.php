<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slot;

class SlotsTableSeeder extends Seeder
{
    public function run()
    {


        for ($i=1; $i < 24; $i++) { 
            Slot::create([
                'name' => 'A' . sprintf('%02d', $i),
                'price' => 0,    // prezzo
                'draft' => 0,   // max pescaggio
                'loa' => 900,    // 
                'beam' => 250,     // 
                'pos_y' => 900 + ($i * 2),
                'pos_x' => 240 + ($i * 55),    
                'rotation' =>2,
            ]);
        }
        for ($i=1; $i < 12; $i++) { 
            Slot::create([
                'name' => 'B' . sprintf('%02d', $i),
                'price' => 0,    // prezzo
                'draft' => 0,   // max pescaggio
                'loa' => 900,    // 
                'beam' => 250,     // 
                'pos_y' => 800,
                'pos_x' => 1700 + ($i * 50),    
                'rotation' =>2,
    
            ]);
        }
        for ($i=12; $i < 24; $i++) { 
            Slot::create([
                'name' => 'B' . sprintf('%02d', $i),
                'price' => 0,    // prezzo
                'draft' => 0,   // max pescaggio
                'loa' => 900,    // 
                'beam' => 250,     // 
                'pos_y' =>1000,
                'pos_x' => 1200 + ($i * 50),    
                'rotation' =>2,
    
            ]);
        }
        for ($i=1; $i < 12; $i++) { 
            Slot::create([
                'name' => 'C' . sprintf('%02d', $i),
                'price' => 0,    // prezzo
                'draft' => 0,   // max pescaggio
                'loa' => 900,    // 
                'beam' => 250,     // 
                'pos_y' => 1480,
                'pos_x' => 1800 + ($i * 50),    
                'rotation' =>2,
    
            ]);
        }
        $i=0;


    }
}
