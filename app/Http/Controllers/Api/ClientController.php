<?php

namespace App\Http\Controllers\Api;

use App\Models\Boat;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        $user = Client::where('nickname', $request->nickname)->first();
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
        $client = Client::where('nickname', $data['nickname'])->where('mail', $data['mail'])->first();

        if($client){

            $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            $client->otp = password_hash($otp, PASSWORD_DEFAULT);
            $client->otp_expires_at = now()->addMinutes(5)->format('Y-m-d H:i:s');
            $client->update();
            $contact = json_decode(Setting::where('name', 'Contatti')->first()->property, 1);
            $bodymail = [
                'otp' => $otp,
                'email' => $client->mail,
                'nickname' => $client->nickname,
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
        
        return response()->json([
            'success' => true,
            'message' => 'Registrazione avvenuta con successo',
            'data' => $new_client
        ]);
    }
}
