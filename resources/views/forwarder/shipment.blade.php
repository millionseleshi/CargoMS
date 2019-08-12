<?php
/**
 * Created by PhpStorm.
 * User: Million
 * Date: 3/13/2019
 * Time: 11:37 PM
 */
?>
@extends('layouts.app')
@section('content')
    <div class="container-fluid">
    <div class="row">
    @foreach ($shipments as $shipment)
            <div class="content col-md-4">

                <!-- small box -->
                <div class="card bg-info">
                    <div class="card-body">
                        <h3 class="card-text text-capitalize">AWB:{{$shipment->AWB}}</h3>
                        <p class="card-text"> Shipper Name:{{$shipment->shipperName}}</p>
                        <p class="card-text">Consignee Name:{{$shipment->consigneeName}}</p>
                        <p class="card-text">Shipment Type:{{$shipment->shipmentType}}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('ShipmentDetails',['id'=>$shipment->id])}}" class="small-box-footer text-center bg-warning-gradient">More info <i class="entypo-right-bold"></i></a>
                </div>

            </div>


        @endforeach
    </div>
    </div>
    <button class="btn btn-link">{{$shipments->links("pagination::bootstrap-4")}}</button>
@endsection
