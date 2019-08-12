<?php
/**
 * Created by PhpStorm.
 * User: Million
 * Date: 3/13/2019
 * Time: 9:27 PM
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Update Profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('EditProfile') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <input id="fname" type="text" placeholder="{{__('Name')}}" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname" value="{{Auth::user()->firstName}}" required autofocus>

                                    @if ($errors->has('fname'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <input id="mname" type="text" placeholder="{{__('Father Name')}}" class="form-control{{ $errors->has('mname') ? ' is-invalid' : '' }}"
                                           name="mname" value=" {{Auth::user()->middleName}}" required autofocus>

                                    @if ($errors->has('mname'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mname') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <input id="lname" type="text" placeholder="{{__('GrandFather Name')}}GrandFather Name" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}"
                                           name="lname" value="{{Auth::user()->lastName}}" required autofocus>

                                    @if ($errors->has('lname'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{__('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="number"  class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                           name="phone" value="{{Auth::user()->phoneNumber}}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="altphone" class="col-md-4 col-form-label text-md-right">{{__('Addition PhoneNumber') }}</label>

                                <div class="col-md-6">
                                    <input id="altphone" type="number"  class="form-control{{ $errors->has('altphone') ? ' is-invalid' : '' }}"
                                           name="altphone" value="{{Auth::user()->AlternatePhoneNumber}}" autofocus>

                                    @if ($errors->has('altphone'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('altphone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{__('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{Auth::user()->email}}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-4">
                                    <input id="city" type="text"  placeholder="{{__('City')}}" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ $city }}" required>

                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <input id="streetName" type="text" placeholder="{{__('Street Name or Number')}}"
                                           class="form-control{{ $errors->has('streetName') ? ' is-invalid' : '' }}"
                                           name="streetName" value="{{$streetName}}" required>

                                    @if ($errors->has('streetName'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('streetName') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <input id="houseno" type="number" min="0" placeholder="{{__('HouseNo')}}" class="form-control{{ $errors->has('houseno') ? ' is-invalid' : '' }}"
                                           name="houseno" value="{{ $houseNo }}">

                                    @if ($errors->has('houseno'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('houseno') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="userImage" class="col-md-4 col-form-label text-md-right">{{__('UserImage') }}</label>

                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file"  class="btn-file custom-file-input" id="userImage" name="userImage" accept="image/png,image/jpeg" >
                                            <label class="custom-file-label" for="userImage">{{__('Choose Image')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="imagePreview" class="col-md-4 col-form-label text-md-right">{{__('Image Selected') }}</label>

                               <div class="col-md-7">
                                   <img class="img-responsive" src="{{Auth::user()->userImage==null ?  asset('img/boxed-bg.png') :  Auth::user()->userImage }}"
                                        width="200" height="100" id="imagePreview" alt="UserImage Not selected" >
                               </div>
                            </div>


                            <div class="form-group row col-md-offset-1 pull-right">
                                <button class="btn btn-outline-info entypo-upload" type="submit">{{__('Update')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{__('Change Password')}}</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('ResetPassword')}}">
                            {{csrf_field()}}

                              <div class="form-group row">
                               <label for="existingPassword" class="col-md-4 col-form-label text-md-right">{{ __('Existing Password') }}</label>

                               <div class="col-md-6">
                                   <input id="existingPassword" type="password" class="form-control{{ $errors->has('existingPassword') ? ' is-invalid' : '' }}"

                                          name="existingPassword"  required>

                                   @if ($errors->has('existingPassword'))
                                       <span class="invalid-feedback" role="alert">
                                       <strong>{{ $errors->first('existingPassword') }}</strong>
                                   </span>
                                   @endif
                               </div>
                           </div>

                             <div class="form-group row">
                               <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                               <div class="col-md-6">
                                   <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                   @if ($errors->has('password'))
                                       <span class="invalid-feedback" role="alert">
                                       <strong>{{ $errors->first('password') }}</strong>
                                   </span>
                                   @endif
                               </div>
                           </div>

                             <div class="form-group row">
                               <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                               <div class="col-md-6">
                                   <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                               </div>
                           </div>

                            <div class="form-group row col-md-offset-1 pull-right">
                                <button class="btn btn-outline-info entypo-key" type="submit">{{__('Change Password')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
