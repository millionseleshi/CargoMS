<?php

namespace App\Http\Controllers\Admin;

use App\Forwarder;
use App\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class manageforwarder extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forwarderAll=Forwarder::all();

        if(count($forwarderAll)>0)
        {
            return view('admin.forwarderlist',compact('forwarderAll'));
        }
        else
        {
            return view('admin.forwarderlist');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adminforwarder');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $forwarderValidator=Validator::make($request->all(),[
            'orgName'=>'required|string|unique:organizations,companyName',
            'orgPhoneNo'=>'required|numeric|digits:10',
            'orgAltPhoneNo'=>'numeric|digits:10',
            'orgEmail'=>'required|email|unique:organizations,email',

            'city' => 'required|string',
            'subcity' => 'required|string',
            'woreda' => 'required|numeric',
            'houseno' => 'required|numeric',
            'aboutForwarder'=>'string|max:114',

            'terminalCharge'=>'required',
        ]);

        if($forwarderValidator->fails())
        {

            return redirect()->back()->withErrors($forwarderValidator)->withInput();
        }

        else{

            $org=new Organization();

            $org->companyName=$request['orgName'];
            $org->phoneNumber=$request['orgPhoneNo'];
            $org->AlternatePhoneNumber=$request['orgAltPhoneNo'];
            $org->email=$request['orgEmail'];
            $org->address=$request['city']." ".$request['subcity']." ".$request['woreda']." ".$request['houseno'];
            $org->about=$request['aboutForwarder'];
            $org->type="forwarder";
            $org->save();

            $forwarder=new Forwarder();
            $forwarder->organization()->associate($org);
            $forwarder->terminalCharge=$request['terminalCharge'];
            $forwarder->save();


            return redirect()->back()->with("successMessage","Deliverer Registered");

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
    public function update(Request $request)
    {
        $id=$request->forwarderId;

        $org=Organization::find($id);

        $org->companyName=$request['orgName'];
        $org->phoneNumber=$request['orgPhoneNo'];
        $org->AlternatePhoneNumber=$request['orgAltPhoneNo'];
        $org->email=$request['orgEmail'];
        $org->address=$request['city']." ".$request['subcity']." ".$request['woreda']." ".$request['houseno'];
        $org->about=$request['aboutForwarder'];
        $org->save();

        $org->forwarder()->where('organization_id',$id)->update(['terminalCharge'=>$request['terminalCharge']]);

        return redirect()->back()->with("successMessage","Forwarder Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $forwarderId=$request->forwarderId;
        $forwarder=Forwarder::find($forwarderId);

        $forwarder->organization()->where('id',$forwarder->organization_id)->delete();
        $forwarder->delete();

        return redirect()->back()->with("successMessage","Forwarder Deleted");
    }


}
