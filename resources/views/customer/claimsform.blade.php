<?php
/**
 * Created by PhpStorm.
 * User: Million
 * Date: 3/13/2019
 * Time: 10:16 PM
 */
?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('Claims Form')}}</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('AddClaims') }}">
                            {{ csrf_field() }}

                            @guest()

                                <div class="form-group row">

                                    <div class="col-md-4">
                                        <input id="claimersFname"
                                               type="text"
                                               placeholder="{{__('Claimer First Name')}}"
                                               class="form-control{{ $errors->has('claimersFname') ? ' is-invalid' : '' }}"
                                               name="claimersFname"
                                               value="{{ old('claimersFname') }}" required>

                                        @if ($errors->has('claimersFname'))
                                            <span class="invalid-feedback"
                                                  role="alert">
                                                <strong>{{ $errors->first('claimersFname') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <input id="claimersMname"
                                               type="text"
                                               placeholder="{{__('Claimer Father \'s Name')}}"
                                               class="form-control{{ $errors->has('claimersMname') ? ' is-invalid' : '' }}"
                                               name="claimersMname"
                                               value="{{ old('claimersMname') }}" required>

                                        @if ($errors->has('claimersMname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('claimersMname') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <input id="claimersLname"
                                               type="text"
                                               placeholder="{{__('Claimer G.Father Name')}}"
                                               class="form-control{{ $errors->has('claimersLname') ? ' is-invalid' : '' }}"
                                               name="claimersLname"
                                               value="{{ old('claimersLname') }}" required>

                                        @if ($errors->has('claimersLname'))
                                            <span class="invalid-feedback"
                                                  role="alert">
                                            <strong>{{ $errors->first('consigneeLname') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <label for="claimersPhone"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Phone Number*') }}</label>

                                    <div class=col-md-6>
                                        <input id="claimersPhone"
                                               type="number"
                                               placeholder="{{__('Claimers Phone')}}"
                                               class="form-control{{ $errors->has('claimersPhone') ? ' is-invalid' : '' }}"
                                               name="claimersPhone"
                                               value="{{ old('claimersPhone') }}" required>

                                        @if ($errors->has('claimersPhone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('claimersPhone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="claimersEmail"
                                           class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address*') }}</label>
                                    <div class="col-md-6">
                                        <input id="claimersEmail"
                                               type="email"
                                               placeholder="{{__('Claimers Email')}}"
                                               class="form-control{{ $errors->has('claimersEmail') ? ' is-invalid' : '' }}"
                                               name="claimersEmail"
                                               value="{{ old('claimersEmail') }}" required>

                                        @if ($errors->has('claimersEmail'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('claimersEmail') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-4">
                                        <input id="city" type="text"
                                               placeholder="{{__('City')}}"
                                               class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                                               name="city"
                                               value="{{ old('city') }}" required>

                                        @if ($errors->has('city'))
                                            <span class="invalid-feedback"
                                                  role="alert">
                                            <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class=col-md-4>
                                        <input id=streetName type=text
                                               placeholder="{{__('Street Name or Number')}}"
                                               class="form-control{{ $errors->has('streetName') ? ' is-invalid' : '' }}"
                                               name="streetName"
                                               value="{{ old('streetName') }}" required>

                                        @if ($errors->has('streetName'))
                                            <span class="invalid-feedback"
                                                  role="alert">
                                                 <strong>{{ $errors->first('streetName') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <input id="houseno"
                                               type="number"
                                               min=0
                                               placeholder="{{__('HouseNo')}}"
                                               class="form-control{{ $errors->has('houseno') ? ' is-invalid' : '' }}"
                                               name="houseno"
                                               value="{{ old('houseno') }}" required>

                                        @if ($errors->has('houseno'))
                                            <span class="invalid-feedback"
                                                  role="alert">
                                                     <strong>{{ $errors->first('houseno') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>

                                @endguest

                            <div class="form-group row col-md-12">

                                <label for="literaryAirline"
                                       class="col-md-3 col-form-label float-left">{{__('AWB') }}</label>

                                <div class="col-md-7">
                                    <input id="awb" type="text"
                                           class="form-control{{ $errors->has('awb') ? ' is-invalid' : '' }}" name="awb"
                                           value="{{ old('awb') }}" required autofocus>

                                    @if ($errors->has('awb'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('awb') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">

                                <label for="literaryAirline"
                                       class="col-md-3 col-form-label float-left">{{__('Literary Airline') }}</label>

                                <div class="col-md-7">
                                    <input id="literaryAirline" type="text"
                                           class="form-control{{ $errors->has('literaryAirline') ? ' is-invalid' : '' }}"
                                           name="literaryAirline" value="{{ old('literaryAirline') }}" required
                                           autofocus>

                                    @if ($errors->has('literaryAirline'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('literaryAirline') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">

                                <label for="flightNo"
                                       class="col-md-3 col-form-label float-left">{{__('Flight Number') }}</label>

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

                            {{--<div class="form-group row col-md-12">--}}

                                {{--<label for="fromTo"--}}
                                       {{--class="col-md-3 col-form-label float-left">{{__('Date-Month') }}</label>--}}
                                {{--<div class="col-md-7">--}}
                                    {{--<input type="text" class="form-control" id="reservation" name="fromTo" required--}}
                                           {{--autofocus>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group row col-md-12">

                                {{--<label for="contentDescription"--}}
                                       {{--class="col-md-auto col-form-label float-left">{{ __('Content Description') }}</label>--}}

                                <div class="col-md-auto">
                                    <textarea id="editor1" placeholder="{{__('Content Description')}}" name="contentDescription" style="width: 100%" cols="74"
                                              rows="4" class="form-control" required></textarea>
                                </div>
                            </div>

                            <div class="form-group row col-md-12">
                                <label for="irregularity"
                                       class="col-md-3 col-form-label float-left">{{__('Type of Irregularity') }}</label>

                                <div class="col-md-7">
                                    <select id="irregularity"
                                            class="form-control select2  {{ $errors->has('irregularity') ? ' is-invalid' : '' }}"
                                            name="irregularity"
                                            value="{{ old('irregularity') }}"
                                            style="width: 100%;">
                                        @foreach($irregularity as $value => $item)
                                            <option value="{{$value}}">{{$item}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('irregularity'))
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('irregularity') }}</strong>
                                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row col-md-12">

                                {{--<label for="remark"--}}
                                       {{--class="col-md-auto col-form-label float-left">{{ __('Remark') }}</label>--}}

                                <div class="col-md-auto">
                                    <textarea id="editor1" placeholder="{{__('Remark')}}" name="remark" style="width: 100%" cols="74" rows="4"
                                              class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row col-md-auto">

                            <div class="form-group row col-md-12">

                                    <label for="estimatedPV"
                                           class="col-md-auto col-form-label float-left">{{__('Estimated Present Value') }}</label>

                                    <div class="col-md-7">
                                        <input id="estimatedPV" type="number"
                                               class="form-control{{ $errors->has('estimatedPV') ? ' is-invalid' : '' }}"
                                               name="estimatedPV" value="{{ old('literaryAirline') }}" required
                                               autofocus>

                                        @if ($errors->has('estimatedPV'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('estimatedPV') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                            <div class="form-group row col-md-12">
                                <div class="col-md-7"></div>
                                <div class="col-md-auto float-right">
                                    <button class="btn btn-outline-info entypo-upload-cloud" type="submit">{{__('Send Claim')}}</button>
                                </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
