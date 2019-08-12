<?php
/**
 * Created by PhpStorm.
 * User: Million
 * Date: 3/13/2019
 * Time: 7:16 PM
 */
?>

<section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{Auth::user()->userImage==null ?  asset('adminLt/dist/img/user2-160x160.jpg') :  Auth::user()->userImage }}" width="260" height="260"
                 class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{Auth::user()->firstName." ".Auth::user()->middleName}}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item"><a class="nav-link" href="{{route('ForwarderDashboard')}}"><i class="nav-icon fa fa-dashboard"></i> <p>Dashboard</p></a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('ForwarderShipment')}}"><i class="nav-icon entypo-box"></i> <p>shipment</p></a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('ForwarderPayment')}}"><i class="nav-icon fa fa-money"></i> <p>Process Payment</p></a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('FlightSchedule')}}"><i class="nav-icon entypo-calendar"></i> <p>Cargo Schedule</p></a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('ForwarderClaims')}}"><i class="nav-icon fa fa-file-text"></i> <p>Claims</p></a></li>

        @if (Auth::user()->employee()->value('position')=='ForwarderAdmin')
            <li class="nav-item"><a class="nav-link" href="{{route('AddForwarderEmployee')}}"><i class="nav-icon entypo-user"></i> <span>Employee</span></a></li>
        @endif

    </ul>
    <!-- /.sidebar-menu -->
</section>
