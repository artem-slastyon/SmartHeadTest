@php use App\Enums\DashboardTab; @endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @role('admin')
            <ul class="nav nav-tabs" id="dashboardTab">
                <li class="nav-item">
                    <a class="nav-link{{$tab === DashboardTab::TICKETS ? ' active disabled' : ''}}" aria-current="page"
                       href="{{ url('/tickets') }}">Tickets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{$tab === DashboardTab::USERS ? ' active disabled' : ''}}" aria-current="page"
                       href="{{ url('/users') }}">Users</a>
                </li>
            </ul>
            @endrole

            <div class="tab-content">
                {{ $slot }}
            </div>
        </div>
@endsection
