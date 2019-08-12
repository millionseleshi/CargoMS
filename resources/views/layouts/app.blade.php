<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{env('APP_NAME')}}</title>

    @include('layouts.styles')
{{csrf_field()}}

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini wrapper">



    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">

        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('home')}}" class="nav-link">Home</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-sm-auto">

            @guest()

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif

            @else()
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge badge-warning navbar-badge">{{Auth::user()->notifications()->count()}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">{{Auth::user()->notifications()->count()}} Notifications</span>
                        <div class="dropdown-divider"></div>


                        @if (session('status'))
                            <a href="#" class="dropdown-item">
                                <i class="fa fa-envelope mr-md-auto"></i>
                                {{__(session()->get('status'))}}
                                <span class="float-right text-muted text-sm">1 mins</span>
                            </a>

                       @endif

                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->userName }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right bg-light" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('EditProfileView')}}">{{__('Edit Profile')}}</a>

                        @auth()

                            @if(Auth::user()->role=='customer')
                        @if(!session()->has('locale'))
                        <a class="dropdown-item" href="{{route('Amharic','amh')}}">{{__('Amharic')}}</a>
                        @endif
                        @if(session()->has('locale'))
                        <a class="dropdown-item" href="{{route('English')}}">{{__('English')}}</a>
                        @endif
                                @endif

                        @endauth

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>

            @endguest


        </ul>


    </nav>



    <aside class="main-sidebar sidebar-light-warning elevation-4">

        <a href="{{route('home')}}" class="brand-link bg-warning" >
            <img src="{{asset('adminLt/dist/img/logoshort.jpg')}}"  alt="EACSSLogo"
                 class="brand-image img-circle"
                 style="opacity: .9;">
            <span class="brand-text font-weight-light">EACSS</span>
        </a>



        <div class="sidebar">


        @auth()

                <nav class="mt-2">

                    @if (Auth::user()->role==="admin")
                        @include('admin.navigation')
                    @endif

                    @if (Auth::user()->role==='customer')
                        @include('customer.navigation')
                    @endif

                    @if (Auth::user()->role==='Femployee')
                        @include('forwarder.navigation')
                    @endif

                    @if (Auth::user()->role==='Demployee')
                        @include('deliverer.navigation')
                    @endif

                </nav>
        @endauth

            @guest()
                @include('customer.navigation')
                @endguest

        </div>

    </aside>



    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-auto">
                    <div class="col-md-12">
                        @if (session('status'))
                        <p class="bg-success text-lg-center"><span class="fa fa-envelope"></span>
                                {{__(session()->get('status'))}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>



        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <main class="container-fluid">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>

    </div>



    <footer class="main-footer">

        <div class="row">


            @auth()
            @if (Auth::user()->role=='customer')

            <div class="col-md-4">
                <div class="card">
                    <div class="card-text">
                            <ul class="list-inline">
                                <li> <a class="btn btn-link " href="{{ route('sendshipment') }}">{{ __('Send Shipment') }}</a></li>
                                <li>  <a class="btn btn-link" href="{{ route('receiveshipment') }}">{{ __('Receive Shipment') }}</a></li>
                                <li> <a class="btn btn-link" href="{{ route('sendclaims') }}">{{ __('Claims Form') }}</a></li>
                            </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                        <div class="card">
                            <ul class="card-text">
                                <li class="text-black-opacity-05">Every kilo is chargeable and minimum weight is 1kg</li>
                                <li  class="text-black-opacity-05">From midnight 00:01 minutes to midnight 24:00 hours will be considered as one day</li>
                                <li  class="text-black-opacity-05">Any load that arrives between these hours should be charged as one full day</li>
                                <li  class="text-black-opacity-05">There are no exemptions for holidays</li>
                                <li class="text-black-opacity-05">Working hours are from 6:00AM to 10:00PM local time from Monday to Sunday</li>
                            </ul>
                        </div>
                    </div>

            <div class="col-md-4">
                        <div class="card">
                            <div class="card-text">
                                <a class="btn btn-link entypo-facebook-circled" href="https://www.facebook.com/EthiopianAirlines/">Facebook</a>
                                <a class="btn btn-link entypo-twitter-circled" href="https://twitter.com/flyethiopian">Twitter</a>
                                <a class="btn btn-link fa fa-google-plus-circle" href="https://plus.google.com/+ethiopianairlinescom"> Google</a>
                            </div>

                        </div>
                    </div>

            @endif
            @endauth

        </div>


        <div class="float-right d-none d-sm-inline">
           {{__('Powered by Liq Technologies')}}
        </div>

        <strong>Copyright &copy; {{date('Y')}} <a href="#">EACSS</a>.</strong> All rights reserved.
    </footer>



@include('layouts.scripts')

</body>
</html>