@extends('layouts.app')
@section('content')
    <div class="col-md-auto col-sm-auto col-lg-auto">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="container">
                    <div class="card">
                        <div class="card-header">{{__('Payment Form')}}</div>

                        <div class="card-body">

                            <div class="card col-md-auto">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('Item Detail')}}</h3>
                                </div>

                                <div class="card-body">
                                    <div id="accordion">

                                        <div class="card card-text">
                                            <div class="card-header">
                                                <h4 class="card-title">
                                                    <a class="btn  btn-outline-info entypo-down-dir" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" >
                                                        {{__('Items')}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                <div class="card-body">
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>{{__('Type')}}</th>
                                                            <th>{{__('Brand')}}</th>
                                                            <th>{{__('Color')}}</th>
                                                            <th>{{__('Amount')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($itemDetail as $item)
                                                            <tr>
                                                                <td>{{$item->type}}</td>
                                                                <td>{{$item->brand}}</td>
                                                                <td>{{$item->color}}</td>
                                                                <td>{{$item->amount}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="card col-md-auto">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('Shipper')}}</h3>
                                </div>

                                <div class="card-body">
                                    <div id="accordion">

                                        <div class="card card-text">
                                            <div class="card-header">
                                                <h4 class="card-title">
                                                    <a class="btn btn-outline-info entypo-down-dir" data-toggle="collapse" data-parent="#accordion" href="#collapseShipper" >
                                                        {{__('Shipper Detail')}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseShipper" class="panel-collapse collapse">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Shipper Name') }}</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control" value="{{$shipment->shipperName}}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Shipper Address') }}</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control" value="{{$shipment->shipperAddress}}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Shipper Phone Number') }}</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control" value="{{$shipment->shipperPhoneNumber}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="card col-md-auto">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('Consignee')}}</h3>
                                </div>

                                <div class="card-body">
                                    <div id="accordion">

                                        <div class="card card-text">
                                            <div class="card-header">
                                                <h4 class="card-title">
                                                    <a class="btn  btn-outline-info entypo-down-dir" data-toggle="collapse" data-parent="#accordion" href="#collapseConsignee" >
                                                        {{__('Consignee Detail')}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseConsignee" class="panel-collapse collapse">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Consignee Name') }}</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control" value="{{$shipment->consigneeName}}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Consignee Address') }}</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control" value="{{$shipment->consigneeAddress}}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Consignee Phone') }}</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control" value="{{$shipment->consigneePhoneNumber}}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Consignee Email') }}</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control" value="{{$shipment->consigneeEmail}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="card col-md-auto">
                                <div class="card-header">
                                    <h3 class="card-title">{{__('Shipment')}}</h3>
                                </div>

                                <div class="card-body">
                                    <div id="accordion">

                                        <div class="card card-text">
                                            <div class="card-header">
                                                <h4 class="card-title">
                                                    <a class="btn  btn-outline-info entypo-down-dir" data-toggle="collapse" data-parent="#accordion" href="#collapseShipment" >
                                                        {{__('Shipment Detail')}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseShipment" class="panel-collapse collapse">
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Total Weight') }}</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control" value="{{$shipment->totalWeight}}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label text-md-right">{{ __('Shipment Type') }}</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control" id="shipmentType" value="{{$shipment->shipmentType}}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label text-md-right">{{ __('AWB') }}</label>
                                                        <div class="col-md-6">
                                                            <input class="form-control" value="{{$shipment->AWB}}" disabled>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="form-group row" id="deliveryList_to" >

                                <label for="deliveryPrice"
                                       class="col-md-4 col-form-label text-md-right">{{__('Deliverer') }}</label>

                                <div class="col-md-6">
                                    <select id="deliveryPrice"
                                            class="form-control select2  {{ $errors->has('deliveryPrice') ? ' is-invalid' : '' }}"
                                            name="deliverer"
                                            style="width: 100%;" required>
                                        <option value="">{{__('Select Deliverer')}}</option>
                                        @foreach($deliverers as $deliverer)
                                            <option value="{{$deliverer->deliveryPrice."-".$deliverer->id}}">{{$deliverer->organization->companyName}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('deliveryPrice'))
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('natureOfShipment') }}</strong>
                                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group row" id="delivery_date" >

                                <label for="datepicker"
                                       class="col-md-4 col-form-label text-md-right">{{__('Delivery Date') }}</label>

                                <div class="col-sm-6" id="pickerContainer">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="entypo-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" name="deliveryDate" id="datepicker" required>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row justify-content-center"  id="received_Calculate">

                                <input hidden name="shipmentId" id="shipmentId" value="{{$shipment->id}}">
                                <button class="btn btn-outline-info fa fa-calculator col-sm-3" type="button" id="CalculateBtn"> {{__('Calculate')}}</button>

                            </div>

                            <div class="form-group row">

                                <label for="totalPayment"
                                       class="col-md-4 col-form-label text-md-right">{{__('Total Payment') }}</label>

                                <div class="col-md-7">
                                    <textarea  id="totalPayment" class="form-control text-justify"  rows="6" name="totalPayment" value="" disabled></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Total Cost') }}</label>
                                <div class="col-md-6">
                                    <input class="form-control" value="" id="totalCost" name="TotalCost" disabled>
                                    <small id="totalCost" class="text-muted">
                                        {{__('With Delivery (ETB)')}}
                                    </small>
                                </div>
                            </div>

                            <div class="form-group row justify-content-end">
                                <button class="btn btn-outline-info fa fa-get-pocket col-sm-3" type="button" data-toggle="modal"
                                        data-target="#paymentModal"> {{__('Accept')}}</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endsection

<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Account Information')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('PAY')}}">
                {{csrf_field()}}
            <div class="modal-body">
                      <div class="card">
                          <div class="card-header">
                              <h5 class="text-center">{{__('Use the following Accounts to pay,Thank You')}}</h5>
                          </div>
                          <div class="card-body">
                              <input id="totalPrice" name="totalPrice" value="" hidden >
                              <input id="delivererID" name="delivererID" value=""  hidden>
                              <input name="shipmentId"  value="{{$shipment->id}}" hidden>
                              <p>{{__('Commercial Bank of Ethiopia: ')}}</p><input class="form-control" value="10000190121" disabled="disabled">
                              {{--<p>{{__('Awash Bank: ')}}</p></p><input class="form-control" value="10000190121" disabled="disabled">--}}
                              {{--<p>{{__('Dashen Bank: ')}}</p></p><input class="form-control" value="10000190121" disabled="disabled">--}}
                              {{--<p>{{__('Zemen Bank: ')}}</p></p><input class="form-control" value="10000190121" disabled="disabled">--}}
                          </div>
                      </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{__('Close')}}</button>
                <button type="submit" class="btn btn-outline-primary">{{__('Save')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>