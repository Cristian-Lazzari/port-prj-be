<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContractController extends Controller
{
    public function index(){

    }
    public function edit(){
        $contract_body = json_decode(Setting::where('name', 'advanced')->first()->property, 1)['contract_body'];
       // $contract_path = json_decode(Setting::where('name', 'advanced')->first()->property, 1)['contract_path'];
        //dd($contract_body);
        $availableVariables = [ 
            'nome_cliente', 
            'cognome_cliente', 
            'telefono_cliente', 
            'mail_cliente', 
        ];

        return view('admin.Contract.edit', [
            'contract' => $contract_body,
            'variables' => $availableVariables,
        ]);

    }
    public function update(Request $request){
        // 1️⃣ Validazione
        $request->validate([
            'body' => 'required|string',
        ]);

        // Recupera le impostazioni esistenti
        $setting = Setting::where('name', 'advanced')->first();
        $data = json_decode($setting->property, true);

        // Aggiorna solo il corpo del contratto
        $data['contract_body'] = $request->body;

        // Salva di nuovo tutto il JSON
        $setting->property = json_encode($data);
        $setting->update();

        return redirect()->back()->with('message', 'Modello contratto aggiornato correttamente!');
    }
}
