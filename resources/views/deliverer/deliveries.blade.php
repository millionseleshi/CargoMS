@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
        @foreach($deliveries as $delivery)
            <div class="content col-md-6">
                <div class="card bg-info">
                    <div class="card-body">
                        <h3 class="card-text text-capitalize">{{__('Customer Name:')}}{{$delivery->user_name}}</h3>
                        <p class="card-text"> {{__('Action: ')}}{{$delivery->action}}</p>
                        <p class="card-text">{{__('Total Weight: ')}}{{$delivery->totalWeight}}</p>
                        <p class="card-text">{{__('Amount: ')}}{{$delivery->totalPayment. " birr"}}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a class="btn btn-outline-success small-box-footer text-center fa fa-truck"
                         href="{{route('Delivered',$delivery->id)}}">
                        {{__('Delivered')}}<i class="entypo-check"></i></a>
                </div>

            </div>
        @endforeach
        </div>
    </div>
    <button class="btn btn-link">{{$deliveries->links("pagination::bootstrap-4")}}</button>
     @endsection