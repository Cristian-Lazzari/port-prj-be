<?php

namespace Database\Seeders;

use App\Models\Model;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'name' => 'Conferma registrazione',  
                'object' => 'Conferma registrazione',  
                'heading' => '',
                'body' => 'La informiamo che la registrazione al nostro sito è avvenuta correttamente e che la prenotazione è stata presa in carico con successo. /*/  La attendiamo presso il nostro locale secondo i dettagli indicati al momento della prenotazione. /*/ Attraverso il suo account potrà consultare in qualsiasi momento le informazioni relative alla prenotazione ed eventuali servizi disponibili./*/ Cordiali saluti,',
                'ending' => 'Per qualsiasi necessità o richiesta di modifica, la invitiamo a contattare direttamente il locale.',
                'sender' => 'La direzione',
                'available_vars' => ['nome_cliente','cognome_cliente', 'data_inizio', 'data_fine'],
                'img_1' => '',
                'img_2' => '',
            ],
            [
                'name' => 'Conferma registrazione - Admin',  
                'object' => 'Nuova registrazione e prenotazione ricevuta',  
                'heading' => 'È stata effettuata una nuova registrazione al sito con contestuale prenotazione.',
                'body' => 'La prenotazione è stata inserita correttamente nel sistema ed è ora visibile dal pannello di gestione, dove è possibile consultarne i dettagli ed effettuare eventuali modifiche. /*/ Si invita lo staff a verificare la disponibilità e a gestire la prenotazione secondo le procedure interne del locale.',
                'ending' => 'Per qualsiasi necessità o richiesta di modifica, la invitiamo a contattare direttamente il locale.',
                'sender' => 'sistema automatico',
                'available_vars' => ['nome_cliente', 'cognome_cliente', 'data_inizio', 'data_fine'],
                'img_1' => '',
                'img_2' => '',
            ],
            // [
            //     'name' => 'Accesso avvenuto',  
            //     'object' => 'Conferma registrazione',  
            //     'heading' => '',
            //     'body' => '',
            //     'ending' => '',
            //     'sender' => '',
            //     'img_1' => '',
            //     'img_2' => '',
            // ],
        
            
        ];
      

        foreach ($settings as $s) {
            $s['available_vars'] = $s['available_vars'] ? json_encode($s['available_vars']) : '[]';
            Model::create($s);
        }
    }
}
