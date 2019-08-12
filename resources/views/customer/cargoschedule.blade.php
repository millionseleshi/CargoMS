<?php
/**
 * Created by PhpStorm.
 * User: Million
 * Date: 3/13/2019
 * Time: 10:11 PM
 */
?>

@extends('layouts.app')
@section('content')
    <div class="col-md-auto">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container">
                    <div class="card-header">{{__('Check Flight Schedule')}}</div>

                    <div class="card-body">
                        <div class="col-md-auto">
                            <table class="table table-responsive " id="cargoScheduleTable">
                                <thead>
                                <th>{{__('Flight Number')}}</th>
                                <th>{{__('carrier')}}</th>
                                <th>{{__('From-To')}}</th>
                                <th>{{__('DepartureDate-ArrivalDate')}}</th>
                                <th>{{__('Max Weight')}}</th>
                                {{--<th>{{__('Status')}}</th>--}}
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection