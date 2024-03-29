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
<a href="{{ route('exportuser') }}" data-bs-toggle="tooltip" data-title="{{__('Export User')}}" title="{{__('Export')}}" class="btn btn-sm btn-primary btn-icon m-1">
    <i class="ti ti-table-export"></i>
</a>
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
                                                <th scope="col" class="sort">{{__('Category')}}</th>
                                                <th scope="col" class="sort">{{__('Status')}}</th>
                                                <!-- <th scope="col" class="sort">{{__('Organization')}}</th> -->
                                                <th scope="col" class="sort">{{__('Actions')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td><span>{{ucfirst($user->name)}}</span></td>
                                                <td><span>{{$user->email}}</span></td>
                                                <td><span>{{$user->phone}}</span></td>
                                                <td><span>{{ucfirst($user->category)}}</span></td>
                                                <!-- <td><span>{{ucfirst($user->address)}}</span></td> -->
                                                <td>
                                                @if ($user->status == 0)
                                                    <span
                                                        class="badge bg-success p-2 px-3 rounded">{{App\Models\UserImport::$status[$user->status]}}</span>
                                                @else
                                                    <span
                                                        class="badge bg-danger p-2 px-3 rounded">{{App\Models\UserImport::$status[$user->status]}}</span>
                                                @endif
                                            </td>
                                                <!-- <td><span>{{ucfirst($user->organization)}}</span></td> -->
                                                <td>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" data-url="{{ route('lead.create',['lead',0]) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white " id="{{ $user->id }}" onclick="storeIdInLocalStorage(this)" data-bs-toggle="tooltip" title="{{__('Convert Lead')}}" data-ajax-popup="true" data-title="{{__('Create Lead')}}"><i class="fas fa-exchange-alt"></i></a>
                                                    </div>
                                                </td>
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