<?php

namespace App\Http\Controllers\Customer;


use App\Claims;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class sendclaims extends Controller
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

        //'loss','damage','pilferage'.'dead','sickOrInjured','other'
        $irregularity=['loss'=>'Loss','damage'=>'Damage','pilferage'=>'Pilferage','dead'=>'Dead','sickOrInjured'=>'Sick Or Injured','other'=>'Other'];
        return view('customer.claimsform',compact('irregularity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $claimsValidation=\Validator::make($request->all(),
            [
                'awb'=>'required|string|exists:shipments,AWB',
                'literaryAirline'=>'required|string|min:2|max:20',
                'flightNo'=>'required|string|exists:cargos,flightNumber',
                'contentDescription'=>'required|string|max:114',
                'irregularity'=>'required',
                'remark'=>'required_if:irregularity,other|string',
                'estimatedPV'=>'required|numeric'
            ]);
        if($claimsValidation->fails())
        {
            return redirect()->back()->withErrors($claimsValidation)->withInput();


        }
        else
        {
            $claims=new Claims();
            if(\Auth::user())
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
            }

            $claims->AWB=$request['awb'];
            $claims->flightNo=$request['flightNo'];
            $claims->literaryAirline=$request['literaryAirline'];
            $claims->irregularity=$request['irregularity'];
            $claims->remark=$request['remark'];
            $claims->contentDescription=$request['contentDescription'];
            $claims->estimatedValue=$request['estimatedPV'];
            $claims->save();
            return redirect()->back()->with('status',"Claims Sent");
        }
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
