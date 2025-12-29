<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Slot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlotController extends Controller
{
    private $validations = [
        'name'      => 'required|string',
        'loa'       => 'required',
        //'draft'     => 'required',
        'beam'      => 'required',
        'price'     => 'required',
    ];
    public function index()
    {
        $slots = Slot::with('reservations')->orderBy('created_at', 'desc')->get();
        $time_filter = Carbon::now();

        return view('admin.Slots.index', compact('slots','time_filter'));
    }
    

    public function create()
    {
        $slots = Slot::with('reservations')->orderBy('created_at', 'desc')->get();

        return view('admin.Slots.create', compact('slots'));
    }


    public function store(Request $request)
    {
        $data = $request->all(); 
        $request->validate($this->validations);

        
        $slot = new Slot();

        $slot->name = $data['name'];
        $slot->loa = $data['loa'];
        $slot->draft = $data['draft'] ?? 0;
        $slot->beam = $data['beam'];
        $slot->type = $data['type'];
        $slot->price = $data['price'];
        $slot->pos_x = $data['pos_x'];
        $slot->pos_y = $data['pos_y'];
        $slot->rotation = $data['rotation'] ?? 0;

        
        $slot->save();
        

        
        $m = 'Lo slot "' . $data['name'] . '" è stato registrato correttamente';

        if (isset($data['add_new'])) {
            $m = 'Lo slot "' . $data['name'] . '" è stato registrato correttamente. Puoi aggiungerne un altro';
            return to_route('admin.slots.create')->with('create_success', $m);      
        }
        
        $m = 'Lo slot "' . $data['name'] . '" è stato registrato correttamente';
        return to_route('admin.slots.index')->with('message', $m);   
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $slot = Slot::findOrFail($id);
        $slots = Slot::with('reservations')->where('id', '!=', $id)->orderBy('created_at', 'desc')->get();
        return view('admin.Slots.edit', compact('slot', 'slots'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all(); 
        $request->validate($this->validations);

        $slot = Slot::findOrFail($id);


        $slot->name = $data['name'];
        $slot->loa = $data['loa'];
        $slot->draft = $data['draft'] ?? 0;
        $slot->beam = $data['beam'];
        $slot->type = $data['type'];
        $slot->price = $data['price'];


        $slot->pos_x = $data['pos_x'] ? $data['pos_x'] : $slot->pos_x ;
        $slot->pos_y = $data['pos_y'] ? $data['pos_y'] : $slot->pos_y ;
        $slot->rotation = $data['rotation'] ?? 0;

        
        $slot->update();


        
        $m = 'Lo slot "' . $data['name'] . '" è stato modificato correttamente';
        return to_route('admin.slots.index')->with('message', $m);   
    }


    public function destroy($id)
    {
        //
    }
}
