<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlotController extends Controller
{
    private $validations = [
        'name'      => 'required|string',
        'loa'       => 'required',
        'draft'     => 'required',
        'beam'      => 'required',
        'price'     => 'required',
    ];
    public function index()
    {
        $slots = Slot::with('reservations')->orderBy('created_at', 'desc')->get();

        return view('admin.Slots.index', compact('slots'));
    }
    
    /**
     * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.Slots.create');
    }


    public function store(Request $request)
    {
        $data = $request->all(); 
        $request->validate($this->validations);

        
        $slot = new Slot();

        $slot->name = $data['name'];
        $slot->loa = $data['loa'];
        $slot->draft = $data['draft'];
        $slot->beam = $data['beam'];
        $slot->type = $data['type'];
        $slot->price = $data['price'];

        
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
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
