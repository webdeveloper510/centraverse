@extends('layouts.admin')
@section('page-title')
    {{__('Lead')}}
@endsection
@section('title')
        <div class="page-header-title">
            {{__('Lead')}}
        </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item">{{__('Lead')}}</li>
@endsection
@section('action-btn')
    @can('Create Lead')
        <a href="#" data-url="{{ route('lead.create',['lead',0]) }}" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{__('Create New Lead')}}"title="{{__('Create')}}" class="btn btn-sm btn-primary btn-icon m-1">
            <i class="ti ti-plus"></i>
        </a>
    @endcan
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable" id="datatable">
                        <thead>
                            <tr>
                                <th scope="col" class="sort" data-sort="name">{{__('Lead')}}</th>
                                <th scope="col" class="sort" data-sort="name">{{__('Name')}}</th>
                                <th scope="col" class="sort" data-sort="budget">{{__('Email')}}</th>
                                <!-- <th scope="col" class="sort" >{{__('Phone')}}</th> -->
                                <th scope="col" class="sort">{{__('Assigned Staff')}}</th>
                                <th scope="col" class="sort">{{__('Proposal Status')}}</th>
                                <th scope="col" class="sort">{{__('Admin Approval')}}</th>
                                @if(Gate::check('Show Lead') || Gate::check('Edit Lead') || Gate::check('Delete Lead'))
                                    <th scope="col" class="text-end">{{__('Action')}}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($leads as $lead)
                                <tr>
                                    <td>
                                        <span class="budget"><b>{{ ucfirst($lead->leadname) }}</b></span>
                                    </td>
                                    <td>
                                        <a href="{{ route('lead.edit',$lead->id) }}" data-size="md" data-title="{{__('Lead Details')}}" class="action-item text-primary">
                                            {{ ucfirst($lead->name) }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="budget">{{ $lead->email }}</span>
                                    </td>
                                    <!-- <td>
                                        <span class="budget">
                                            {{ $lead->phone }}
                                        </span>
                                    </td> -->
                                    <td>
                                        <span class="col-sm-12"><span class="text-sm">{{ ucfirst(!empty($lead->assign_user)?$lead->assign_user->name:'')}} ({{$lead->assign_user->type}})</span></span>
                                    </td>
                                    <td>
                                        @if($lead->proposal_status == 0)
                                            <span class="badge bg-info p-2 px-3 rounded">{{ __(\App\Models\Lead::$status[$lead->proposal_status]) }}</span>
                                        @elseif($lead->proposal_status == 1)
                                            <span class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Lead::$status[$lead->proposal_status]) }}</span>
                                        @elseif($lead->proposal_status == 2)
                                            <span class="badge bg-success p-2 px-3 rounded" >{{ __(\App\Models\Lead::$status[$lead->proposal_status]) }}</span>
                                        @elseif($lead->proposal_status == 3)
                                            <span class="badge bg-danger p-2 px-3 rounded" >{{ __(\App\Models\Lead::$status[$lead->proposal_status]) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($lead->status == 0)
                                            <span class="badge bg-info p-2 px-3 rounded">{{ __(\App\Models\Lead::$lead_status[$lead->status]) }}</span>
                                        @elseif($lead->status == 1)
                                            <span class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Lead::$lead_status[$lead->status]) }}</span>
                                        @elseif($lead->status == 2)
                                            <span class="badge bg-success p-2 px-3 rounded">{{ __(\App\Models\Lead::$lead_status[$lead->status]) }}</span>
                                        @elseif($lead->status == 3)
                                            <span class="badge bg-primary p-2 px-3 rounded">{{ __(\App\Models\Lead::$lead_status[$lead->status]) }}</span>
                                        @endif
                                    </td>
                                    @if(Gate::check('Show Lead') || Gate::check('Edit Lead') || Gate::check('Delete Lead'))
                                        <td class="text-end">
                                            @if($lead->proposal_status == 0 )
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-size="md"
                                                        data-url="{{ route('lead.shareproposal',urlencode(encrypt($lead->id))) }}"
                                                        data-ajax-popup="true" data-bs-toggle="tooltip"
                                                        data-title="{{ __('Proposal') }}"title="{{ __('Share Proposal') }}"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                        <i class="ti ti-share"></i>
                                                    </a>
                                                </div>
                                            @elseif($lead->proposal_status == 1)
                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-size="md"
                                                        data-title="{{ __('Proposal') }}"title="{{ __('Proposal Sent') }}"
                                                        data-bs-toggle="tooltip"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                        <i class="ti ti-clock"></i>
                                                    </a>
                                                </div>
                                            @elseif($lead->proposal_status == 2)
                                                <!-- <div class="action-btn bg-primary ms-2">
                                                    <a href="#" data-size="md"
                                                        data-title="{{ __('Proposal') }}"title="{{ __('Review Proposal') }}"
                                                        data-bs-toggle="tooltip"  data-ajax-popup="true"
                                                        data-url="{{ route('lead.review',urlencode(encrypt($lead->id))) }}"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </div> -->
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="{{route('lead.review',urlencode(encrypt($lead->id))) }}" 
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white "
                                                     data-bs-toggle="tooltip"title="{{__('Review')}}" data-title="{{__('Review Lead')}}">
                                                 <i class="fas fa-pen"></i></a>
                                            </div>
                                            @endif
                                            <div class="action-btn bg-success ms-2">
                                                <a href="{{route('lead.proposal',urlencode(encrypt($lead->id))) }}" 
                                                data-bs-toggle="tooltip"
                                                    data-title="{{__('Proposal')}}"title="{{__('View Proposal')}}" 
                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                    <i class="ti ti-receipt"></i>
                                                </a>
                                            </div>
                                            @can('Show Lead')
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="#" data-size="md" data-url="{{ route('lead.show',$lead->id) }}"
                                                data-bs-toggle="tooltip" title="{{__('Quick View')}}"
                                                data-ajax-popup="true" data-title="{{__('Lead Details')}}" 
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                            </div>
                                            @endcan
                                            @can('Edit Lead')
                                            <div class="action-btn bg-info ms-2">
                                                <a href="{{ route('lead.edit',$lead->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white " data-bs-toggle="tooltip"title="{{__('Details')}}" data-title="{{__('Edit Lead')}}"><i class="ti ti-edit"></i></a>
                                            </div>
                                            @endcan
                                            @can('Delete Lead')
                                            <div class="action-btn bg-danger ms-2">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['lead.destroy', $lead->id]]) !!}
                                                <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                                {!! Form::close() !!}
                                            </div>
                                            @endcan
                                        </td>
                                    @endif
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection