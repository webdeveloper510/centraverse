@php
$plansettings = App\Models\Utility::plansettings();
@endphp
@extends('layouts.admin')
@section('page-title')
{{ __('Contracts') }}
@endsection
@section('title')
{{ __('Contracts') }}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
<li class="breadcrumb-item">{{ __('Contracts') }}</li>
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
    Create New Template
</a>
@endcan
@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">
    <div id="page-content-wrapper">
    <div class="container-fluid xyz p0">
        <div class="row">
            <div class="col-lg-12">
                <div id="useradd-1" class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <ul class="list-group" >   <li class="list-group-item list-group-header" style=" background: #dbe1e6;"><b> Use Templates</b></li></ul>
                            <ul class="list-group" style="display: grid; grid-template-columns: repeat(3, 1fr);">
                                <!-- <li class="list-group-item list-group-header" style=" background: #dbe1e6;"><b> Use Templates</b></li>
                                <li class="list-group-item list-group-header" style=" background: #dbe1e6;"></li>
                                <li class="list-group-item list-group-header" style=" background: #dbe1e6;"></li> -->
                                @foreach($results as $result)
                                    @foreach($result as $res)
                                        <li class="list-group-item list-item-style">
                                            <a href="{{ route('contracts.detail',$res['id']) }}" target="_blank" data-size="md"
                                                class="action-item text-primary" style="color:#1551c9 !important;">
                                                <b>{{ ucfirst(str_replace('[DEV] ', '', $res['name'])) }}</b>
                                            </a>
                                        </li>
                                    @endforeach
                                @endforeach
                            </ul>
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