@extends('layouts.admin')
@section('page-title')
{{ __('Event Customers') }}
@endsection
@section('title')
{{ __('Event Customers') }}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
<li class="breadcrumb-item"><a href="{{ route('siteusers') }}">{{ __('Customers') }}</a></li>
<li class="breadcrumb-item">{{ __('Event Customers') }}</li>
@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">

        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">{{__('Name')}}</th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Email')}}</th>
                                                <th scope="col" class="sort">{{__('Phone')}}</th>
                                                 <th scope="col" class="sort">{{__('Address')}}</th>
                                                <th scope="col" class="sort">{{__('Category')}}</th> 
                                                <!-- <th scope="col" class="sort">{{__('Organization')}}</th> -->
                                                <!-- <th scope="col" class="sort">{{__('Actions')}}</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($eventcustomers as $user)
                                            <tr>
                                            <td> <a href="{{route('event.userinfo',urlencode(encrypt($user->id)))}}" 
                                            title="{{ __('User Details') }}"
                                                        class="action-item text-primary"
                                                        style="color:#1551c9 !important;">
                                                        <b> {{ ucfirst($user->name) }}</b>
                                                    </a></td>
                                                <!-- <td><span>{{ucfirst($user->name)}}</span></td> -->
                                                <td><span>{{$user->email}}</span></td>
                                                <td><span>{{$user->phone}}</span></td>
                                                <td><span>{{$user->lead_address}}</span></td>
                                                <td><span>{{$user->type}}</span></td>
                                                <td>
                                               
                                            </td>
                                                <!-- <td><span>{{ucfirst($user->organization)}}</span></td> -->
                                                <!-- <td>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" data-url="{{ route('lead.create',['lead',0]) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white " id="{{ $user->id }}" onclick="storeIdInLocalStorage(this)" data-bs-toggle="tooltip" title="{{__('Convert Lead')}}" data-ajax-popup="true" data-title="{{__('Create Lead')}}"><i class="fas fa-exchange-alt"></i></a>
                                                    </div>
                                                </td> -->
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script-page')
<script>
    function storeIdInLocalStorage(link) {
        var id = link.id;
        localStorage.setItem('clickedLinkId', id);
    }
</script>
@endpush