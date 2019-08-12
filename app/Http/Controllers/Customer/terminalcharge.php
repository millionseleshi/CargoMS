<?php

namespace App\Http\Controllers\Customer;

use App\Countries;
use App\Forwarder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class terminalcharge extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $terminalCharge=Forwarder::all()->pluck('terminalCharge');
        $natureOfShipment = array(
            'perishable' => 'Perisable',
            'general Cargo' => 'General Cargo',
            'valuable item'=>'Valueable Item',
            'live animal' => 'Live Animal',
            'radioactive' => 'Radioactive Material',
            'vehicles'=>'Vehicles',
            'dangerous goods'=>'Dangerous Goods');
        return view('customer.terminalcharge',compact('natureOfShipment','terminalCharge'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
