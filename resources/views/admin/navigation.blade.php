<?php
/**
 * Created by PhpStorm.
 * User: Million
 * Date: 3/13/2019
 * Time: 7:16 PM
 */
?>

<section class="sidebar">

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
    <li class="nav-item"><a class="nav-link" href="{{route('AdminDashboard')}}"><i class="nav-icon fa fa-dashboard"></i> <span>Dashboard</span></a></li>

    <li class="nav-item has-treeview menu-open">

        <a href="#" class="nav-link bg-white">
            <i class="nav-icon fa fa-truck"></i>
            <p>
                Deliverer
                <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('AdminDeliverer')}}" class="nav-link">
                    <i class="entypo-user-add nav-icon"></i>
                    <p>Register Deliverer</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('AdminDelivererList')}}" class="nav-link">
                    <i class="fa fa-edit nav-icon"></i>
                    <p>Edit Deliverer</p>
                </a>
            </li>
        </ul>
    </li>


    <li class="nav-item has-treeview menu-open">

        <a href="#" class="nav-link bg-light">
            <i class="nav-icon fa fa-plane"></i>
            <p>
                Forwarder
                <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('AdminForwarder')}}" class="nav-link">
                    <i class="entypo-user-add nav-icon"></i>
                    <p>Register Forwarder</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('AdminForwarderList')}}" class="nav-link">
                    <i class="fa fa-edit nav-icon"></i>
                    <p>Edit Forwarder</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item"><a class="nav-link" href="{{route('AdminEmployee')}}"><i class="nav-icon entypo-user"></i> <span>Employee</span></a></li>
</ul>
<!-- /.sidebar-menu -->
</section>