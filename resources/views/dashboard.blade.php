@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <ul class="nav nav-tabs" id="dashboardTab">
                <li class="nav-item">
                    <a class="nav-link{{$tab === 'tickets' ? ' active disabled' : ''}}" aria-current="page"
                       href="{{url()->query('/', ['tab' => 'tickets'])}}">Tickets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{$tab === 'users' ? ' active disabled' : ''}}" aria-current="page"
                       href="{{url()->query('/', ['tab' => 'users'])}}">Users</a>
                </li>
            </ul>

            <div class="tab-content">
               <x-tickets-table
                   :tickets="$tickets"
                   :email-filter="$email"
                   :phone-filter="$phone"
                   :status-filter="$status"
                   :date-from="$dateFrom"
                   :date-to="$dateTo"
               />
            </div>
        </div>
@endsection
