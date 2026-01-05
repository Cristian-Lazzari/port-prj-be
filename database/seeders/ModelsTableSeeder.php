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
                'name' => 'Registrazione cliente',
                'object' => 'Prenotazione ricevuta',
                'heading' => 'La tua prenotazione è in elaborazione',
                'body' => 'Ciao {{nome_cliente}} {{cognome_cliente}},\n\n abbiamo ricevuto correttamente la tua prenotazione presso il porto.\n Attualmente la prenotazione è <strong>in fase di elaborazione</strong> e sarà verificata dal nostro staff.\n\n Periodo richiesto: <strong>dal {{data_inizio}} al {{data_fine}}</strong>.\n\n Riceverai una nuova comunicazione non appena la prenotazione verrà confermata.',
                'ending' => 'Grazie per la tua richiesta.\nLo staff del porto',
                'sender' => 'Porto',
                'available_vars' => ['nome_cliente', 'cognome_cliente', 'data_inizio', 'data_fine'],
            ],

            [
                'name' => 'Registrazione cliente - interna',
                'object' => 'Nuovo utente registrato al porto',
                'heading' => 'Nuova registrazione ricevuta',
                'body' => 'Un nuovo utente si è registrato al porto.\n\n Nome: {{nome_cliente}} {{cognome_cliente}}\n Periodo prenotato: <strong>dal {{data_inizio}} al {{data_fine}}</strong>.\n\n Accedi al gestionale per visualizzare i dettagli della barca e della prenotazione.',
                'ending' => 'Notifica automatica dal sistema di gestione del porto',
                'sender' => 'Sistema Porto',
                'available_vars' => ['nome_cliente', 'cognome_cliente', 'data_inizio', 'data_fine'],
            ],
            [
                'name' => 'Annullamento cliente',
                'object' => 'Prenotazione annullata',
                'heading' => 'La tua prenotazione è stata annullata',
                'body' => 'Ciao {{nome_cliente}} {{cognome_cliente}},\n\n ti confermiamo che la tua prenotazione presso il porto è stata annullata.\n\n Periodo precedentemente prenotato: <strong>dal {{data_inizio}} al {{data_fine}}</strong>.\n\n Se l’annullamento non è stato effettuato da te, contatta subito il nostro staff.',
                'ending' => 'Restiamo a tua disposizione.\nLo staff del porto',
                'sender' => 'Porto',
                'available_vars' => ['nome_cliente', 'cognome_cliente', 'data_inizio', 'data_fine'],
            ],
            [
                'name' => 'Annullamento - interna',
                'object' => 'Prenotazione annullata da un cliente',
                'heading' => 'Prenotazione annullata',
                'body' => 'Un cliente ha annullato una prenotazione.\n\n Nome: {{nome_cliente}} {{cognome_cliente}}\n Periodo annullato: <strong>dal {{data_inizio}} al {{data_fine}}</strong>.\n\n Accedi al gestionale per verificare la disponibilità degli slot.',
                'ending' => 'Notifica automatica dal sistema',
                'sender' => 'Sistema Porto',
                'available_vars' => ['nome_cliente', 'cognome_cliente', 'data_inizio', 'data_fine'],
            ],
            [
                'name' => 'Prenotazione accettata cliente',
                'object' => 'Prenotazione confermata',
                'heading' => 'La tua prenotazione è stata accettata',
                'body' => 'Ciao {{nome_cliente}} {{cognome_cliente}},\n\n siamo lieti di informarti che la tua prenotazione presso il porto è stata <strong>accettata e confermata</strong>.\n\n Periodo confermato: <strong>dal {{data_inizio}} al {{data_fine}}</strong>.\n Barca: <strong>{{nome_barca}}</strong>\n Slot assegnato: <strong>{{slot}}</strong>\n\n Lo slot <strong>{{slot}}</strong> è stato assegnato all’imbarcazione <strong>{{nome_barca}}</strong>.\n\n Ti aspettiamo in porto per l’arrivo della tua imbarcazione.',
                'ending' => 'Buona navigazione.\nLo staff del porto',
                'sender' => 'Porto',
                'available_vars' => [
                    'nome_cliente',
                    'cognome_cliente',
                    'data_inizio',
                    'data_fine',
                    'nome_barca',
                    'slot'
                ],
            ],

        
        ];
      

        foreach ($settings as $s) {
            $s['available_vars'] = $s['available_vars'] ? json_encode($s['available_vars']) : '[]';
            Model::create($s);
        }
    }
}
