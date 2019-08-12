@extends('layouts.app')
@section('content')

    <div class="col-md-auto col-sm-auto col-lg-auto">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container">
                    <div class="card-header">{{ __('Shipment Detail') }}</div>
                    <div class="card-body">

                        <form action="{{route('ProcessShipment')}}" method="POST">
                            {{csrf_field()}}

                        <div class="card col-md-auto">
                            <div class="card-header">
                                <h3 class="card-title">{{__('Item Detail')}}</h3>
                            </div>

                            <div class="card-body">
                                <div id="accordion">

                                    <div class="card card-text">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <a class="btn btn-info" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" >
                                                   {{__('Items')}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse">
                                            <div class="card-body">
                                                 <table class="table table-hover">
                                                     <thead>
                                                     <tr>
                                                         <th>Type</th>
                                                         <th>Brand</th>
                                                         <th>Color</th>
                                                         <th>Amount</th>
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

                        <input hidden name="id" value="{{$shipment->id}}">

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
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Shipper PhoneNumber') }}</label>
                            <div class="col-md-6">
                                <input class="form-control" value="{{$shipment->shipperPhoneNumber}}" disabled>
                            </div>
                        </div>

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
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Consignee PhoneNumber') }}</label>
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

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Total Weight') }}</label>
                            <div class="col-md-6">
                                <input class="form-control" value="{{$shipment->totalWeight}}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Shipment Type') }}</label>
                            <div class="col-md-6">
                                <input class="form-control" value="{{$shipment->shipmentType}}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('AWB') }}</label>
                            <div class="col-md-6">
                                <input class="form-control" value="{{$shipment->AWB}}" disabled>
                            </div>
                        </div>


                              <div class="form-group row">

                                  <label for="status" class="col-md-3 col-form-label text-md-right">{{ __('Valid') }}</label>

                                  <div class="col-md-3">
                                      <input id="statusValid" type="radio"  class="form-control icheckbox_flat-green" name="Status" value="valid" required autofocus>
                                  </div>

                                  <label for="status" class="col-md-3 col-form-label text-md-right">{{ __('Invalid') }}</label>

                                  <div class="col-md-3">
                                      <input id="statusInvalid" type="radio"  class="form-control icheckbox_flat-red" name="Status" value="Invalid" required autofocus>
                                  </div>
                              </div>


                              <div class="form-group row" id="InvalidityReason" hidden>
                                  <label class="col-md-4 col-form-label text-md-right">{{ __('Reason') }}</label>
                                  <div class="col-md-6">
                                      <textarea class="form-control" name="reasons"></textarea>
                                  </div>
                              </div>

                              <div class="form-group row col-md-9 float-right">
                                  <button class="btn btn-outline-info entypo-check"
                                          type="submit">{{__('Process')}}</button>
                              </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection