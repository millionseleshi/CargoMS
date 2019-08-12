<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Organization;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class manageemployee extends Controller
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
        $forwarderOrganization=Organization::where('type','forwarder')->get();
        $delivererOrganization=Organization::where('type','deliverer')->get();
        return view('admin.adminemployee',compact('forwarderOrganization','delivererOrganization'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $employeeValidation=Validator::make($request->all(),
               [
                 'employeeType'=>'required',
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
//                   'position'=>'required|string'
               ]);

           if($employeeValidation->fails())
           {
               return redirect()->back()->withErrors($employeeValidation)->withInput();
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


               $employee=new Employee();
               if($request['employeeType']=="forwarder")
               {
                   $user->role="Femployee";
                   $employee->position="ForwarderAdmin";
                   $employee->organizations_id=$request['forwarderList'];

               }
               else
               {
                    $user->role="Demployee";
                   $employee->position="DelivererAdmin";
                   $employee->organizations_id=$request['delivererList'];

               }

               $user->save();

               $employee->type=$request['employeeType'];
               $employee->user_id=$user->id;
               $employee->save();

               //TODO finish register with UserName + password from email link


               return back()->with('SuccessMessage','Employee Registered');
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
