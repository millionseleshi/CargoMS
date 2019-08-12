<?php
/**
 * Created by PhpStorm.
 * User: Million
 * Date: 3/13/2019
 * Time: 10:22 PM
 */
?>
@extends('layouts.app')
@section('content')
    <div class="col-md-auto col-sm-auto col-lg-auto">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container">
                    <div class="card-header">{{__('Check Cargo') }}</div>

                    <div class="card-body">


                        {{ csrf_field() }}

                            <div class="form-group row col-md-12">

                                <label for="carrier"
                                       class="col-md-auto col-form-label text-md-right">{{__('Carrier') }}</label>

                                <div class="col-md-4">
                                    <div class="col-md-auto">
                                        <select id="carrier"
                                                class="form-control select2  {{ $errors->has('carrier') ? ' is-invalid' : '' }}"
                                                name="carrier"
                                                value="{{ old('carrier') }}"
                                                style="width: 100%;" autofocus required>
                                            @foreach($carrier as $value)
                                                <option  value="{{$value->flightNumber}}">{{$value->carrier}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('carrier'))
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('carrier') }}</strong>
                                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <label for="SIunitInch" class="col-form-label float-md-left">{{__('In') }}</label>

                                <div class="col-md-3">
                                    <input id="SIunitInch" type="radio" class="form-control icheckbox_flat-aero" name="inUnit" value="inch" required >
                                </div>

                                <label for="SIunitCM" class="col-form-label text-md-right">{{__('CM') }}</label>

                                <div class="col-md-3">
                                    <input id="SIunitCM" type="radio"  class="form-control icheckbox_flat-aero" name="inUnit" value="cm" required >
                                </div>

                            </div>

                            <div class="form-group row col-md-12">

                                <div class="col-md-10 row">

                                    <div class="col-md-4">
                                        <input id="cargoLength" type="number"  placeholder="{{__('Length')}}"
                                               class="form-control{{ $errors->has('cargoLength') ? ' is-invalid' : '' }}"
                                               name="cargoLength" value="{{ old('cargoLength') }}" autofocus required>

                                        @if ($errors->has('cargoLength'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cargoLength') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <input id="cargoWidth" type="number" placeholder="{{__('Width')}}"
                                               class="form-control{{ $errors->has('cargoWidth') ? ' is-invalid' : '' }}"
                                               name="cargoWidth" value="{{ old('cargoWidth') }}" autofocus required>

                                        @if ($errors->has('cargoWidth'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cargoWidth') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <input id="cargoHeight" type="number"  placeholder="{{__('Height')}}"
                                               class="form-control{{ $errors->has('cargoHeight') ? ' is-invalid' : '' }}"
                                               name="cargoHeight" value="{{ old('cargoHeight') }}" required>

                                        @if ($errors->has('cargoHeight'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cargoHeight') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="form-group row"> <button type="button" class="btn btn-outline-info entypo-check" id="loadableCheck">{{__('Check')}}</button></div>

                            <div class="form-group row col-md-6" id="loadableBox" hidden>
                               <textarea id="editor1" name="contentDescription" style="width: 100%" cols="74" rows="4" class="form-control text-justify"></textarea>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
