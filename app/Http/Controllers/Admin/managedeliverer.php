<?php

namespace App\Http\Controllers\Admin;

use App\Deliverer;
use App\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class managedeliverer extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivererAll=Deliverer::all();

        if(sizeof($delivererAll)>0)
        {
            return view('admin.delivererlist',compact('delivererAll'));
        }
        else
        {
            return view('admin.delivererlist');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admindeliverer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $delivererValidator=Validator::make($request->all(),[
            'orgName'=>'required|string|unique:organizations,companyName',
            'orgPhoneNo'=>'required|numeric|digits:10',
            'orgAltPhoneNo'=>'numeric|digits:10',
            'orgEmail'=>'required|email|unique:organizations,email',

            'city' => 'required|string',
            'subcity' => 'required|string',
            'woreda' => 'required|numeric',
            'houseno' => 'required|numeric',
            'aboutDelivery'=>'string|max:114',

            'deliveryPrice'=>'required',
        ]);

        if($delivererValidator->fails())
        {

            return redirect()->back()->withErrors($delivererValidator)->withInput();
        }

        else{

            $org=new Organization();

            $org->companyName=$request['orgName'];
            $org->phoneNumber=$request['orgPhoneNo'];
            $org->AlternatePhoneNumber=$request['orgAltPhoneNo'];
            $org->email=$request['orgEmail'];
            $org->address=$request['city']." ".$request['subcity']." ".$request['woreda']." ".$request['houseno'];
            $org->about=$request['aboutDelivery'];
            $org->type="deliverer";
            $org->save();

            $deliverer=new Deliverer();
            $deliverer->organization()->associate($org);
            $deliverer->deliveryPrice=$request['deliveryPrice'];
            $deliverer->save();


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

        $id=$request->delivererId;

        $org=Organization::find($id);

        $org->companyName=$request['orgName'];
        $org->phoneNumber=$request['orgPhoneNo'];
        $org->AlternatePhoneNumber=$request['orgAltPhoneNo'];
        $org->email=$request['orgEmail'];
        $org->address=$request['city']." ".$request['subcity']." ".$request['woreda']." ".$request['houseno'];
        $org->about=$request['aboutDelivery'];
        $org->save();

        $org->deliverer()->where('organization_id',$id)->update(['deliveryPrice'=>$request['deliveryPrice']]);

        return redirect()->back()->with("successMessage","Deliverer Updated");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $delivererId=$request->delivererId;
       $deliverer=Deliverer::find($delivererId);

       $deliverer->organization()->where('id',$deliverer->organization_id)->delete();
       $deliverer->delete();

        return redirect()->back()->with("successMessage","Deliverer Deleted");
    }



}
