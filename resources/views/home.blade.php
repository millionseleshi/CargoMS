{{--@extends('layouts.app')--}}

@if (Auth::user()->role==="admin")
    @include('admin.dashboard')
@endif

@if (Auth::user()->role==='customer')
    @include('customer.dashboard')
@endif

@if (Auth::user()->role==='Femployee')
    @include('forwarder.dashboard')
@endif
@if (Auth::user()->role==='Demployee')
    @include('deliverer.dashboard')
@endif

