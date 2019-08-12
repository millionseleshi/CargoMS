<?php

namespace App\Http\Controllers\Customer\API;

use App\Cargo;
use App\Claims;
use App\Countries;
use App\Deliverer;
use App\deliveries;
use App\Shipment;
use App\ShipmentDetail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;



class CustomerAPI extends Controller
{
    public function register(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'fname' => ['required', 'string', 'max:20','min:2'],
            'mname' => ['required', 'string', 'max:20','min:2'],
            'lname' => ['required', 'string', 'max:20','min:2'],
            'phone'=>['required','digits:10'],
            'altphone'=>['nullable'],

            'city'=>['required','string','min:2'],
            'streetName'=>['required','string','min:2'],
            'houseno'=>['numeric'],

            'username'=>['required','string','max:15','min:2','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }
        else
        {

            $user = User::create(
                [
                    'firstName' => $request['fname'],
                    'middleName' => $request['mname'],
                    'lastName' => $request['lname'],
                    'phoneNumber' => $request['phone'],
                    'AlternatePhoneNumber' => $request['altphone'],
                    'address' => $request['city']."-".$request['streetName']."-".$request['houseno'],
                    'userName' => $request['username'],
                    'email' => $request['email'],
                    'password' => bcrypt($request['password'])
                ]);

            $success['token'] =  $user->createToken('Customer Token')-> accessToken;
            $success['tokenType'] = "Bearer ";
            $success['message'] =  "Successfully Created Account";

            return response()->json(['success'=>$success], 200);
        }
    }

    public function login(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'remember_me' => 'boolean'
            ]);

        if ($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        else
        {
            $credentials = request(['username', 'password']);

            if(Auth::attempt($credentials))
            {
                $user = Auth::user();
                $tokenResult = $user->createToken('Customer Token');
                $token = $tokenResult->token;

                if ($request->remember_me) {

                    $token->expires_at = Carbon::now()->addYears(1);
                    $token->save();
                }

//                    $success['user']=Auth::user();
                $success['message']='Successfully Logged in as '.$request->input('username');
                $success['tokenType']='Bearer ';
                $success['token']=$tokenResult->accessToken;
                $success['expiresAt']= Carbon::parse($tokenResult->token->expires_at)->toDateTimeString();

                return response()->json(["success"=>$success],200);
            }

            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully Logged Out'
        ]);

    }

    public function user(Request $request)
    {
        return response()->json($request->user(),200);
    }

    public function edituser(Request $request)
    {
        $userID=Auth::user()->id;
        $validator=Validator::make($request->all(),[
            'fname' => ['required', 'string', 'max:20','min:2'],
            'mname' => ['required', 'string', 'max:20','min:2'],
            'lname' => ['required', 'string', 'max:20','min:2'],
            'phone'=>['required','digits:10'],
            'altphone'=>['nullable'],
            'email'=>['required','string','email',Rule::unique('users')->ignore($userID)],

            'city'=>['required','string','min:2'],
            'streetName'=>['required','string','min:2'],
            'houseno'=>['numeric'],
            'userImage'=>['image'],
        ]);

        if($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()]);
        }
        else
        {

            $user=User::find($userID);
            $user->firstName=$request['fname'];
            $user->middleName=$request['mname'];
            $user->lastName=$request['lname'];
            $user->phoneNumber=$request['phone'];
            $user->AlternatePhoneNumber=$request['altphone'];
            $user->email=$request['email'];
            $user->address=$request['city'].'-'.$request['streetName'].'-'.$request['houseno'];
            if($file=$request->file('userImage'))
            {
                $fileName=$file->getATime().$file->getClientOriginalName();

                $file->move('UserImage',$fileName);

                $user->userImage=$fileName;
            }

            $user->save();

            return response()->json(['message' =>'Edit Profile Successful'],200);

        }
    }

    public function getCountries()
    {
        $countries=Countries::all();
        if(sizeof($countries)>0)
        {
            return response()->json(['countries'=>$countries],200);
        }
        else {return \response()->json(['message'=>'Not Found'],404);}

    }

    public function getFlightNo()
    {
        $flightNo = Cargo::where('available', '1')->pluck('flightNumber');
        return \response()->json($flightNo);
    }

    public function getDeliverers()
    {
        $deliverers = Deliverer::all();

        if(sizeof($deliverers)>0)
        {
            return response()->json(['deliverers'=>$deliverers],200);
        }
        else {return \response()->json(['message'=>'Not Found'],200);}

    }

    /*   public function getNatureOfShipment()
       {
           $natureOfShipment = array(
               ['perishable' => 'Perisable',
               'general Cargo' => 'General Cargo',
               'valuable item' => 'Valueable Item',
               'live animal' => 'Live Animal',
               'radioactive' => 'Radioactive Material',
               'vehicles' => 'Vehicles',
               'dangerous goods' => 'Dangerous Goods']);

           return \response()->json($natureOfShipment,200);
       }*/

    /* public function store(Request $request)
     {

         $messages = [
             'userName.required_if' => 'Username is required for register user',
             'userName.different'=>'Invalid Consignee Username',
             'userName.exists'=>'No Consignee with this Username ',
             'consigneeFname.required_if' => 'The Firs Name is required.',
             'consigneeMname.required_if' => 'The Father \'s Name is required.',
             'consigneeLname.required_if' => 'The GrandFather\'s  Name is required.',
             'consigneeEmail.required_if' => 'The Email is required.',
             'city.required_if' => 'The City is required.',
             'streetName.required_if' => 'The StreetName is required.',
             'houseno.required_if' => 'The HouseNo is required.',
             'destination.different'=>'The Destinaion must be different from the Pickup',
         ];

         if(Auth::user())
         {
             $validator=Validator::make($request->all(),[

                 'userName' => [ 'sometimes','different:authUsername',Rule::exists('users','userName')->where('role','customer')],

                 'consigneeFname' => ['sometimes','alpha','min:2','max:20'],
                 'consigneeMname' => ['sometimes','alpha','min:2','max:20]'],
                 'consigneeLname' => ['sometimes','alpha','min:2','max:20'],
                 'consigneePhone' => ['sometimes','digits:10'],
                 'consigneeEmail' => ['sometimes','email'],


                 'city' => ['sometimes','alpha'],
                 'streetName' =>['sometimes','alpha_num'],
                 'houseno' => ['sometimes','numeric'],
                 'deliverer'=>['required_if:deliveryneed,needed','exists:deliverers,id'],

                 'natureOfShipment' => 'required',
                 'weightOfShipment' => ['required','numeric'],
                 'flightNo'=>'required',Rule::exists('cargos','flightNumber')->where('available','1')],$messages );
         }
         if(Auth::guest())
         {

             $validator=Validator::make($request->all(),
                 [

                 'userName' => [ 'sometimes',Rule::exists('users','userName')->where('role','customer')],

                 'consigneeFname' => ['sometimes','alpha','min:2','max:20'],
                 'consigneeMname' => ['sometimes','alpha','min:2','max:20]'],
                 'consigneeLname' => ['sometimes','alpha','min:2','max:20'],
                 'consigneePhone' => ['sometimes','digits:10'],
                 'consigneeEmail' => ['sometimes','email'],

                 'city' => ['sometimes','alpha'],
                 'streetName' =>['sometimes','alpha_num'],
                 'houseno' => ['sometimes','numeric'],
                 'deliverer'=>['required_if:deliveryneed,needed','exists:deliverers,id'],

                 'natureOfShipment' => 'required',
                 'weightOfShipment' => ['required','numeric'],
                 'flightNo'=>'required',
                 ]);
         }


            if($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()],200);
            }

            else
                {
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

                    $lastId = $shipment->save();

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

                    return response()->json(['message'=>'Booking Successful'],200);
                }

     }*/

    public function store(Request $request)
    {
        $messages = [
            'userName.required_if' => 'Username is required for register user',
            'userName.different'=>'Invalid Consignee Username',
            'userName.exists'=>'No Consignee with this Username ',
            'consigneeFname.required_if' => 'The Firs Name is required.',
            'consigneeMname.required_if' => 'The Father \'s Name is required.',
            'consigneeLname.required_if' => 'The GrandFather\'s  Name is required.',
            'consigneeEmail.required_if' => 'The Email is required.',
            'city.required_if' => 'The City is required.',
            'streetName.required_if' => 'The StreetName is required.',
            'houseno.required_if' => 'The HouseNo is required.',
            'destination.different'=>'The Destinaion must be different from the Pickup',
        ];



        $validator=Validator::make($request->all(),
            [

//                    'userName' => [ 'sometimes',Rule::exists('users','userName')->where('role','customer')],

                'consigneeFname' => ['sometimes','alpha','min:2','max:20'],
                'consigneeMname' => ['sometimes','alpha','min:2','max:20]'],
                'consigneeLname' => ['sometimes','alpha','min:2','max:20'],
                'consigneePhone' => ['sometimes','digits:10'],
                'consigneeEmail' => ['sometimes','email'],

                'city' => ['sometimes','alpha'],
                'streetName' =>['sometimes','alpha_num'],
                'houseno' => ['sometimes','numeric'],
                'deliverer'=>['required_if:deliveryneed,needed','exists:deliverers,id'],

                'natureOfShipment' => 'required',
                'weightOfShipment' => ['required','numeric'],
                'flightNo'=>'required',
            ],$messages);


        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }
        else
        {
            $shipment = new Shipment();


            $userID=$request['id'];

            $user=User::find($userID);

            $shipment->shipperName = $user['firstName'] . " " . $user['middleName'] . " " . $user['lastName'];
            $shipment->shipperAddress = $user['address'];
            $shipment->shipperPhoneNumber = $user['phoneNumber'] . "/" . $user['AlternatePhoneNumber'];
            $shipment->shipperEmail = $user['email'];

            $shipment->consigneeName = $request['consigneeFname'] . " " . $request['consigneeMname'] . " " . $request['consigneeLname'];
            $shipment->consigneeAddress = $request['city'] . "-" . $request['streetName'] . "-" . $request['houseno'];
            $shipment->consigneePhoneNumber = $request['consigneePhone'];
            $shipment->consigneeEmail = $request['consigneeEmail'];
            $shipment->flightNo = $request['flightNo'];

//            if ($request['deliveryneed'] == 'needed') {
//                $deliveryDeatil = new deliveries();
//
//                $deliveryDeatil->deliverers_id = $request['deliverer'];
//
//                $deliveryDeatil->user_name=$user['firstName'] . " " . $user['middleName'] . " " . $user['lastName'];
//                $deliveryDeatil->user_email= $user['email'];
//                $deliveryDeatil->user_phone =$user['phoneNumber'];
//                $deliveryDeatil->from= $user['address'];
//                $deliveryDeatil->to="Ethiopian Airline";
//
//
//                $deliveryDeatil->action = "pickUp";
//                $deliveryDeatil->totalWeight = $request['weightOfShipment'];
//
//                $deliveryPrice = Deliverer::where('id', $request['deliverer'])->pluck('deliveryPrice');
//
//                $deliveryDeatil->totalPayment = $request['weightOfShipment'] * $deliveryPrice[0];
//
//                $deliveryDeatil->save();
//            }


            $shipment->shipmentType = $request['natureOfShipment'];
            $shipment->totalWeight = $request['weightOfShipment'];
            $shipment->AWB = "071-" . mt_rand(10000000, 99999999);
            $shipment->status = "pickup";

            $shipment->save();

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

            return response()->json(['message'=>'Booking Successful']);

        }
    }

    public function weightChecker(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'flightNo'=>['required',Rule::exists('cargos','flightNumber')->where('available','1')]
            ]);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()],200);
        }
        else
        {
            $maxWeight = Cargo::where('flightNumber', $request['flightNo'])->get(['maxWeight']);
            foreach ($maxWeight as $value) {
                return response()->json(['maxWeight'=>$value->maxWeight],200);
            }
        }
    }

    public function receivedData(Request $request)
    {
        $userID=$request['id'];

        $user=User::find($userID);

        $consigneeName = \Auth::user()->firstName . " " . \Auth::user()->middleName . " " . \Auth::user()->lastName;


        if(Auth::guest())
        {
            return \response()->json(['message'=>'authorized'],200);
        }
        else
        {

            $shipment=[];

            $receivedShipments = Shipment::where('consigneeName', $consigneeName)->get();
            foreach ($receivedShipments as $receivedShipment)
            {
                $flightNo= $receivedShipment->flightNo;
                $shipmentId=$receivedShipment->id;
                $arrivalDate=Cargo::where('flightNumber',$flightNo)->value("arrivalDate");
                $shipmentDetailsType=ShipmentDetail::where('shipment_id',$shipmentId)->pluck('type');
                $shipmentDetailsBrand=ShipmentDetail::where('shipment_id',$shipmentId)->pluck('brand');
                $shipmentDetailsColor=ShipmentDetail::where('shipment_id',$shipmentId)->pluck('color');
                $shipmentDetailsAmount=ShipmentDetail::where('shipment_id',$shipmentId)->pluck('amount');
                $response=array(
                    "shipperName"=>$receivedShipment->shipperName ,
                    "shipperAddress"=> $receivedShipment->shipperAddress,
                    "shipperPhoneNumber"=> $receivedShipment->shipperPhoneNumber,
                    "shipperEmail"=> $receivedShipment->shipperEmail,
                    "consigneeName"=> $receivedShipment->consigneeName,
                    "consigneeAddress"=> $receivedShipment->consigneeAddress,
                    "consigneePhoneNumber"=> $receivedShipment->consigneePhoneNumber,
                    "consigneeEmail"=> $receivedShipment->consigneeEmail,
                    "flightNo"=> $receivedShipment->flightNo,
                    "shipmentType"=> $receivedShipment->shipmentType,
                    "totalWeight"=> $receivedShipment->totalWeight,
                    "AWB"=> $receivedShipment->AWB,
                    "validity"=> $receivedShipment->validity,
                    "status"=> $receivedShipment->status,
                    'arrivalDate'=>$arrivalDate,
                    'itemType'=>$shipmentDetailsType,
                    'itemBrand'=>$shipmentDetailsBrand,
                    'itemColor'=>$shipmentDetailsColor,
                    'itemAmount'=>$shipmentDetailsAmount,

                );
                $shipment[]=$response;
            }
            return response()->json($shipment,200);

        }



    }

    public function searchShipment(Request $request)
    {
        $messages=['AWB.exists'=>'Shipment Not found with this AWB'];
        $validator=Validator::make($request->all(),[
            'AWB'=>['required','exists:shipments,AWB']
        ],$messages);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()],404);
        }
        else
        {
            $shipments=Shipment::where('AWB',$request['AWB'])->get();
            foreach ( $shipments as $shipment)
            {
                $cargoDeparture=Cargo::where('flightNumber',$shipment->flightNo)->value('departureDate');
                $cargoArrival=Cargo::where('flightNumber',$shipment->flightNo)->value('arrivalDate');

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

            return response()->json(['shipment'=>$response],200);

        }



    }

    public function cargoData()
    {
        $cargo=Cargo::where('available',1)->get();

        return response()->json(['cargo'=>$cargo],200);
    }

    /*
     * Enum  $irregularity=['loss'=>'Loss','damage'=>'Damage','pilferage'=>'Pilferage','dead'=>'Dead','sickOrInjured'=>'Sick Or Injured','other'=>'Other'];
     * */

    public function sendclaim(Request $request)
    {
        $validator=\Validator::make($request->all(),
            [
                'awb'=>'required|string|exists:shipments,AWB',
                'literaryAirline'=>'required|string|min:2|max:20',
                'flightNo'=>'required|exists:shipments,flightNo',
                'contentDescription'=>'required|string|max:114',
                'irregularity'=>'required',
                'remark'=>'required_if:irregularity,other|string',
                'estimatedPV'=>'required|numeric'
            ]);
        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }
        else
        {
            $claims=new Claims();
            $userID=$request['id'];

            $user=User::find($userID);
            $claims->claimersName=$user['firstName']." ".$user['middleName']." ".$user['lastName'];
            $claims->claimersAddress=$user['address'];
            $claims->claimersPhone=$user['phoneNumber'];
            $claims->claimersEmail=$user['email'];

            /* if(\Auth::user())
             {

                 $claims->claimersName=Auth::user()->firstName." ".Auth::user()->middleName." ".Auth::user()->lastName;
                 $claims->claimersAddress=Auth::user()->address;
                 $claims->claimersPhone=Auth::user()->phoneNumber;
                 $claims->claimersEmail=Auth::user()->email;
             }
             else
             {
                 $claims->claimersName=$request['claimersFname']." ".$request['claimersMname']." ".$request['claimersLname'];
                 $claims->claimersAddress=$request['city']." ".$request['streetName']." ".$request['houseno'];
                 $claims->claimersPhone=$request['claimersPhone'];
                 $claims->claimersEmail=$request['claimersEmail'];
             }*/

            $claims->AWB=$request['awb'];
            $claims->flightNo=$request['flightNo'];
            $claims->literaryAirline=$request['literaryAirline'];
            $claims->irregularity=$request['irregularity'];
            $claims->remark=$request['remark'];
            $claims->contentDescription=$request['contentDescription'];
            $claims->estimatedValue=$request['estimatedPV'];
            $claims->save();
            return response()->json(['message'=>'Claim sent successful'],200);
        }
    }

    public function cargoFlight(Request $request)
    {
        $flightNo=$request['flightNumber'];

        $cargo= Cargo::where('flightNumber',$flightNo)->get();

        if(sizeof($cargo)>0)
        {
            return response()->json(['cargo'=>$cargo],200);
        }
        else
        {
            return response()->json(['error'=>'No cargo with this Flight Number'],404);
        }
    }

    public function payment(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'totalPrice'=>'required|numeric',
                'delivererID'=>'required|exists:deliverers,id',
                'shipmentId'=>'required|exists:shipments,id'
            ]);
        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }
        else
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
            return response()->json(['message'=>'Payment Successful'],200);
        }

    }


    public function loadable(Request $request)
    {
        $carrier=$request['carrier'];
        $shipmentLength=$request['length'];
        $shipmentWidth=$request['width'];
        $shipmentHeight=$request['height'];
        $measurement=$request['measurement'];

        $validator=Validator::make($request->all(),[
            'carrier'=>['required','string','exists:cargos,carrier'],
            'length'=>['required','numeric'],
            'width'=>['required','numeric'],
            'height'=>['required','numeric'],
            'measurement'=>['required',Rule::in(['in','cm'])]
        ]);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }
        else
        {
            $maxLength=Cargo::where('carrier',$carrier)->value('maxLength');
            $maxWidth=Cargo::where('carrier',$carrier)->value('maxWidth');
            $maxHeight=Cargo::where('carrier',$carrier)->value('maxHeight');

            if($measurement=='in')
            {
                $maxHeight*=0.393701;
                $maxWidth*=0.393701;
                $maxLength*=0.393701;
            }

            if($shipmentLength>$maxLength)
            {
                return \response()->json(['message'=>'Length exceeds the maximum'.' '.$maxLength]);
            }
            if($shipmentHeight>$maxHeight)
            {
                return \response()->json(['message'=>'Height exceeds the maximum'.' '.$maxHeight]);
            }
            if($shipmentWidth>$maxWidth)
            {
                return \response()->json(['message'=>'Width exceeds the maximum'.' '.$maxWidth]);
            }
            else
            {
                return \response()->json(['message'=>'Cargo is loadable']);
            }
        }



    }

    public function terminalCharge(Request $request)
    {

        $validator=Validator::make($request->all(),
            [
                'shipmentTYpe'=>['required',Rule::in(['perishable','general Cargo','valuable item','live animal','radioactive','vehicles','dangerous goods'])],
                'totalWeight'=>'required|numeric',
                'arrivalDate'=>'required|date_format:Y-m-d',
                'pickupDate'=>'required|date_format:Y-m-d',
                'deliveryNeeded'=>'boolean',
                'delivererID'=>'required_if:deliveryNeeded,true|exists:deliverers,id'
            ]);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()]);
        }

        else
        {
            $shipmentType=$request['shipmentTYpe'];
            $weight=$request['totalWeight'];
            $arrivalDate=$request['arrivalDate'];
            $deliveryDate=$request['pickupDate'];
            if($request['deliveryNeeded']==true)
            {
                $deliveryPrice=Deliverer::where('id',$request['delivererID'])->value('deliveryPrice');
            }
            else
            {
                $deliveryPrice=0;
            }
            if($shipmentType=='perishable')
            {
                $chargeFactor=0.9;
                $terminalCharge=713.04;

                $totalCost=$this->calculator($weight,$chargeFactor,$terminalCharge,$arrivalDate,$deliveryDate,$deliveryPrice);
                return response()->json(['totalCost'=>$totalCost]);
            }
            if($shipmentType=='general Cargo')
            {
                $chargeFactor=0.05;
                $terminalCharge=260.87;

                $totalCost=$this->calculator($weight,$chargeFactor,$terminalCharge,$arrivalDate,$deliveryDate,$deliveryPrice);
                return response()->json(['totalCost'=>$totalCost]);
            }
            if($shipmentType=='valuable item')
            {
                $chargeFactor=1.75;
                $terminalCharge=713.04;

                $totalCost=$this->calculator($weight,$chargeFactor,$terminalCharge,$arrivalDate,$deliveryDate,$deliveryPrice);
                return response()->json(['totalCost'=>$totalCost]);
            }
            if($shipmentType=='live animal')
            {
                $chargeFactor=0.9;
                $terminalCharge=260.87;

                $totalCost=$this->calculator($weight,$chargeFactor,$terminalCharge,$arrivalDate,$deliveryDate,$deliveryPrice);
                return response()->json(['totalCost'=>$totalCost]);
            }
            if($shipmentType=='radioactive')
            {
                $chargeFactor=5;
                $terminalCharge=713.04;

                $totalCost=$this->calculator($weight,$chargeFactor,$terminalCharge,$arrivalDate,$deliveryDate,$deliveryPrice);
                return response()->json(['totalCost'=>$totalCost]);
            }
            if($shipmentType=='vehicles')
            {
                $chargeFactor=0.03;
                $terminalCharge=713.04;

                $totalCost=$this->calculator($weight,$chargeFactor,$terminalCharge,$arrivalDate,$deliveryDate,$deliveryPrice);

                return response()->json(['totalCost'=>$totalCost]);
            }
            if($shipmentType=='dangerous goods')
            {
                $chargeFactor=0.05;
                $terminalCharge=713.04;

                $totalCost=calculator($weight,$chargeFactor,$terminalCharge,$arrivalDate,$deliveryDate,$deliveryPrice);
                return response()->json(['totalCost'=>$totalCost]);
            }
        }



    }

    public function calculator($weight,$chargeFactor,$terminalCharge,$arrivalDate,$deliveryDate,$deliveryPrice)
    {
        $wareHouseCharge=$totalcharge=$duration=$totalchargeVAT=$totalcost=0;
        $VAT=0.15;

        $duration=$this->dataDifference($arrivalDate,$deliveryDate);
        $wareHouseCharge=$weight*$chargeFactor*$duration;
        $totalcharge=$wareHouseCharge+$terminalCharge;
        $totalchargeVAT=(($totalcharge*$VAT)+$totalcharge);

        $deliveryCost=$weight*$deliveryPrice;

        $totalcost=$totalchargeVAT+$deliveryCost;

        return $totalcost;

    }

    public function dataDifference($arrivalDate,$deliveryDate)
    {
        $dateOne=new \DateTime($arrivalDate);
        $dateTwo=new \DateTime($deliveryDate);
        $dateInterval=$dateTwo->diff($dateOne);

        return $dateInterval->days+1;

    }

    public function carrier()
    {
        $carrier =Cargo::all()->pluck('carrier');

        return \response()->json(['carrier'=>$carrier]);
    }



}
