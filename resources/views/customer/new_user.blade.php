@extends('layouts.admin')
@section('page-title')
{{ __('Customer') }}
@endsection
@section('title')
{{ __('Customer') }}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
<li class="breadcrumb-item">{{ __('Customer') }}</li>
@endsection
@section('action-btn')
<a href="#" data-url="{{ route('uploadusersinfo') }}" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{__('Upload User')}}" title="{{__('Upload')}}" class="btn btn-sm btn-primary btn-icon m-1">
    <i class="ti ti-plus"></i>
</a>
@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
                    <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="ti ti-users"></i></span>
                        <span class="dash-mtext">{{ __('Customer List') }} </span></a>

                    </a>
                </div>
            </div>
        </div>
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
                                                <th scope="col" class="sort">{{__('Organization')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td><span>{{ucfirst($user->name)}}</span></td>
                                                <td><span>{{ucfirst($user->email)}}</span></td>
                                                <td><span>{{ucfirst($user->phone)}}</span></td>
                                                <td><span>{{ucfirst($user->address)}}</span></td>
                                                <td><span>{{ucfirst($user->organization)}}</span></td>
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