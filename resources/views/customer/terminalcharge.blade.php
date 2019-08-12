<?php
/**
 * Created by PhpStorm.
 * User: Million
 * Date: 3/13/2019
 * Time: 9:21 PM
 */
?>

@extends('layouts.app')
@section('content')

    <div class="col-md-auto">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container">
                    <div class="card-header">{{__('Terminal Charge Calculator') }}</div>

                    <div class="card-body">

                       {{--<input value="{{$terminalCharge[0]}}" hidden id="terminalCharge"/>--}}

                        <div class="form-group row">
                            <label for="calcShipmentType" class="col-md-4 col-form-label text-md-right">{{__('Nature Of Shipment') }}</label>

                            <div class="col-md-6">
                                <select id="calcShipmentType" class="form-control select2 {{ $errors->has('natureOfShipment') ? ' is-invalid' : '' }}"
                                        name="natureOfShipment" value="{{ old('natureOfShipment') }}" required autofocus style="width: 100%;">
                                    @foreach($natureOfShipment as $value => $item)
                                        <option value="{{$value}}">{{$item}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('destination'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('destination') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">

                            <label for="calcWeight" class="col-md-4 col-form-label text-md-right">{{__('Weight Of Shipment') }}</label>

                            <div class="col-md-6">
                                <input id="calcWeight" type="number" min="1" class="form-control{{ $errors->has('weightOfShipment') ? ' is-invalid' : '' }}"
                                       name="weightOfShipment" value="{{ old('weightOfShipment') }}" required autofocus>

                                @if ($errors->has('weightOfShipment'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('weightOfShipment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="destination" class="col-md-4 col-form-label text-md-right">{{__('Arrival Date-PickUp Date:') }}</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="reservation_calculator" name="datesReservation">
                                </div>
                            </div>
                        </div>


                        <div class="row justify-content-center">

                            <button class="btn btn-outline-info fa fa-calculator col-sm-3" type="button" id="chargeCalculate"> {{__('Calculate')}}</button>
                        </div>

                        <br>

                        <div class="container-fluid row">
                            <label for="destination" class="col-md-4 col-form-label text-md-right">{{__('Terminal Charge') }}</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                   <textarea class="form-control" rows="7" id="chargeValue" disabled></textarea>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection
