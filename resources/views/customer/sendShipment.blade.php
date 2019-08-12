<?php
/**
Created by PhpStorm.
User: Million
Date: 3/13/2019
Time: 9:05 PM
 */

?>
@extends('layouts.app')
@section('content')
    <div class="col-md-auto col-sm-auto col-lg-auto">
        <div class="row justify-content-center">
            <div class="col-md-auto">
                <div class="container">
                    <div class="card-header">{{ __('Send Shipment') }}</div>

                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header flex-row">
                                    <h3 class="card-title p-3 text-capitalize">{{__('Fill this forms please!')}}</h3>
                                </div>
                                <div class="card-body">

                                    <div class="card">
                                        <div class="card-header d-flex p-0">
                                            <h3 class="card-title p-3"></h3>
                                            <ul class="nav nav-pills ml-auto p-2">
                                                <li class="nav-item"><a class="nav-link active" href="#tab_1"
                                                                        data-toggle="tab">{{__('Registered Consignee')}}</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#tab_2"
                                                                        data-toggle="tab">{{__('Unregistered Consignee')}}</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1">

                                                    <form action="{{route('BookShipment')}}" method="POST">

                                                        {{csrf_field()}}

                                                        @guest()

                                                            <div class="form-group row">
                                                                <label for="shipperFname"
                                                                       class="col-md-auto col-form-label text-md-right">{{__('ShipperName') }}</label>

                                                                <div class="col-md-3">
                                                                    <input id="shipperFname" type="text"
                                                                           placeholder="{{__('Shipper First Name')}}"
                                                                           class="form-control{{ $errors->has('shipperFname') ? ' is-invalid' : '' }}"
                                                                           name="shipperFname"
                                                                           value="{{ old('shipperFname') }}"
                                                                           required autofocus>

                                                                    @if ($errors->has('shipperFname'))
                                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('shipperFname') }}</strong>
                                                    </span>
                                                                    @endif
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <input id="shipperMname" type="text"
                                                                           placeholder="{{__('Shipper Father Name')}}"
                                                                           class="form-control{{ $errors->has('shipperMname') ? ' is-invalid' : '' }}"
                                                                           name="shipperMname"
                                                                           value="{{ old('shipperMname') }}"
                                                                           required autofocus>

                                                                    @if ($errors->has('shipperMname'))
                                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('shipperMname') }}</strong>
                                                    </span>
                                                                    @endif
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <input id="shipperLname" type="text"
                                                                           placeholder="{{__('Shipper GrandFather Name')}}"
                                                                           class="form-control{{ $errors->has('shipperLname') ? ' is-invalid' : '' }}"
                                                                           name="shipperLname"
                                                                           value="{{ old('shipperLname') }}"
                                                                           required autofocus>

                                                                    @if ($errors->has('shipperLname'))
                                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('shipperLname') }}</strong>
                                                        </span>
                                                                    @endif
                                                                </div>

                                                            </div>

                                                            <div class="form-group row">

                                                                <label for="shipperFname"
                                                                       class="col-md-auto col-form-label text-md-right">{{__('Shipper Address') }}</label>

                                                                <div class="col-md-3">
                                                                    <input id="shipperCity" type="text"
                                                                           placeholder="{{__('City')}}"
                                                                           class="form-control{{ $errors->has('shipperCity') ? ' is-invalid' : '' }}"
                                                                           name="shipperCity"
                                                                           value="{{ old('shipperCity') }}"
                                                                           required>

                                                                    @if ($errors->has('shipperCity'))
                                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('shipperCity') }}</strong>
                                                        </span>
                                                                    @endif
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <input id="ShipperStreetName" type="text"
                                                                           placeholder="{{__('Street Name or Number')}}"
                                                                           class="form-control{{ $errors->has('ShipperStreetName') ? ' is-invalid' : '' }}"
                                                                           name="ShipperStreetName"
                                                                           value="{{ old('ShipperStreetName') }}"
                                                                           required>

                                                                    @if ($errors->has('ShipperStreetName'))
                                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('ShipperStreetName') }}</strong>
                                                        </span>
                                                                    @endif
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <input id="shipperHouseno" type="number" min="0"
                                                                           placeholder="{{__('HouseNo')}}"
                                                                           class="form-control{{ $errors->has('shipperHouseno') ? ' is-invalid' : '' }}"
                                                                           name="shipperHouseno"
                                                                           value="{{ old('shipperHouseno') }}">

                                                                    @if ($errors->has('houseno'))
                                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('houseno') }}</strong>
                                                    </span>
                                                                    @endif
                                                                </div>

                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="phone"
                                                                       class="col-md-4 col-form-label text-md-right">{{__('Phone Number') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="shipperPhone" type="number"
                                                                           placeholder="{{__('Shipper Phone Number')}}"
                                                                           class="form-control{{ $errors->has('shipperPhone') ? ' is-invalid' : '' }}"
                                                                           name="shipperPhone"
                                                                           value="{{ old('shipperPhone') }}"
                                                                           required
                                                                           autofocus>

                                                                    @if ($errors->has('shipperPhone'))
                                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('shipperPhone') }}</strong>
                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="shipperEmail"
                                                                       class="col-md-4 col-form-label text-md-right">{{__('E-Mail Address') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="shipperEmail" type="email"
                                                                           placeholder="{{__('Shipper E-mail')}}"
                                                                           class="form-control{{ $errors->has('shipperEmail') ? ' is-invalid' : '' }}"
                                                                           name="shipperEmail"
                                                                           value="{{ old('shipperEmail') }}"
                                                                           required>

                                                                    @if ($errors->has('shipperEmail'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('shipperEmail') }}</strong>
                                                            </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        @endguest

                                                        <div class="form-group row col-md-auto" id="registeredBox">

                                                            <label for="consigneeUserName"
                                                                   class="col-md-4 col-form-label text-md-right">{{__('Consignee UserName') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="consigneeUserName" type="text"
                                                                       placeholder="{{__('Enter UserName for Registered Consignee')}}"
                                                                       class="form-control{{ $errors->has('userName') ? ' is-invalid' : '' }}"
                                                                       name="userName"
                                                                       value="{{old('userName')}}">

                                                                @if ($errors->has('userName'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('userName') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>


                                                        @auth()
                                                            <input hidden name="authUsername"
                                                                   value="{{Auth::user()->userName}}">
                                                        @endauth

                                                        <div class="form-group row">
                                                            <label for="natureOfShipment"
                                                                   class="col-md-4 col-form-label text-md-right">{{__('Nature Of Shipment') }}</label>

                                                            <div class="col-md-6">
                                                                <select id="natureOfShipment"
                                                                        class="form-control select2  {{ $errors->has('natureOfShipment') ? ' is-invalid' : '' }}"
                                                                        name="natureOfShipment"
                                                                        value="{{ old('natureOfShipment') }}"
                                                                        style="width: 100%;">
                                                                    @foreach($natureOfShipment as $value => $item)
                                                                        <option value="{{$value}}">{{$item}}</option>
                                                                    @endforeach
                                                                </select>

                                                                @if ($errors->has('natureOfShipment'))
                                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('natureOfShipment') }}</strong>
                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="flightNo"
                                                                   class="col-md-4 col-form-label text-md-right">{{__('Flight Number') }}</label>

                                                            <div class="col-md-6">
                                                                <select id="flightNo"
                                                                        class="form-control select2  {{ $errors->has('flightNo') ? ' is-invalid' : '' }}"
                                                                        name="flightNo"
                                                                        value="{{ old('flightNo') }}"
                                                                        style="width: 100%;">
                                                                    @foreach($flightNo as $value)
                                                                        <option value="{{$value->flightNumber}}">{{$value->flightNumber}}</option>
                                                                    @endforeach
                                                                </select>

                                                                @if ($errors->has('flightNo'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('flightNo') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>


                                                        <div class="form-group row">

                                                            <label for="weightOfShipment"
                                                                   class="col-md-4 col-form-label text-md-right">{{__('Weight Of Shipment') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="bookingWeight" type="number" min="1"
                                                                       class="form-control{{ $errors->has('weightOfShipment') ? ' is-invalid' : '' }}"
                                                                       name="weightOfShipment"
                                                                       value="{{ old('weightOfShipment') }}">

                                                                <span class="invalid-feedback" role="alert"
                                                                      id="weightError">
                                                                    <strong>{{__('Weight exceeded carrier capacity')}}</strong>
                                                                </span>

                                                                @if ($errors->has('weightOfShipment'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('weightOfShipment') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row ">

                                                            <label for="deliveryneed"
                                                                   class="col-md-4 col-form-label text-md-right">{{__('Delivery Needed') }}
                                                            </label>

                                                            <div class="col-md-6 float-md-right">
                                                                <input class="icheckbox_flat" type="checkbox"
                                                                       id="deliveryneed" name="deliveryneed"
                                                                       value="needed">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row" id="deliveryList" hidden>

                                                            <label for="deliveryPrice"
                                                                   class="col-md-4 col-form-label text-md-right">{{__('Deliverer') }}</label>

                                                            <div class="col-md-6">
                                                                <select id="deliveryPrice"
                                                                        class="form-control select2  {{ $errors->has('deliveryPrice') ? ' is-invalid' : '' }}"
                                                                        name="deliverer"
                                                                        value="{{ old('deliveryPrice') }}"
                                                                        style="width: 100%;">
                                                                    @foreach($deliverers as $deliverer)
                                                                        <option value="{{$deliverer->id}}">{{$deliverer->organization->companyName}}</option>
                                                                    @endforeach
                                                                </select>

                                                                @if ($errors->has('deliveryPrice'))
                                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('natureOfShipment') }}</strong>
                                                    </span>
                                                                @endif
                                                            </div>


                                                        </div>

                                                        <div class="justify-content-center">

                                                            <div class="form-group row " id="estimatedContainer">
                                                                <table class="table table-responsive">
                                                                    <thead>
                                                                    <th>{{__('Item Type')}}</th>
                                                                    <th>{{__('Item Brand')}}</th>
                                                                    <th>{{__('Item Color')}}</th>
                                                                    <th>{{__('Item Amount')}}</th>
                                                                    <th><input class="btn btn-outline-success"
                                                                               id="addBtn"
                                                                               value="{{__('ADD')}}" type="button"></th>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td><input class="form-control"
                                                                                   name="itemType[]"
                                                                                   required></td>
                                                                        <td><input class="form-control"
                                                                                   name="itemBrand[]"
                                                                                   required></td>
                                                                        <td><input class="form-control"
                                                                                   name="itemColor[]"
                                                                                   required></td>
                                                                        <td><input class="form-control"
                                                                                   name="itemAmount[]"
                                                                                   type="number" min="1" required></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>


                                                        <div class="form-group row float-right">

                                                            <button class="btn btn-outline-info entypo-book-open"
                                                                    id="regidteredBtn"
                                                                    type="submit">{{__('Book Shipment')}}</button>
                                                        </div>

                                                    </form>

                                                </div>

                                                <div class="tab-pane" id="tab_2">

                                                    <form action="{{route('UnregisteredBookShipment')}}" method="POST">

                                                        {{csrf_field()}}

                                                        @guest()

                                                            <div class="form-group row">
                                                                <label for="shipperFname"
                                                                       class="col-md-auto col-form-label text-md-right">{{__('ShipperName') }}</label>

                                                                <div class="col-md-3">
                                                                    <input id="shipperFname" type="text"
                                                                           placeholder="{{__('Shipper First Name')}}"
                                                                           class="form-control{{ $errors->has('shipperFname') ? ' is-invalid' : '' }}"
                                                                           name="shipperFname"
                                                                           value="{{ old('shipperFname') }}"
                                                                           required autofocus>

                                                                    @if ($errors->has('shipperFname'))
                                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('shipperFname') }}</strong>
                                                    </span>
                                                                    @endif
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <input id="shipperMname" type="text"
                                                                           placeholder="{{__('Shipper Father Name')}}"
                                                                           class="form-control{{ $errors->has('shipperMname') ? ' is-invalid' : '' }}"
                                                                           name="shipperMname"
                                                                           value="{{ old('shipperMname') }}"
                                                                           required autofocus>

                                                                    @if ($errors->has('shipperMname'))
                                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('shipperMname') }}</strong>
                                                    </span>
                                                                    @endif
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <input id="shipperLname" type="text"
                                                                           placeholder="{{__('Shipper GrandFather Name')}}"
                                                                           class="form-control{{ $errors->has('shipperLname') ? ' is-invalid' : '' }}"
                                                                           name="shipperLname"
                                                                           value="{{ old('shipperLname') }}"
                                                                           required autofocus>

                                                                    @if ($errors->has('shipperLname'))
                                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('shipperLname') }}</strong>
                                                        </span>
                                                                    @endif
                                                                </div>

                                                            </div>

                                                            <div class="form-group row">

                                                                <label for="shipperFname"
                                                                       class="col-md-auto col-form-label text-md-right">{{__('Shipper Address') }}</label>

                                                                <div class="col-md-3">
                                                                    <input id="shipperCity" type="text"
                                                                           placeholder="{{__('City')}}"
                                                                           class="form-control{{ $errors->has('shipperCity') ? ' is-invalid' : '' }}"
                                                                           name="shipperCity"
                                                                           value="{{ old('shipperCity') }}"
                                                                           required>

                                                                    @if ($errors->has('shipperCity'))
                                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('shipperCity') }}</strong>
                                                        </span>
                                                                    @endif
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <input id="ShipperStreetName" type="text"
                                                                           placeholder="{{__('Street Name or Number')}}"
                                                                           class="form-control{{ $errors->has('ShipperStreetName') ? ' is-invalid' : '' }}"
                                                                           name="ShipperStreetName"
                                                                           value="{{ old('ShipperStreetName') }}"
                                                                           required>

                                                                    @if ($errors->has('ShipperStreetName'))
                                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('ShipperStreetName') }}</strong>
                                                        </span>
                                                                    @endif
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <input id="shipperHouseno" type="number" min="0"
                                                                           placeholder="{{__('HouseNo')}}"
                                                                           class="form-control{{ $errors->has('shipperHouseno') ? ' is-invalid' : '' }}"
                                                                           name="shipperHouseno"
                                                                           value="{{ old('shipperHouseno') }}">

                                                                    @if ($errors->has('houseno'))
                                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('houseno') }}</strong>
                                                    </span>
                                                                    @endif
                                                                </div>

                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="phone"
                                                                       class="col-md-4 col-form-label text-md-right">{{__('Phone Number') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="shipperPhone" type="number"
                                                                           placeholder="{{__('Shipper Phone Number')}}"
                                                                           class="form-control{{ $errors->has('shipperPhone') ? ' is-invalid' : '' }}"
                                                                           name="shipperPhone"
                                                                           value="{{ old('shipperPhone') }}"
                                                                           required
                                                                           autofocus>

                                                                    @if ($errors->has('shipperPhone'))
                                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('shipperPhone') }}</strong>
                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="shipperEmail"
                                                                       class="col-md-4 col-form-label text-md-right">{{__('E-Mail Address') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="shipperEmail" type="email"
                                                                           placeholder="{{__('Shipper E-mail')}}"
                                                                           class="form-control{{ $errors->has('shipperEmail') ? ' is-invalid' : '' }}"
                                                                           name="shipperEmail"
                                                                           value="{{ old('shipperEmail') }}"
                                                                           required>

                                                                    @if ($errors->has('shipperEmail'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('shipperEmail') }}</strong>
                                                            </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        @endguest

                                                        @auth()<input hidden name="authUsername"
                                                                      value="{{Auth::user()->userName}}">
                                                        @endauth

                                                        <div class="card col-md-auto" id="unregisteredBox">

                                                            <div class=card-header>
                                                                <h3 class=card-title>{{__('Unregistered Consignee Detail')}}</h3>
                                                            </div>

                                                            <div class="card-body">
                                                                <div id="accordion">

                                                                    <div class="card card-text">
                                                                        <div class=card-header>
                                                                            <h4 class=card-title>
                                                                                <a class="btn btn-info entypo-info"
                                                                                   data-toggle="collapse"
                                                                                   data-parent="#accordion"
                                                                                   href="#collapseOne">{{__('Click Me')}}</a>{{__('')}}
                                                                            </h4>
                                                                        </div>
                                                                        <div id="collapseOne"
                                                                             class="panel-collapse collapse">
                                                                            <div class="card-body">

                                                                                <div class="form-group row">

                                                                                    <div class="col-md-4">
                                                                                        <input id="consigneeFname"
                                                                                               type="text"
                                                                                               placeholder="{{__('consignee First Name')}}"
                                                                                               class="form-control{{ $errors->has('consigneeFname') ? ' is-invalid' : '' }}"
                                                                                               name="consigneeFname"
                                                                                               value="{{ old('consigneeFname') }}">

                                                                                        @if ($errors->has('consigneeFname'))
                                                                                            <span class="invalid-feedback"
                                                                                                  role="alert">
                                                                                            <strong>{{ $errors->first('consigneeFname') }}</strong>
                                                                                            </span>
                                                                                        @endif
                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <input id="consigneeMname"
                                                                                               type="text"
                                                                                               placeholder="{{__('Consignee Father Name')}}"
                                                                                               class="form-control{{ $errors->has('consigneeMname') ? ' is-invalid' : '' }}"
                                                                                               name="consigneeMname"
                                                                                               value="{{ old('consigneeMname') }}">

                                                                                        @if ($errors->has('consigneeMname'))
                                                                                            <span class="invalid-feedback"
                                                                                                  role="alert"> <strong>{{ $errors->first('consigneeMname') }}</strong>
                                                                                            </span>
                                                                                        @endif
                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <input id="consigneeLname"
                                                                                               type="text"
                                                                                               placeholder="{{__('Consignee GrandFather Name')}}"
                                                                                               class="form-control{{ $errors->has('consigneeLname') ? ' is-invalid' : '' }}"
                                                                                               name="consigneeLname"
                                                                                               value="{{ old('consigneeLname') }}">

                                                                                        @if ($errors->has('consigneeLname'))
                                                                                            <span class="invalid-feedback"
                                                                                                  role="alert">
                                                                                                <strong>{{ $errors->first('consigneeLname') }}</strong>
                                                                                            </span>
                                                                                        @endif
                                                                                    </div>

                                                                                </div>


                                                                                <div class="form-group row">
                                                                                    <label for="consigneePhone"
                                                                                           class="col-md-4 col-form-label text-md-right">{{__('Phone Number') }}</label>

                                                                                    <div class=col-md-6>
                                                                                        <input id="consigneePhone"
                                                                                               type="number"
                                                                                               placeholder="{{__('Consignee Phone')}}"
                                                                                               class="form-control{{ $errors->has('consigneePhone') ? ' is-invalid' : '' }}"
                                                                                               name="consigneePhone"
                                                                                               value="{{ old('consigneePhone') }}">

                                                                                        @if ($errors->has('consigneePhone'))
                                                                                            <span class="invalid-feedback"
                                                                                                  role="alert">
                                                                                                <strong>{{ $errors->first('consigneePhone') }}</strong>
                                                                                                </span>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group row">
                                                                                    <label for="consigneeEmail"
                                                                                           class="col-md-4 col-form-label text-md-right">{{__('E-Mail Address') }}</label>
                                                                                    <div class="col-md-6">
                                                                                        <input id="consigneeEmail"
                                                                                               type="email"
                                                                                               placeholder="{{__('Consignee Email')}}"
                                                                                               class="form-control{{ $errors->has('consigneeEmail') ? ' is-invalid' : '' }}"
                                                                                               name="consigneeEmail"
                                                                                               value="{{ old('consigneeEmail') }}">

                                                                                        @if ($errors->has('consigneeEmail'))
                                                                                            <span class="invalid-feedback"
                                                                                                  role="alert">
<strong>{{ $errors->first('consigneeEmail') }}</strong>
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
                                                                                               value="{{ old('city') }}"
                                                                                        >

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
                                                                                               value="{{ old('streetName') }}">

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
                                                                                               value="{{ old('houseno') }}">

                                                                                        @if ($errors->has('houseno'))
                                                                                            <span class="invalid-feedback"
                                                                                                  role="alert">
<strong>{{ $errors->first('houseno') }}</strong>
</span>
                                                                                        @endif
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>


                                                        <div class="form-group row">
                                                            <label for="natureOfShipment"
                                                                   class="col-md-4 col-form-label text-md-right">{{__('Nature Of Shipment') }}</label>

                                                            <div class="col-md-6">
                                                                <select id="natureOfShipment"
                                                                        class="form-control select2  {{ $errors->has('natureOfShipment') ? ' is-invalid' : '' }}"
                                                                        name="natureOfShipment"
                                                                        value="{{ old('natureOfShipment') }}"
                                                                        style="width: 100%;">
                                                                    @foreach($natureOfShipment as $value => $item)
                                                                        <option value="{{$value}}">{{$item}}</option>
                                                                    @endforeach
                                                                </select>

                                                                @if ($errors->has('natureOfShipment'))
                                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('natureOfShipment') }}</strong>
                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="flightNo"
                                                                   class="col-md-4 col-form-label text-md-right">{{__('Flight Number') }}</label>

                                                            <div class="col-md-6">
                                                                <select id="flightNo_to"
                                                                        class="form-control select2  {{ $errors->has('flightNo') ? ' is-invalid' : '' }}"
                                                                        name="flightNo"
                                                                        value="{{ old('flightNo') }}"
                                                                        style="width: 100%;">
                                                                    @foreach($flightNo as $value)
                                                                        <option value="{{$value->flightNumber}}">{{$value->flightNumber}}</option>
                                                                    @endforeach
                                                                </select>

                                                                @if ($errors->has('flightNo'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $errors->first('flightNo') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">

                                                            <label for="weightOfShipment"
                                                                   class="col-md-4 col-form-label text-md-right">{{__('Weight Of Shipment') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="bookingWeight_to" type="number" min="1"
                                                                       class="form-control{{ $errors->has('weightOfShipment') ? ' is-invalid' : '' }}"
                                                                       name="weightOfShipment"
                                                                       value="{{ old('weightOfShipment') }}">

                                                                <span class="invalid-feedback" role="alert"
                                                                      id="weightError_to">
                                                                    <strong>{{__('Weight exceeded carrier capacity')}}</strong>
                                                                </span>

                                                                @if ($errors->has('weightOfShipment'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('weightOfShipment') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group row ">

                                                            <label for="deliveryneed"
                                                                   class="col-md-4 col-form-label text-md-right">{{__('Delivery Needed') }}
                                                            </label>

                                                            <div class="col-md-6 float-md-right">
                                                                <input class="icheckbox_flat" type="checkbox"
                                                                       id="deliveryneed_to" name="deliveryneed"
                                                                       value="needed">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row" id="deliveryList_to" hidden>

                                                            <label for="deliveryPrice"
                                                                   class="col-md-4 col-form-label text-md-right">{{__('Deliverer') }}</label>

                                                            <div class="col-md-6">
                                                                <select id="deliveryPrice"
                                                                        class="form-control select2  {{ $errors->has('deliveryPrice') ? ' is-invalid' : '' }}"
                                                                        name="deliverer"
                                                                        value="{{ old('deliveryPrice') }}"
                                                                        style="width: 100%;">
                                                                    @foreach($deliverers as $deliverer)
                                                                        <option value="{{$deliverer->id}}">{{$deliverer->organization->companyName}}</option>
                                                                    @endforeach
                                                                </select>

                                                                @if ($errors->has('deliveryPrice'))
                                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('natureOfShipment') }}</strong>
                                                    </span>
                                                                @endif
                                                            </div>


                                                        </div>

                                                        <div class="justify-content-center">

                                                            <div class="form-group row " id="estimatedContainer_to">
                                                                <table class="table table-responsive">
                                                                    <thead>
                                                                    <th>{{__('Item Type')}}</th>
                                                                    <th>{{__('Item Brand')}}</th>
                                                                    <th>{{__('Item Color')}}</th>
                                                                    <th>{{__('Item Amount')}}</th>
                                                                    <th><input class="btn btn-outline-success"
                                                                               id="addBtn_to"
                                                                               value="{{__('ADD')}}" type="button"></th>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr>
                                                                        <td><input class="form-control"
                                                                                   name="itemType[]"
                                                                                   required></td>
                                                                        <td><input class="form-control"
                                                                                   name="itemBrand[]"
                                                                                   required></td>
                                                                        <td><input class="form-control"
                                                                                   name="itemColor[]"
                                                                                   required></td>
                                                                        <td><input class="form-control"
                                                                                   name="itemAmount[]"
                                                                                   type="number" min="1" required></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-auto float-right">

                                                            <button class="btn btn-outline-info entypo-book-open"
                                                                    type="submit"
                                                                    id="regidteredBtn_to">{{__('Book Shipment')}}</button>
                                                        </div>

                                                    </form>

                                                </div>

                                            </div>
                                        </div>
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

