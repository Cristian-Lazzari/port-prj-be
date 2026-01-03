<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\BoatsTableSeeder;
use Database\Seeders\SlotsTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\ModelsTableSeeder;
use Database\Seeders\ClientsTableSeeder;
use Database\Seeders\SettingsTableSeeder;
use Database\Seeders\ReservationsTableSeeder;



class DatabaseSeeder extends Seeder
{
    public function run()
    {
     

        $this->call([
            UsersTableSeeder::class,
            SettingsTableSeeder::class,
            ClientsTableSeeder::class,
            BoatsTableSeeder::class,
            SlotsTableSeeder::class,
            ReservationsTableSeeder::class,
            ModelsTableSeeder::class,
        ]);

    }
}
