<?php

namespace App\Http\Controllers\Customer;

use App\Cargo;
use App\Deliverer;
use App\deliveries;
use App\Shipment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class payment extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $totalPrice=$request->input('totalPrice');
        $delivererID=$request->input('delivererID');
        $shipmentID=$request->input('shipmentId');

        $shipment=Shipment::find($shipmentID);
        $deliveryPrice=Deliverer::where('id',$delivererID)->value('deliveryPrice');

        $deliveries=new deliveries();
        $deliveries->deliverers_id=$delivererID;
        $deliveries->users_id=Auth::user()->id;
        $deliveries->user_name=Auth::user()->userName;
        $deliveries->user_email=Auth::user()->email;
        $deliveries->user_phone=Auth::user()->phoneNumber;
        $deliveries->from='Ethiopian Airline';
        $deliveries->to=Auth::user()->address;
        $deliveries->action="dropOf";
        $weight=$shipment->totalWeight;
        $deliveries->totalWeight=$weight;
        $deliveries->totalPayment=$weight*$deliveryPrice;
        $deliveries->save();

        $payment=new \App\Payment();
        if(Auth::user())
        {
            $payment->Name=Auth::user()->firstName;
            $payment->FatherName=Auth::user()->middleName;
            $payment->GrandFatherName=Auth::user()->lastName;
        }
        else
            {
                $payment->Name=$request['firstName'];
                $payment->FatherName=$request['middleName'];
                $payment->GrandFatherName=$request['lastName'];
            }

        $payment->paymentType='bank';
        $payment->amountExpected=$totalPrice;
        $payment->amountPaid=0;
        $payment->AWB=$shipment->AWB;
        $payment->status='unverified';
        $payment->save();

        $shipment->status="processing";
        $shipment->save();

        return redirect()->route('receiveshipment')->with('status','Pending...Pay using the account');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shipment= Shipment::findorfail($id);
        return view('customer.payment',compact('shipment'));
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
        $shipments = Shipment::where('id', $request['shipmentId'])->get();

        foreach ($shipments as $shipment) {
            $cargoDeparture = Cargo::where('flightNumber', $shipment->flightNo)->value('departureDate');
            $cargoArrival = Cargo::where('flightNumber', $shipment->flightNo)->value('arrivalDate');

            $response = array(
                'AWB' => $shipment->AWB,
                'shipperName' => $shipment->shipperName,
                'consigneeName' => $shipment->consigneeName,
                'shipmentType' => $shipment->shipmentType,
                'totalWeight' => $shipment->totalWeight,
                'status' => $shipment->status,
                'departureDate' => $cargoDeparture,
                'arrivalDate' => $cargoArrival,

            );
        }

        if (sizeof($shipments) > 0) {
            return response()->json($response);
        } else {
            return;
        }


    }
}
