@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Flight')}}</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('CreateSchedule') }}">
                            {{ csrf_field() }}

                            <div class="form-group row col-md-12">

                                <label for="carrier"
                                       class="col-md-3 col-form-label float-left">{{ __('Carrier') }}</label>

                                <div class="col-md-7">
                                    <input id="carrier" type="text"
                                           class="form-control{{ $errors->has('carrier') ? ' is-invalid' : '' }}" name="carrier"
                                           value="{{ old('carrier') }}" required autofocus>

                                    @if ($errors->has('carrier'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('carrier') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">

                                <label for="flightNo"
                                       class="col-md-3 col-form-label float-left">{{ __('Flight Number') }}</label>

                                <div class="col-md-7">
                                    <input id="flightNo" type="text"
                                           class="form-control{{ $errors->has('flightNo') ? ' is-invalid' : '' }}"
                                           name="flightNo" value="{{ old('flightNo') }}" required autofocus>

                                    @if ($errors->has('flightNo'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('flightNo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label for="maxWeight"
                                       class="col-md-3 col-form-label float-left">{{ __('Max Weight') }}</label>

                                <div class="col-md-7">
                                    <input id="maxWeight" type="number" min="1"
                                           class="form-control{{ $errors->has('maxWeight') ? ' is-invalid' : '' }}" name="maxWeight"
                                           value="{{ old('maxWeight') }}" required autofocus>

                                    @if ($errors->has('maxWeight'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('maxWeight') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">

                                <div class="col-md-12 row">

                                    <div class="col-md-4">
                                        <input id="cargoLength" type="number" min="1"  placeholder="Max Length"
                                               class="form-control{{ $errors->has('cargoLength') ? ' is-invalid' : '' }}"
                                               name="cargoLength" value="{{ old('cargoLength') }}" autofocus required>

                                        @if ($errors->has('cargoLength'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cargoLength') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <input id="cargoWidth" type="number"min="1" placeholder="Max Width"
                                               class="form-control{{ $errors->has('cargoWidth') ? ' is-invalid' : '' }}"
                                               name="cargoWidth" value="{{ old('cargoWidth') }}" autofocus required>

                                        @if ($errors->has('cargoWidth'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cargoWidth') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <input id="cargoHeight" type="number" min="1" placeholder="Max Height"
                                               class="form-control{{ $errors->has('cargoHeight') ? ' is-invalid' : '' }}"
                                               name="cargoHeight" value="{{ old('cargoHeight') }}" required autofocus>

                                        @if ($errors->has('cargoHeight'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cargoHeight') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row col-md-12">

                                <label for="pickup"
                                       class="col-md-auto col-form-label text-md-right">{{ __('Source') }}</label>

                                <div class="col-md-4">
                                    <select id="pickup" class="form-control {{ $errors->has('pickup') ? ' is-invalid' : '' }}"
                                            name="pickup" style="width: 100%;" required>
                                        <option id="sourceETH" value="ethiopia">{{__('Ethiopia')}}</option>
                                        @foreach($countries as $country)
                                            <option  class="otherSource" value="{{$country->countryName}}">{{$country->countryName}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('pickup'))
                                        <span class="invalid-feedback" role="alert">
                                             <strong>{{$errors->first('pickup') }}</strong>
                                      </span>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <select id="destination" class="form-control {{ $errors->has('destination') ? ' is-invalid' : '' }}"
                                            name="destination" style="width: 100%;" required>
                                        <option id="destinationETH" value="ethiopia">{{__('Ethiopia')}}</option>
                                        @foreach($countries as $country)
                                            <option class="otherDestination"  value="{{$country->countryName}}">{{$country->countryName}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('destination'))
                                    <span class="invalid-feedback" role="alert">
                                         <strong>{{$errors->first('destination') }}</strong>
                                  </span>
                                    @endif
                                </div>

                                <label for="destination"
                                       class="col-md-auto col-form-label text-md-right">{{ __('Destination') }}</label>

                            </div>

                            <div class="form-group row col-md-12">

                                <label for="duration"
                                       class="col-md-4 col-form-label float-left">{{ __('Departure-Arrival Date') }}</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="reservation_two" name="duration" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <button class="btn btn-outline-info entypo-upload-cloud" type="submit">{{__('Upload Schedule')}}</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection