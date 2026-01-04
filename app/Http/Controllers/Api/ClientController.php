<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Boat;
use App\Mail\otpUser;
use App\Models\Model;
use App\Models\Client;
use App\Models\Setting;
use App\Mail\BuildableMail;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    private $validations = [
        'mail'       => 'required|string|min:5|unique:clients,mail',
        'phone'      => 'required|min:9',
        'name'       => 'required|string',
        'surname'    => 'required|string',
        'loa'    => 'required',
        'draft'    => 'required',
        'beam'    => 'required',
        'type'    => 'required',
        'model'    => 'required',
    ];

    public function verifyOtp(Request $request){

        $user = Client::where('mail', $request->mail)->with('boats', 'reservations')->first();
        $expire = Carbon::parse($user->otp_expires_at); // Convert to Carbon instance
        if ($expire < now()) {
            return response()->json([
                'success' => false,
                'message' => 'OTP scaduto',
            ]); 
        }
        if (password_verify($request->otp, $user->otp)) {
            // invalida OTP
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->save();

            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'OTP errato',
        ]); 
    }

    public function login_client(Request $request)
    {
        $data = $request->all();
        $client = Client::where('name', $data['name'])->where('surname', $data['surname'])->where('mail', $data['mail'])->first();

        if($client){

            $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            $client->otp = password_hash($otp, PASSWORD_DEFAULT);
            $client->otp_expires_at = now()->addMinutes(5)->format('Y-m-d H:i:s');
            $client->update();
            $contact = json_decode(Setting::where('name', 'Contatti')->first()->property, 1);
            $bodymail = [
                'otp' => $otp,
                'email' => $client->mail,
                'name' => $client->name . ' ' . $client->surname,
                'admin_phone' => $contact['phone'],
            ];
           
            $mail = new otpUser($bodymail);
            Mail::to($bodymail['email'])->send($mail);

            return response()->json([
                'success' => true,
                'message' => 'Mail per Login inviata con successo',
                'data' => $client
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Nessun utente trovato con queste credenziali',
                'data' => []
            ]); 
        }
    }

    public function register(Request $request){
        $data = $request->all();
        $existingPlayer = Client::where('mail', $data['mail'])->first();
        if($existingPlayer){
            return response()->json([
                'success' => false,
                'message' => 'Email già in uso',
            ]); 
        }
        $new_client = new Client();
        $new_client->name = $data['name'];
        $new_client->surname = $data['surname'];
        
        $new_client->mail = $data['mail'];
        $new_client->phone = $data['phone'] ?? null;
        
        $boat = new Boat();
        $new_client->save();
        
        $boat->name = $data['boat']['name'];
        $boat->loa = $data['boat']['loa'];
        $boat->draft = $data['boat']['draft'];
        $boat->beam = $data['boat']['beam'];
        $boat->serial_code = $data['boat']['serial_code'];
        $boat->type = $data['boat']['type'];
        $boat->model = $data['boat']['model'];
        $boat->client_id = $new_client->id;
        
        $boat->save();
        
        $reservation = new Reservation();
        $reservation->start_date = $data['start_date'];
        $reservation->end_date = $data['end_date'];
        $reservation->message = $data['message'];
        $reservation->payment = $data['payment'];
        $reservation->client_id = $new_client->id;
        $reservation->boat_id = $boat->id;
        $reservation->save();


        $model = Model::where('name','Conferma registrazione')->first();

        $contractHtml = json_decode(Setting::where('name', 'advanced')->first()->property, 1)['contract_body'];
        $admin_phone = json_decode(Setting::where('name', 'Contatti')->first()->property, 1)['phone'];

        $variables = [
            '{{nome_cliente}}' => $new_client->name,
        ];

        foreach($variables as $key => $value) {
            $contractHtml = str_replace($key, $value, $contractHtml);
        }
        
        $pdf = Pdf::loadHTML($contractHtml)->setPaper('A4', 'portrait');
        // Se vuoi salvare temporaneamente
        $pdfFolder = storage_path('app/temp');
        if(!file_exists($pdfFolder)) {
            mkdir($pdfFolder, 0755, true); // true = crea anche eventuali sottocartelle mancanti
        }

        $pdfPath = $pdfFolder.'/contract_'.$reservation->id.'.pdf';
        $pdf->save($pdfPath);
        
        $vars = [
            'nome_cliente'   => $new_client->name,
            'cognome_cliente'=> $new_client->surname,
            'data_inizio'    => $reservation->start_date->format('d/m/Y'),
            'data_fine'      => $reservation->end_date->format('d/m/Y'),
        ];
        $body = $this->parseTemplate($model->body, $vars);
        $contentMail = [
            'name' => '',
            'object' => $model->object,
            'heading' => $model->heading,
            'body' => explode("/*/", $body),
            'ending' => $model->ending,
            'sender' => $model->sender,
            'img_1' => $model->img_1,
            'img_2' => $model->img_2,
            'admin_phone' => $admin_phone,

        ];

        $mail = new BuildableMail($contentMail);
        Mail::to($data['mail'])->send($mail)
            ->attach($pdfPath, [
                'as' => 'Contratto.pdf',
                'mime' => 'application/pdf'
            ]);




        foreach($variables as $key => $value) {
            $contractHtml = str_replace($key, $value, $contractHtml);
        }



    
        
        return response()->json([
            'success' => true,
            'message' => 'Registrazione avvenuta con successo',
            'user' => $new_client,
            'boat' => $boat,
            'reservation' => $reservation
        ]);
    }
    function parseTemplate(string $text, array $data): string
    {
        foreach ($data as $key => $value) {
            $text = str_replace('{{'.$key.'}}', $value, $text);
        }

        return $text;
    }
}
