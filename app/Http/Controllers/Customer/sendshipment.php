<?php

namespace App\Http\Controllers\Customer;

use App;
use App\{
    Cargo,
    Countries,
    Deliverer,
    deliveries,
    Http\Requests\BookShipment,
    Shipment,
    ShipmentDetail,
    User,
    Http\Controllers\Controller
};

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;


class sendshipment extends Controller
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
        $countries = Countries::all();
        $flightNo = Cargo::where('available', '1')->get();
        $deliverers = Deliverer::all();
        $natureOfShipment = array(
            'perishable' => 'Perisable',
            'general Cargo' => 'General Cargo',
            'valuable item' => 'Valueable Item',
            'live animal' => 'Live Animal',
            'radioactive' => 'Radioactive Material',
            'vehicles' => 'Vehicles',
            'dangerous goods' => 'Dangerous Goods');

        return view('customer.sendShipment', compact('countries', 'natureOfShipment', 'flightNo', 'deliverers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookShipment $request)
    {

        $validator = $request->validated();

        $shipment = new Shipment();

        $userName = $request['userName'];

        $client = User::all()->where('userName', $userName)->first();


        if (Auth::guest()) {
            $shipment->shipperName = $request['shipperFname'] . " " . $request['shipperMname'] . " " . $request['shipperLname'];
            $shipment->shipperAddress = $request['shipperCity'] . "-" . $request['ShipperStreetName'] . "-" . $request['shipperHouseno'];
            $shipment->shipperPhoneNumber = $request['shipperPhone'];
            $shipment->shipperEmail = $request['shipperEmail'];
        }

        else
            {
                $shipment->shipperName = Auth::user()->firstName . " " . Auth::user()->middleName . " " . Auth::user()->lastName;
                $shipment->shipperAddress = Auth::user()->address;
                $shipment->shipperPhoneNumber = Auth::user()->phoneNumber . "/" . Auth::user()->AlternatePhoneNumber;
                $shipment->shipperEmail = Auth::user()->email;
            }

        $shipment->consigneeName = $client->firstName . " " . $client->middleName . " " . $client->lastName;
        $shipment->consigneeAddress = $client->address;
        $shipment->consigneePhoneNumber = $client->phoneNumber . "/" . $client->AlternatePhoneNumber;
        $shipment->consigneeEmail = $client->email;
        $shipment->flightNo = $request['flightNo'];

        if ($request['deliveryneed'] == 'needed') {
            $deliveryDeatil = new deliveries();

            $deliveryDeatil->deliverers_id = $request['deliverer'];

            if (Auth::guest()) {
                $deliveryDeatil->user_name=$request['shipperFname'] . " " . $request['shipperMname'] . " " . $request['shipperLname'];
                $deliveryDeatil->user_email= $request['shipperEmail'];
                $deliveryDeatil->user_phone =$request['shipperPhone'];
                $deliveryDeatil->from= $request['shipperCity'] . "-" . $request['ShipperStreetName'] . "-" . $request['shipperHouseno'];
                $deliveryDeatil->to="Ethiopian Airline";
            }
            else
            {
                $deliveryDeatil->users_id = Auth::user()->id;
                $deliveryDeatil->user_name= Auth::user()->firstName . " " . Auth::user()->middleName . " " . Auth::user()->lastName;
                $deliveryDeatil->user_phone = Auth::user()->phoneNumber . "/" . Auth::user()->AlternatePhoneNumber;
                $deliveryDeatil->user_email = Auth::user()->email;
                $deliveryDeatil->from=Auth::user()->address;
                $deliveryDeatil->to="Ethiopian Airline";
            }

            $deliveryDeatil->action = "pickUp";
            $deliveryDeatil->totalWeight = $request['weightOfShipment'];

            $deliveryPrice = Deliverer::where('id', $request['deliverer'])->pluck('deliveryPrice');

            $deliveryDeatil->totalPayment = $request['weightOfShipment'] * $deliveryPrice[0];

            $deliveryDeatil->save();
        }

        $shipment->shipmentType = $request['natureOfShipment'];
        $shipment->totalWeight = $request['weightOfShipment'];
        $shipment->AWB = "071-" . mt_rand(10000000, 99999999);
        $shipment->status = "pickup";

        $shipment->save();


        $this->savePDF($shipment);


        if (count($request->itemType) > 0) {
            foreach ($request->itemType as $item => $value) {
                $itemDetail = array(
                    'type' => $request->itemType[$item],
                    'brand' => $request->itemBrand[$item],
                    'color' => $request->itemColor[$item],
                    'amount' => $request->itemAmount[$item],
                    'shipment_id' => $shipment->id
                );

                ShipmentDetail::create($itemDetail);
            }
        }

     /*   $toName = $client->firstName." ".$client->middleName;
        $toEmail = $client->email;
        $fileAttach=base_path('pdf/').$shipment->AWB.'shipment.pdf';
        $data = array('name'=>"EACSS", 'body' => 'Thank You For using EACSS...This is Your Shipment Detail');
        Mail::send('email', $data, function($message) use ($toName, $toEmail,$fileAttach)
        {

                $message->to($toEmail, $toName)->subject('Your Package is here')->attach($fileAttach);

        });*/



        return redirect()->back()->with('status', 'Booking Successful');

    }

    /**
     * @param BookShipment $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeunregistered(BookShipment $request)
    {
        $request->validated();

        $shipment = new Shipment();

        if (Auth::guest()) {
            $shipment->shipperName = $request['shipperFname'] . " " . $request['shipperMname'] . " " . $request['shipperLname'];
            $shipment->shipperAddress = $request['shipperCity'] . "-" . $request['ShipperStreetName'] . "-" . $request['shipperHouseno'];
            $shipment->shipperPhoneNumber = $request['shipperPhone'];
            $shipment->shipperEmail = $request['shipperEmail'];
        }
        else
            {
                $shipment->shipperName = Auth::user()->firstName . " " . Auth::user()->middleName . " " . Auth::user()->lastName;
                $shipment->shipperAddress = Auth::user()->address;
                $shipment->shipperPhoneNumber = Auth::user()->phoneNumber . "/" . Auth::user()->AlternatePhoneNumber;
                $shipment->shipperEmail = Auth::user()->email;
            }

        $shipment->consigneeName = $request['consigneeFname'] . " " . $request['consigneeMname'] . " " . $request['consigneeLname'];
        $shipment->consigneeAddress = $request['city'] . "-" . $request['streetName'] . "-" . $request['houseno'];
        $shipment->consigneePhoneNumber = $request['consigneePhone'];
        $shipment->consigneeEmail = $request['consigneeEmail'];
        $shipment->flightNo = $request['flightNo'];

        if ($request['deliveryneed'] == 'needed') {
            $deliveryDeatil = new deliveries();

            $deliveryDeatil->deliverers_id = $request['deliverer'];

            if (Auth::guest()) {
                $deliveryDeatil->user_name=$request['shipperFname'] . " " . $request['shipperMname'] . " " . $request['shipperLname'];
                $deliveryDeatil->user_email= $request['shipperEmail'];
                $deliveryDeatil->user_phone =$request['shipperPhone'];
                $deliveryDeatil->from= $request['shipperCity'] . "-" . $request['ShipperStreetName'] . "-" . $request['shipperHouseno'];
                $deliveryDeatil->to="Ethiopian Airline";
            }
            else
            {
                $deliveryDeatil->users_id = Auth::user()->id;
                $deliveryDeatil->user_name= Auth::user()->firstName . " " . Auth::user()->middleName . " " . Auth::user()->lastName;
                $deliveryDeatil->user_phone = Auth::user()->phoneNumber . "/" . Auth::user()->AlternatePhoneNumber;
                $deliveryDeatil->user_email = Auth::user()->email;
                $deliveryDeatil->from=Auth::user()->address;
                $deliveryDeatil->to="Ethiopian Airline";
            }

            $deliveryDeatil->action = "pickUp";
            $deliveryDeatil->totalWeight = $request['weightOfShipment'];

            $deliveryPrice = Deliverer::where('id', $request['deliverer'])->pluck('deliveryPrice');

            $deliveryDeatil->totalPayment = $request['weightOfShipment'] * $deliveryPrice[0];

            $deliveryDeatil->save();
        }


        $shipment->shipmentType = $request['natureOfShipment'];
        $shipment->totalWeight = $request['weightOfShipment'];
        $shipment->AWB = "071-" . mt_rand(10000000, 99999999);
        $shipment->status = "pickup";

        $shipment->save();

        $this->savePDF($shipment);

        if (count($request->itemType) > 0) {
            foreach ($request->itemType as $item => $value) {
                $itemDetail = array(
                    'type' => $request->itemType[$item],
                    'brand' => $request->itemBrand[$item],
                    'color' => $request->itemColor[$item],
                    'amount' => $request->itemAmount[$item],
                    'shipment_id' => $shipment->id
                );

                ShipmentDetail::insert($itemDetail);
            }


        }

        return redirect()->route('sendshipment')->with('status', 'Booking Successful');
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

    /**
     * @param Request $request
     * @return mixed
     */
    public function weightChecker(Request $request)
    {
        $maxWeight = Cargo::where('flightNumber', $request->input('flightNo'))->get(['maxWeight']);
        foreach ($maxWeight as $value) {
            return $value->maxWeight;
        }


    }

    public function savePDF($shipment=array())
    {

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.shipment',$shipment);
        return $pdf->save(public_path('/pdf/').$shipment['AWB'].'shipment.pdf');
    }
}


