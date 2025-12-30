<?php

namespace App\Http\Controllers\Admin;

use App\Models\Date;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    
    public function index(){
        $settings = Setting::all()->keyBy('name');
        return view('admin.settings', compact('settings'));
    }

    public function updateAll(Request $request)
    {
        $setting = Setting::all()->keyBy('name');
        $data = $request->all();

        $setting['Servizio di Prenotazione Online']->status = $data['status_service'];
        $setting['Servizio di Prenotazione Online']->save();




        $contatti = [
            'phone'  => $request->phone,
            'email'     => $request->email,
            'instagram' => $request->instagram,
            'facebook'  => $request->facebook,
            'youtube'   => $request->youtube,
            'tiktok'    => $request->tiktok,
            'whatsapp'  => $request->whatsapp,
        ];
        $setting['Contatti']->property = json_encode($contatti);
        $setting['Contatti']->save();      

                
        $setting['Periodo di Ferie']->status = $request->ferie_status;
        $propertyArray = [
            'from' => $request->from,
            'to' => $request->to,
        ];
        $setting['Periodo di Ferie']->property = json_encode($propertyArray);
        $setting['Periodo di Ferie']->save();

        
        $oldPosition = json_decode($setting['Posizione']['property'], 1);

        if(isset($oldPosition['foto_maps'])){
            $posizione = [
                'foto_maps' =>  $oldPosition['foto_maps'],
                'link_maps' =>  $request->link_maps,
                'indirizzo' =>  $request->indirizzo,
            ];
        
            if (isset($request->foto_maps)) {
                $imagePath = $request->file('foto_maps')->store('public/uploads');
                $posizione['foto_maps'] = $imagePath;
            }
        }else{
            $posizione = [
                'foto_maps' =>  "",
                'link_maps' =>  $request->link_maps,
                'indirizzo' =>  $request->indirizzo,
            ];
            if (isset($request->foto_maps)) {
                $imagePath = $request->file('foto_maps')->store('public/uploads');
                $posizione['foto_maps'] = $imagePath;
            }
        }
        $setting['Posizione']->property = json_encode($posizione);
        $setting['Posizione']->save();

        
        $m = 'Le impostazioni sono state ggiornate correttamente';

        return redirect()->back()->with('success', $m);   
    }

    public function cancelDates(Request $request){
        $data = $request->all();
        $s = Setting::where('name', 'advanced')->first();
        // /dd($data['day_off']);
        $adv = json_decode($s->property, 1);
        $adv['day_off'] = $data['day_off'] ?? [];

        $s->property = json_encode($adv);
        $s->update();
        
        return redirect()->route('admin.dashboard')->with('message', 'Le date sono state modificate correttamente');

    }
}
