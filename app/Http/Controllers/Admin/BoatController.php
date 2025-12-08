<?php

namespace App\Http\Controllers\Admin;

use App\Models\Boat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoatController extends Controller
{
  
    private $validations = [

        'name'       => 'required|string',
        'loa'       => 'required',
        'draft'       => 'required',
        'beam'       => 'required',
        'model'       => 'required',
        'type'       => 'required',
        'serial_code'       => 'required',
    ];


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all(); 
        $request->validate($this->validations);

        
        $boat = new Boat();

        $boat->name = $data['name'];
        $boat->loa = $data['loa'];
        $boat->draft = $data['draft'];
        $boat->beam = $data['beam'];
        $boat->model = $data['model'];
        $boat->type = $data['type'];
        $boat->serial_code = $data['serial_code'];

        $boat->client_id = $data['client_id']; // 👈 ASSOCIAZIONE

        
        $boat->save();
        

        
        $m = 'L\'imbarcazione "' . $data['name'] . '" è stata registrata correttamente';

        return back()->with('message', $m);   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
