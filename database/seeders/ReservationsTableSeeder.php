<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\Client;
use App\Models\Boat;
use App\Models\Slot;

class ReservationsTableSeeder extends Seeder
{
    public function run()
    {
        $clients = Client::all();
        $slots = Slot::all();

        foreach ($clients as $client) {
            $boats = $client->boats;

            foreach ($boats as $boat) {
                // Ogni barca fa 1-3 prenotazioni
                $reservationsCount = rand(1, 3);

                for ($i = 0; $i < $reservationsCount; $i++) {
                    $slot = $slots->random();

                    $start = now()->addDays(rand(1, 30))->setHour(rand(8, 18))->setMinute(0);
                    $end = (clone $start)->addDays(rand(1, 30));

                    // Solo se compatibile con lo slot
                    if ($boat->loa <= $slot->loa && $boat->draft <= $slot->draft && $boat->beam <= $slot->beam) {
                        Reservation::create([
                            'client_id' => $client->id,
                            'boat_id' => $boat->id,
                            'slot_id' => $slot->id,
                            'start_date' => $start,
                            'end_date' => $end,
                            'payment' => '1',
                        ]);
                    }
                }
            }
        }
    }
}
