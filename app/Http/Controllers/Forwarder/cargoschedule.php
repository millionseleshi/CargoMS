<?php

namespace App\Http\Controllers\Forwarder;

use App\Cargo;
use App\Countries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class cargoschedule extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries=Countries::all();
        return view('forwarder.cargoschedule',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $validator=\Validator::make($request->all(),
            [
                   'pickup'=>['required','different:destination'],
                   'destination'=>['required','different:pickup']
            ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else
            {
                $date=explode(" - ",$request['duration']);
        $cargo=new Cargo();
        $cargo->carrier=$request['carrier'];
        $cargo->flightNumber=$request['flightNo'];
        $cargo->maxWidth=$request['cargoWidth'];
        $cargo->maxLength=$request['cargoLength'];
        $cargo->maxHeight=$request['cargoHeight'];
        $cargo->maxWeight=$request['maxWeight'];
        $cargo->from=$request['pickup'];
        $cargo->to=$request['destination'];
        $cargo->departureDate=$date[0];
        $cargo->arrivalDate=$date[1];

        $cargo->save();

        return redirect()->back()->with('status','Flight Scheduled');
            }
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
