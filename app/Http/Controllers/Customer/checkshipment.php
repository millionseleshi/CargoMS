<?php

namespace App\Http\Controllers\Customer;

use App\Cargo;
use App\Shipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class checkshipment extends Controller
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
        return view('customer.checkshipment');
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

    public function searchShipment(Request $request)
    {
        $shipments=Shipment::where('AWB',$request['AWB'])->get();

        foreach ( $shipments as $shipment)
        {
            $cargoDeparture=Cargo::where('flightNumber',$shipment->flightNo)->pluck('departureDate');
            $cargoArrival=Cargo::where('flightNumber',$shipment->flightNo)->pluck('arrivalDate');

            $response=array(
                'AWB'=>$shipment->AWB,
                'shipperName'=>$shipment->shipperName,
                'consigneeName'=>$shipment->consigneeName,
                'shipmentType'=>$shipment->shipmentType,
                'totalWeight'=>$shipment->totalWeight,
                'status'=>$shipment->status,
                'departureDate'=>$cargoDeparture,
                'arrivalDate'=>$cargoArrival,

            );
        }

        if(sizeof($shipments)>0)
        {
            return response()->json($response);
        }
        else{
            return ;
        }


    }
}
