<?php
/**
 * Created by PhpStorm.
 * User: Million
 * Date: 3/13/2019
 * Time: 10:05 PM
 */
?>

    @extends('layouts.app')
@section('content')

    <div class="col-md-auto">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container">
                    <div class="card-header">{{__('Check Shipment')}}</div>

                    <div class="card-body">

                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="awbSearch" class="col-md-2 col-form-label text-md-right">{{__('Enter AWB:') }}</label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <input type="text" placeholder="{{__('Press Enter After Entering AWB')}}"
                                           class="form-control pull-right" id="awbSearch" name="awbSearch">
                                </div>
                            </div>
                        </div>

                        <div class="container-fluid col-md-6">
                            <div class="card bg-info">

                                <div class="card-body">
                                    <h3 class="card-text text-capitalize text-center" id="IDawbHeader">{{__('AWB ')}}</h3>
                                    <p class="card-text text-capitalize" id="IDshipperName"> {{__('Shipper Name')}}{{__(' ')}}</p>
                                    <p class="card-text text-capitalize" id="IDconsigneeName">{{__('Consignee Name')}}{{__(' ')}}</p>
                                    <p class="card-text text-capitalize" id="IDshipmntType">{{__('Shipment Type')}}{{__(' ')}}</p>
                                    <p class="card-text text-capitalize" id="IDtotalWeight">{{__('Total Weight')}}{{__(' ')}}</p>
                                    <p class="card-text text-capitalize" id="IDepartureDate">{{__('Departure Date')}}{{__(' ')}}</p>
                                    <p class="card-text text-capitalize" id="IDarrivalDate">{{__('Arrival Date')}}{{__(' ')}}</p>
                                    <p class="card-text text-capitalize" id="IDstatus">{{__('Status')}}{{__(': ')}}</p>
                                </div>
                            </div>

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
