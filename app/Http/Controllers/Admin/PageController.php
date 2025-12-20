<?php



namespace App\Http\Controllers\Admin;


use Carbon\Carbon;

use App\Models\User;
use App\Models\Player;
use App\Models\Setting;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    
    public function admin() { //calendar

        $year = $this->get_date();
        return view('admin.dashboard', compact('year'));

    }
    
    private function get_res(){
        $reservations = Reservation::with('slot', 'client', 'boat')->get();
        $days = [];

        foreach ($reservations as $reservation) {

            $arrivalDay = $reservation->start_date->format('Y-m-d');
            $departureDay = $reservation->end_date->format('Y-m-d');

            // Inizializza l'array del giorno se non esiste
            if (!isset($days[$arrivalDay])) {
                $days[$arrivalDay] = [
                    'arrivals' => [],
                    'departures' => []
                ];
            }

            if (!isset($days[$departureDay])) {
                $days[$departureDay] = [
                    'arrivals' => [],
                    'departures' => []
                ];
            }

            // Aggiungi arrivo
            $days[$arrivalDay]['arrivals'][] = $reservation;

            // Aggiungi partenza
            $days[$departureDay]['departures'][] = $reservation;
        }

        // Ordina per data
        ksort($days);

        return $days;

    }
    private function get_date(){
        $firstDate     = Reservation::orderBy('start_date', 'asc')->value('start_date') ?? Carbon::now();
        $lastDate      = Reservation::orderBy('start_date', 'desc')->value('start_date');

        //$adv = json_decode(Setting::where('name', 'advanced')->first()->property, 1);

       
        $reserved = $this->get_res();

        $days = [];

        $now = Carbon::now();
        
        $first_day = $firstDate->diffInDays($now) < 0 ? $now : $firstDate;
        
        $day_in_calendar = $firstDate->diffInDays($lastDate) + 90; // giorni da mostrare dalla prima a 90 giorni da oggi

        for ($i = 0 ; $i < $day_in_calendar; $i++) { 
            $day = [
                'date' => $first_day->format('Y-m-d'),
                'year' => $first_day->year,
                'day' => $first_day->format('j'), // 1 - 31
                'month' => $first_day->month, // 1 - 12
                'day_w' => $first_day->format('N'), // 1 = lunedì, 7 = domenica

                'arrivals' => [],
                'departures' => [],

                'status' => true, // libero, pieno, parziale 
            ];

            if(isset($reserved[$day['date']])) {
                if(!empty($reserved[$day['date']]['arrivals'])){
                    $day['arrivals'] = $reserved[$day['date']]['arrivals'];
                }
                if(!empty($reserved[$day['date']]['departures'])){
                    $day['departures'] = $reserved[$day['date']]['departures'];
                }

            }

            $days[] = $day;    
            $first_day->addDay();
        }
        
        $result = [];

        foreach ($days as $day) {
            $monthNumber = $day['month'];
            $year = $day['year'];

            // se il mese non esiste ancora, inizializzalo
            if (!isset($result[$monthNumber])) {
                $result[$monthNumber] = [
                    'year' => $year,
                    'month' => $monthNumber,
                    'days' => []
                ];
            }

            // aggiungi il giorno dentro il mese corrispondente
            $result[$monthNumber]['days'][] = $day;
        }

         //dd($result);
        return array_values($result);
    }



}
