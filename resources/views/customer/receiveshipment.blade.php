<?php
/**
 * Created by PhpStorm.
 * User: Million
 * Date: 3/13/2019
 * Time: 9:13 PM
 */

?>

@extends('layouts.app')

@section('content')

    <div class="col-md-auto">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container">
                    <div class="card-header"></div>

                    <div class="card-body">

                    </div>

                        <div class="col-md-11">
                            <div class="box-header">
                                <h3 class="box-title">{{__('See Your Package')}}</h3>
                            </div>

                            <div class="container-fluid col-md-12">

                            <table class="table table-responsive table-hover" id="receivedShipmentTable">
                                <thead>
                                <tr>
                                    <th>{{__('ID')}}</th>
                                    <th>{{__('Shipper Name')}}</th>
                                    <th>{{__('Shipment Type')}}</th>
                                    <th>{{__('Total Weight')}}</th>
                                    <th>{{__('Arrival Date')}}</th>
                                    <th>{{__('AWB')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('PAY')}}</th>
                                </tr>
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
