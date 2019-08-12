<?php

namespace App\Http\Controllers\Customer;

use App\Rules\ValidatePassword;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

class editprofile extends Controller
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

        $address=\Auth::user()->address;
         $explodedAddress=explode('-',$address);
         $city=$explodedAddress[0];
         $streetName=$explodedAddress[1];
         $houseNo=$explodedAddress[2];
        return view('customer.editprofile',compact('city','streetName','houseNo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            return redirect()->back()->withErrors($validator)->withInput();
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

                return redirect()->back()->with('status', 'Edit Profile Successful');

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
    public function resetPassword(Request $request)
    {
        $userID=Auth::user()->id;

        $password=Auth::user()->getAuthPassword();

        $validator=Validator::make($request->all(),
            [
                'existingPassword'=>['required','min:8',new ValidatePassword(\auth()->user())],
                'password' => ['required', 'min:8','different:existingPassword', 'confirmed'],
            ]);


        if($validator->fails())
        {

            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {

            $user=User::find($userID);
            $user->password=bcrypt($request['password']);
            $user->save();

            return redirect()->back()->with('status', 'Password Reset Successful');

        }

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
