@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach ($claims as $claim)
                <div class="content col-md-4">

                    <!-- small box -->
                    <div class="card bg-info">
                        <div class="card-body">
                            <h3 class="card-text text-capitalize">Claimer Name:{{$claim->claimersName}}</h3>
                            <p class="card-text"> AWB:{{$claim->AWB}}</p>
                            <p class="card-text">Irregularity:{{$claim->irregularity}}</p>
                            <p class="card-text">Estimated Value:{{$claim->estimatedValue}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <button class="btn btn-warning small-box-footer text-center"
                                data-claimid='{!! $claim->id !!}'
                                data-claimersname='{!! $claim->claimersName !!}'
                                data-claimersaddress='{!! $claim->claimersAddress!!}'
                                data-claimersphone='{!! $claim->claimersPhone!!}'
                                data-claimersemail='{!! $claim->claimersEmail!!}'
                                data-awb='{!! $claim->AWB!!}'
                                data-flightno='{!! $claim->flightNo !!}'
                                data-literaryairline='{!! $claim->literaryAirline !!}'
                                data-irregularity='{!! $claim->irregularity!!}'
                                data-remark='{!! $claim->remark !!}'
                                data-estimatedvalue='{!! $claim->estimatedValue!!}'
                                data-contentdescription='{!! $claim->contentDescription!!}'
                                data-toggle="modal" data-target="#claimModalCenter">
                            {{__(' More Info ')}}<i class="entypo-right-bold"></i></button>
                    </div>

                </div>


            @endforeach
        </div>
    </div>
    <button class="btn btn-link">{{$claims->links("pagination::bootstrap-4")}}</button>


    {{--claims model--}}
    <div class="modal fade" id="claimModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">{{__('Claims Detail')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('SettleClaims')}}">
               {{csrf_field()}}
                <div class="modal-body">
                     {{--<label>{{__('Claimers Name')}}</label>--}}
                    {{--<input class="form-control" id="claimerName" value="">--}}

                    <input hidden name="claimId" id="claim_ID" value="">

                    <label>{{__('Claimers Address')}}</label>
                    <input class="form-control" id="claimerAddress" value="">

                    <label>{{__('Claimers Phone')}}</label>
                    <input class="form-control" id="claimerPhone" value="">

                    <label>{{__('Claimers Email')}}</label>
                    <input class="form-control" id="claimerEmail" value="">

                    {{--<label>{{__('AWB')}}</label>--}}
                    {{--<input class="form-control" id="AWB" value="">--}}

                    <label>{{__('Flight Number')}}</label>
                    <input class="form-control" id="flightNo" value="">

                    <label>{{__('Literary Airline')}}</label>
                    <input class="form-control" id="literaryAirline" value="">

                    {{--<label>{{__('Irregularity')}}</label>--}}
                    {{--<input class="form-control" id="irregularity" value="">--}}

                    <label>{{__('Remark')}}</label>
                    <input class="form-control" id="remark" value="">

                    <label>{{__('contentDescription')}}</label>
                    <input class="form-control" id="contentDescription" value="">

                    {{--<label>{{__('Estimated Value')}}</label>--}}
                    {{--<input class="form-control" id="estimatedValue" value="">--}}


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-info">{{__('Settled')}}</button>
                </div>

                </form>

            </div>
        </div>
    </div>

    @endsection