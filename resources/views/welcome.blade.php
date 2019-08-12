@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">

                <div class="col-md-12 w-75 justify-content-center">
                    <div class="card">
                        <div class="card-body">
                            <div class="bd-example">
                                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="{{asset('adminLt/dist/img/cargoslider.jpg')}}" class="d-block w-100" alt="...">
                                            <div class="carousel-caption d-none d-md-block">
                                                {{--<h5></h5>--}}
                                                {{--<p>Ethiopian Cargo & Logistics Services Wins Best Cargo Airline –Africa Award from Air Cargo News</p>--}}
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{asset('adminLt/dist/img/award.jpg')}}" class="d-block w-100" alt="...">
                                            <div class="carousel-caption d-none d-md-block">
                                                {{--<h5></h5>--}}
                                                {{--<p>Ethiopian Inaugurates Airport Terminal Expansion and New Hotel</p>--}}
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{asset('adminLt/dist/img/plane.jpg')}}" class="d-block w-100" alt="...">
                                            <div class="carousel-caption d-none d-md-block">
                                                {{--<h5></h5>--}}
                                                {{--<p class="text-black">Ethiopian Wins ‘African Cargo Airline of the Year’ and ‘Air Cargo Brand of the Year in Africa’ Awards</p>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title entypo-newspaper">News letter    <span class="right badge badge-danger">New</span> </h5>

                            <p class="card-text">
                                Ethiopian Cargo & Logistics Services Wins Best Cargo Airline –Africa Award from Air Cargo News
                            </p>
                            {{--<a href="#" class="card-link">Card link</a>--}}
                            {{--<a href="#" class="card-link">Another link</a>--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title entypo-newspaper">News letter</h5>

                            <p class="card-text">
                                Ethiopian Inaugurates Airport Terminal Expansion and New Hotel
                            </p>
                            {{--<a href="#" class="card-link">Card link</a>--}}
                            {{--<a href="#" class="card-link">Another link</a>--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title entypo-newspaper">News letter</h5>

                            <p class="card-text ">
                                Ethiopian Cargo & Logistics Services Wins Best Cargo Airline –Africa Award from Air Cargo News
                            </p>
                            {{--<a href="#" class="card-link">Card link</a>--}}
                            {{--<a href="#" class="card-link">Another link</a>--}}
                        </div>
                    </div>
                </div>
        </div>

        </div>
    @endsection