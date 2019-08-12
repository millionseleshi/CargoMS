<?php

namespace App\Http\Controllers\Customer;

use App\Cargo;
use App\Deliverer;
use App\Shipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class receiveshipment extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliverers = Deliverer::all();
        return view('customer.receiveshipment',compact('deliverers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $deliverers=Deliverer::all();
        $shipmentID=$request['id'];
        $shipment=Shipment::find($shipmentID);
        $itemDetail= $shipment->shipmentDetail()->where('shipment_id',$shipmentID)->get();

        //Total Payment=Terminal Charge Price+Delivery
        //Terminal Charge=??

        return view('customer.payment',compact('shipment','deliverers','itemDetail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function receivedData()
    {

        $consigneeName = \Auth::user()->firstName . " " . \Auth::user()->middleName . " " . \Auth::user()->lastName;

        $recivedShipments = Shipment::where('consigneeName', $consigneeName);

            return DataTables::of($recivedShipments)
                ->addColumn('arrivalDate', function ($row) {
                    $arrivalDate= Cargo::where('flightNumber',$row->flightNo)->value('arrivalDate');
                    return $arrivalDate;
                })
                ->addColumn('PAY', function ($row) {
                    return "<a class='btn btn-sm btn-info' href=".route('ReceiveShipment',['id'=>$row->id]).">Accept</a>";
                })
                ->rawColumns(['PAY'])
                ->make(true);

    }
}
