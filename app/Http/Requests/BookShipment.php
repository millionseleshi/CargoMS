<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BookShipment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(Auth::guest())

        {
            return ['userName' => [ 'sometimes',Rule::exists('users','userName')->where('role','customer')],

                'consigneeFname' => ['sometimes','alpha','min:2','max:20'],
                'consigneeMname' => ['sometimes','alpha','min:2','max:20]'],
                'consigneeLname' => ['sometimes','alpha','min:2','max:20'],
                'consigneePhone' => ['sometimes','digits:10'],
                'consigneeEmail' => ['sometimes','email'],

                'city' => ['sometimes','alpha'],
                'streetName' =>['sometimes','alpha_num'],
                'houseno' => ['sometimes','numeric'],
                'deliverer'=>['required_if:deliveryneed,needed'],

                'natureOfShipment' => 'required',
                'weightOfShipment' => ['required','numeric'],
                'flightNo'=>'required',];
        }
        if(Auth::user())
        {
            return [
                'userName' => [ 'sometimes','different:authUsername',Rule::exists('users','userName')->where('role','customer')],

                'consigneeFname' => ['sometimes','alpha','min:2','max:20'],
                'consigneeMname' => ['sometimes','alpha','min:2','max:20]'],
                'consigneeLname' => ['sometimes','alpha','min:2','max:20'],
                'consigneePhone' => ['sometimes','digits:10'],
                'consigneeEmail' => ['sometimes','email'],

                'city' => ['sometimes','alpha'],
                'streetName' =>['sometimes','alpha_num'],
                'houseno' => ['sometimes','numeric'],
                'deliverer'=>['required_if:deliveryneed,needed'],

                'natureOfShipment' => 'required',
                'weightOfShipment' => ['required','numeric'],
                'flightNo'=>'required',

            ];
        }
    }

    public function messages()
    {
        return  $messages = [
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
    }
}


