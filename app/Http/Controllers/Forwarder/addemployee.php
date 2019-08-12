<?php

namespace App\Http\Controllers\Forwarder;

use App\Employee;
use App\Providers\AuthServiceProvider;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class addemployee extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forwarder.addemployee');
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
        $validator=\Validator::make($request->all(),[
            'fname'=>'required|string|min:2|max:20',
            'mname'=>'required|string|min:2|max:20',
            'lname'=>'required|string|min:2|max:20',
            'phone'=>'required|numeric|digits:10',
            'altphone'=>'numeric|digits:10',
            'email'=>'required|email|unique:users,email',
            'city'=>'required|string|min:2',
            'subcity'=>'required|string|min:2',
            'woreda'=>'required|numeric',
            'houseno'=>'numeric',
            'position'=>'required|string'
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        else
            {
                $user=new User();
                $user->firstName=$request['fname'];
                $user->middleName=$request['mname'];
                $user->lastName=$request['lname'];
                $user->phoneNumber=$request['phone'];
                $user->AlternatePhoneNumber=$request['altphone'];
                $user->email=$request['email'];
                $user->address=$request['city']." ".$request['subcity']." ".$request['woreda']." ".$request['houseno'];
                $user->role="Femployee";
                $user->save();

                $authUserId=\Auth::user()->id;

                $employee=new \App\Employee();
                $employee->position=$request['position'];
                $employee->type="forwarder";
                $employee->user_id=$user->id;
                $employee->organizations_id= Employee::where('user_id',$authUserId)->pluck('organizations_id')[0];
                $employee->save();
                return redirect()->back()->with('status','Employee Registered');

            }

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
