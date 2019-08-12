@extends('layouts.app')
@section('content')
    <div class="col-md-auto">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container">
                    <div class="card-header">{{__('Payment Information')}}</div>

                    <div class="card-body" >
                        <div class="container-fluid">
                            <table class="table table-responsive text-center">
                                <th>{{__('Customer Name')}}</th>
                                <th>{{__('Payment Type')}}</th>
                                <th>{{__('Account Number')}}</th>
                                <th>{{__('Payment Date')}}</th>
                                <th>{{__('Amount Paid')}}</th>
                                <th>{{__('Amount Left')}}</th>
                                <th>{{__('Status')}}</th>
                                @if (sizeof($payments)>0)
                                    @foreach($payments as $payment)

                                        <tr @if ($payment->status=='verified')
                                            style="background-color: #2ecc71"
                                        @else
                                            style="background-color: #e56c69"
                                        @endif>
                                            <td>{{$payment->Name.' '.$payment->FatherName.' '.$payment->GrandFatherName}}</td>
                                            <td>{{$payment->paymentType}}</td>
                                            <td>{{$payment->accountNumber}}</td>
                                            <td>{{$payment->paymentDate}}</td>
                                            <td>{{$payment->amountPaid}}</td>
											<td>{{$payment->amountExpected-$payment->amountPaid}}</td>
                                            <td>{{$payment->status}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection