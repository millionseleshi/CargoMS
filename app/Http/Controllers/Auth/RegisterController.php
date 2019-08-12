<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $user
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $user)
    {
        return Validator::make($user, [
            'fname' => ['required', 'string', 'max:20','min:2'],
            'mname' => ['required', 'string', 'max:20','min:2'],
            'lname' => ['required', 'string', 'max:20','min:2'],
            'phone'=>['required','digits:10'],
            'altphone'=>['nullable'],

             'city'=>['required','string','min:2'],
             'streetName'=>['required','string','min:2'],
             'houseno'=>['string'],

            'username'=>['required','string','max:15','min:2','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $user
     * @return \App\User
     */
    protected function create(array $user)
    {
        return User::create([
            'firstName' => $user['fname'],
            'middleName' => $user['mname'],
            'lastName' => $user['lname'],
            'phoneNumber' => $user['phone'],
            'AlternatePhoneNumber' => $user['altphone'],
            'address' => $user['city']."-".$user['streetName']."-".$user['houseno'],
            'userName' => $user['username'],
            'email' => $user['email'],
            'password' => bcrypt($user['password'])
        ]);
    }


}
