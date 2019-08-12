<?php
/**
 * Created by PhpStorm.
 * User: Million
 * Date: 3/13/2019
 * Time: 11:55 PM
 */
?>
@extends('layouts.app')
@section('content')
    <div class="col-md-auto">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="container">
                    <div class="card-header">{{__('Process Payment')}}</div>

                    <div class="card-body" >


                            <div class="form-group row">
                                <label for="BankingResponse" class="col-md-4 col-form-label text-md-right">{{ __('Internet Banking Response') }}</label>

                                <div class="card-body col-lg-6">
                                    <div class="justify-content-center">
                                        <form method="POST" action="{{route('Process')}}"  enctype="multipart/form-data">
                                                 {{csrf_field()}}
                                                <div class="input-group">
                                                        <input type="file" class="form-control" name="csvFile"
                                                               accept=".csv"
                                                               required
                                                               id="BankingResponse">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-outline-primary entypo-upload">{{__('Upload')}}</button>
                                                    </div>
                                                </div>
                                            @if ($errors->has('csvFile'))
                                                <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $errors->first('csvFile') }}</strong>
                                                   </span>
                                            @endif
                                        </form>
                                    </div>

                                </div>
                            </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    @endsection
{{--, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"--}}