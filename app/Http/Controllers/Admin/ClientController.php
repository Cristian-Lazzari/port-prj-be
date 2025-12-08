<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    private $validations = [

        'mail'       => 'required|string|min:5|unique:clients,mail',
        'phone'      => 'required|min:9',
        'name'       => 'required|string',
        'surname'    => 'required|string',
        'document'=> 'nullable|file|mimes:pdf,jpg,jpeg,png,gif,webp,svg,bmp,tiff|max:1024',
    ];
    private $validations_1 = [

        'mail'       => 'required|string|min:2',
        'phone'      => 'required|min:9',
        'name'       => 'required|string',
        'surname'    => 'required|string',

        'document'=> 'nullable|file|mimes:pdf,jpg,jpeg,png,gif,webp,svg,bmp,tiff|max:1024',
    ];
    
    public function index()
    {
        $clients = Client::with('reservations','boats')->orderBy('created_at', 'desc')->get();

        return view('admin.Clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.Clients.create');
    }

    public function changeStatus(Request $request){
        $client = Client::findOrFail($request['id']);
        if($client->status == 0){
            $client->status = 1;
            $m = 'Il cliente "' . $client->surname . '" è stato attivato correttamente';
        }else{
            $client->status = 0;
            $m = 'Il cliente "' . $client->surname . '" è stato disattivato correttamente'; 
        }
        $client->update();
        return to_route('admin.clients.index')->with('message', $m);      
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate($this->validations);
        
        
        $client = new Client();

        $client->name = $data['name'];
        $client->surname = $data['surname'];
        $client->phone = $data['phone'];
        $client->mail = $data['mail'];
        $client->note = $data['note'];
        
        if (isset($data['document'])) {
            $documentPath = Storage::put('public/uploads', $data['document']);
            $client->document = $documentPath;
        } 
        $client->save();

        if (isset($data['add_new'])) {
            $m = 'Il cliente "' . $data['surname'] . '" è stato registrato correttamente. Puoi aggiungerne un altro';
            return to_route('admin.clients.create')->with('create_success', $m);      
        }
        
        $m = 'Il cliente "' . $data['surname'] . '" è stato registrato correttamente';
        return to_route('admin.clients.index')->with('message', $m);      
    }

  
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.Clients.show', compact('client'));
    }


    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.Clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $request->validate($this->validations_1);
        
        
        $client = Client::findOrFail($id);

        $client->name = $data['name'];
        $client->surname = $data['surname'];
        $client->phone = $data['phone'];
        $client->mail = $data['mail'];
        $client->note = $data['note'];
        if (isset($data['document'])) {
            if($client->document){
                Storage::delete($client->document);
            }
            $documentPath = Storage::put('public/uploads', $data['document']);
            $client->document = $documentPath;
        } 
        $client->update();

        $message = 'Il cliente "' . $data['surname'] . '" è stato modificato correttamente';
        return to_route('admin.clients.index')->with('message', $message);   
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        
        // stacca tutte le associazioni con le reservations
        $client->reservations()->delete();
        $client->boats()->delete();
        $client->delete();

        $m = 'Il cliente  "' . $client->name . ' ' . $client->name . ' è stato eliminato correttamente';
        return to_route('admin.clients.index')->with('message', $m);      
    }
}
