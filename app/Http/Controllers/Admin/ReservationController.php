<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Boat;
use App\Models\Slot;
use App\Models\Client;
use App\Models\Player;
use App\Models\Setting;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Mail\confermaOrdineAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{

    private $validations = [

        'end_date'      => 'required',
        'start_date'    => 'required',
        'boat_client'   => 'required',
       
    ];
    public function index()
    {
        $reservations = Reservation::with('client','boat')->orderBy('created_at', 'desc')->get();

        return view('admin.Reservations.index', compact('reservations'));
    }


    public function create()
    {
        $slots = Slot::all();
        $boats = Boat::all();
        return view('admin.Reservations.create', compact('boats', 'slots'));
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $id = json_decode($data['boat_client']);

        $newReservation = new Reservation();
        $newReservation->client_id = $id[1];
        $newReservation->boat_id = $id[0];
        $newReservation->slot_id = $data['slot_id'];
        $newReservation->start_date = Carbon::parse($data['start_date']);
        $newReservation->end_date = Carbon::parse($data['end_date']);
        $newReservation->status = $data['status'];
        $newReservation->payment = $data['payment'];
        $newReservation->message = $data['message'] ?? null;
        $newReservation->save();


        return redirect()->route('admin.reservations.index')->with('message', 'Prenotazione creata con successo');
    }

    // public function show($id)
    // {
    //     $reservation = Reservation::where('id',$id)->with('players')->first();
        

    //     return view('admin.Reservations.show', compact('reservation'));
    // }

    public function edit($id)
    {
        $reservation = Reservation::where('id',$id)->first();
        $slots = Slot::all();
       
        return view('admin.Reservations.edit', compact('reservation', 'slots'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();

        $reservation = Reservation::where('id',$id)->first();   
        //dd($data);
        $id = json_decode($data['boat_client']);     

        $reservation->client_id = $id[1];
        $reservation->boat_id = $id[0];
        $reservation->slot_id = $data['slot_id'];
        $reservation->start_date = Carbon::parse($data['start_date']);
        $reservation->end_date = Carbon::parse($data['end_date']);
        $reservation->status = $data['status'];
        $reservation->payment = $data['payment'];
        $reservation->message = $data['message'] ?? null;
        $reservation->save();

        return redirect()->route('admin.reservations.index')->with('message', 'Prenotazione modificata con successo');
    }


    public function destroy($id)
    {
        //
    }
}
