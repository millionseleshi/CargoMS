@extends('layouts.app')
@section('content')
    <div class="col-md-auto">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container">
                    <div class="card-header">Edit Deliverer</div>

                        {{ csrf_field() }}


                        <div class="card-body container-fluid">
                            <table class="table table-striped table-responsive" id="delivererTable">
                                <thead>
                                <th>{{__('Company Name')}}</th>
                                <th>{{__('Phone Number')}}</th>
                                <th>{{__('Alt PhoneNumber')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Address')}}</th>
                                <th>{{__('DeliveryPrice')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>

                                @foreach($delivererAll as $item)
                                    <tr class="">
                                    <td>{{$item->organization->companyName}}</td>
                                    <td>{{$item->organization->phoneNumber}}</td>
                                    <td>{{$item->organization->AlternatePhoneNumber}}</td>
                                    <td>{{$item->organization->email}}</td>
                                    <td>{{$item->organization->address}}</td>
                                    <td>{{$item->deliveryPrice}}</td>
                                        <td>
                                            <button type="button" class="btn btn-outline-info fa fa-edit"

                                                    data-iddeliverer="{{$item->organization->id}}"
                                                    data-companyname="{{$item->organization->companyName}}"
                                                    data-phonenumber="{{$item->organization->phoneNumber}}"
                                                    data-alternatephonenumber="{{$item->organization->AlternatePhoneNumber}}"
                                                    data-email="{{$item->organization->email}}"
                                                    data-address="{{$item->organization->address}}"
                                                    data-about="{{$item->organization->about}}"
                                                    data-deliveryprice="{{$item->deliveryPrice}}"

                                                    data-toggle="modal" data-target="#editModal">
                                                {{__('Edit')}}
                                            </button>

                                            <button type="button" class="btn btn-outline-danger entypo-trash" data-iddeliverer="{{$item->id}}" data-toggle="modal" data-target="#deleteModal">
                                              {{__('Delete')}}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                </div>
            </div>
        </div>
    </div>


    <!--Delete Model-->

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-secondary-gradient">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('Delete Confirmation')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form method="POST" action="{{route('DeleteDeliverer')}}">
            {{method_field('delete')}}
            {{csrf_field()}}
      <div class="modal-body">
        <input id="orgId" value="" name="delivererId" hidden>
          <p class="text-center text-capitalize"> {{__('Are You Sure You Want to Delete this Deliverer??')}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('No,Cancel')}}</button>
        <button type="submit" class="btn btn-danger">{{__('Yes,Delete')}}</button>
      </div>

        </form>
    </div>
  </div>
</div>

    <!--Edit Modal-->

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-gray-light-gradient">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{__("Edit Deliverer")}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('EditDeliverer')}}" method="POST" >
                    {{method_field('put')}}
                    {{csrf_field()}}
                <div class="modal-body">
                    <input id="orgId" value="" name="delivererId" hidden>

                    @include('admin.deliverermodal')

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('No,Cancel')}}</button>
                    <button class="btn btn-success btn-outline-info fa fa-upload" type="submit">{{__('Yes,Update')}}</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @endsection

