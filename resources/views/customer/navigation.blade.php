<?php
/**
 * Created by PhpStorm.
 * User: Million
 * Date: 3/13/2019
 * Time: 6:18 PM
 */
?>

<section class="sidebar">

@auth()
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{Auth::user()->userImage==null ?  asset('adminLt/dist/img/user2-160x160.jpg') :  Auth::user()->userImage }}" width="260" height="260"
                 class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{Auth::user()->firstName." ".Auth::user()->middleName}}</a>
        </div>
    </div>
        @endauth

    <!-- Sidebar Menu -->
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item"><a class="nav-link" href="{{route('customerdashboard')}}" ><i class="nav-icon fa fa-dashboard"></i><p>{{__('Dashboard')}}</p></a></li>
        <li class="nav-item"><a class="nav-link"href="{{route('sendshipment')}}" ><i class="nav-icon fa fa-send"></i><p>{{__('Send Shipment')}}</p></a></li>
       @auth() <li class="nav-item"><a class="nav-link" href="{{route('receiveshipment')}}"><i class="nav-icon fa fa-truck"></i> <p>{{__('Receive Shipment')}}</p></a></li> @endauth
        <li class="nav-item"><a class="nav-link" href="{{route('terminalcharge')}}"><i class="nav-icon fa fa-calculator"></i> <p>{{__('Terminal Charge')}}</p></a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('checkshipment')}}"><i class="nav-icon fa fa-check"></i> <p>{{__('Check Shipment')}}</p></a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('cargosechedule')}}"><i class="nav-icon fa fa-calendar"></i> <p>{{__('Cargo Schedule')}}</p></a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('sendclaims')}}"><i class="nav-icon fa fa-file"></i> <p>{{__('Claims Form')}}</p></a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('cargoloadable')}}"><i class="nav-icon fa fa-question-circle"></i> <p>{{__('Cargo Loadable')}}</p></a></li>
    </ul>
    <!-- /.sidebar-menu -->
</section>
