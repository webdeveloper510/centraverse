@extends('layouts.admin')
@section('page-title')
    {{__('Campaign')}}
@endsection
@section('title')
    <div class="page-header-title">
        {{__('Campaign')}}
    </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item">{{__('View Campaigns')}}</li>
@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
                    
                        <a href="{{route('campaign-list')}}" class="list-group-item list-group-item-action">
                        <span class="fa-stack fa-lg pull-left"><i class="ti ti-eye"></i></span>
                        <span class="dash-mtext">{{ __('View Campaigns') }} </span></a>
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
                                                <th scope="col" class="sort" data-sort="name">{{__('Title')}}</th>
                                                <th scope="col" class="sort" data-sort="name">{{__('Type')}}</th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Created At')}}</th>
                                                <th scope="col" class="sort">{{__('Due date')}}</th>
                                                <th scope="col" class="sort">{{__('Action')}}</th>                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($campaignlist as $campaign)
                                            <tr>
                                                <td>
                                                    <span class="budget"><b>{{ucfirst($campaign->title)}}</b></span>
                                                </td>
                                                <td>
                                                <span class="budget"><b>{{ucfirst($campaign->type)}}</b></span>
                                                </td>
                                                <td>
                                                    <span class="budget">{{ucfirst($campaign->created_at)}}</span>
                                                </td>
                                                <td><span class="col-sm-12"><span class="text-sm"></span></span></td>
                                                <td></td>
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