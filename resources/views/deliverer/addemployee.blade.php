@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('AddDeliverer') }}">
                            {{ csrf_field() }}


                            <div class="form-group row">
                                <label for="fname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="fname" type="text" placeholder="Name" class="form-control{{ $errors->has('fname') ? ' is-invalid' : '' }}" name="fname" value="{{ old('fname') }}" required autofocus>

                                    @if ($errors->has('fname'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mname" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                                <div class="col-md-6">
                                    <input id="mname" type="text" placeholder="Father Name" class="form-control{{ $errors->has('mname') ? ' is-invalid' : '' }}" name="mname" value="{{ old('mname') }}" required autofocus>

                                    @if ($errors->has('mname'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="lname" type="text" placeholder="GrandFather Name" class="form-control{{ $errors->has('lname') ? ' is-invalid' : '' }}" name="lname" value="{{ old('lname') }}" required autofocus>

                                    @if ($errors->has('lname'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="number"  class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="altphone" class="col-md-4 col-form-label text-md-right">{{ __('Addition PhoneNumber') }}</label>

                                <div class="col-md-6">
                                    <input id="altphone" type="number"  class="form-control{{ $errors->has('altphone') ? ' is-invalid' : '' }}" name="altphone" value="{{ old('altphone') }}" autofocus>

                                    @if ($errors->has('altphone'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('altphone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-3">
                                    <input id="city" type="text"  placeholder="City" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" required>

                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    <input id="subcity" type="text" placeholder="Subcity" class="form-control{{ $errors->has('subcity') ? ' is-invalid' : '' }}" name="subcity" value="{{ old('subcity') }}" required>

                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subcity') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    <input id="woreda" type="number" min="0" placeholder="Woreda" class="form-control{{ $errors->has('woreda') ? ' is-invalid' : '' }}" name="woreda" value="{{ old('woreda') }}" required>

                                    @if ($errors->has('woreda'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('woreda') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-3">
                                    <input id="houseno" type="number" min="0" placeholder="HouseNo" class="form-control{{ $errors->has('houseno') ? ' is-invalid' : '' }}" name="houseno" value="{{ old('houseno') }}">

                                    @if ($errors->has('houseno'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('houseno') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                             <div class="form-group row">
                                 <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>

                                 <div class="col-md-6">
                                     <input id="position" type="text" placeholder="Position" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}" name="position" value="{{ old('position') }}" required autofocus>

                                     @if ($errors->has('position'))
                                         <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('position') }}</strong>
                                     </span>
                                     @endif
                                 </div>
                             </div>

                            <div class="form-group col-md-5 pull-right">
                                <button class="btn btn-outline-info entypo-user-add" type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection