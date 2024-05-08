@php
$plansettings = App\Models\Utility::plansettings();
$users= App\Models\MasterCustomer::all();

@endphp
@extends('layouts.admin')
@section('page-title')
{{ __('Contact') }}
@endsection
@section('title')
{{ __('Contact') }}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
<li class="breadcrumb-item">{{ __('Contact') }}</li>
@endsection
@section('action-btn')
<!-- <a href="{{ route('contact.grid') }}" class="btn btn-sm btn-primary btn-icon m-1"
            data-bs-toggle="tooltip"title="{{ __('Grid View') }}">
            <i class="ti ti-layout-grid text-white"></i>
    </a> -->
@can('Create Contact')
<a href="#" data-url="{{ route('contracts.newtemplate') }}" data-size="lg" data-ajax-popup="true"
    data-bs-toggle="tooltip" data-title="{{__('Create New Template')}}" title="{{__('Create')}}"
    class="btn btn-sm btn-primary btn-icon m-1">
    <i class="ti ti-plus"></i>
</a>
@endcan
@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz p0">

                <div class="row">
                    <div class="col-lg-12 ">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">{{__('Name')}}</th>
                                                <th scope="col" class="sort">{{__('Status')}}</th>
                                                <th scope="col" class="sort">{{__('Created On')}}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($results as $result)
                                            @foreach($result as $res)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('contracts.detail',$res['id']) }}" data-size="md"
                                                        class="action-item text-primary"
                                                        style="color:#1551c9 !important;">
                                                        <b> {{ ucfirst(str_replace('[DEV] ', '', $res['name'])) }}</b>
                                                    </a>
                                                </td>
                                                <td><span class="budget">{{$res['status'] }}</span></td>
                                                <td>{{\Auth::user()->dateFormat($res['date_created'])}}</td>
                                            </tr>
                                            @endforeach
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

<script>
document.querySelector("#pc-daterangepicker-2").flatpickr({
    mode: "range"
});
</script>