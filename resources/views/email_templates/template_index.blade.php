@extends('layouts.admin')
@section('page-title')
    {{__('Lead')}}
@endsection
@section('title')
        <div class="page-header-title">
            {{__('Email Templates')}}
        </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item">{{__('Email Templates')}}</li>
@endsection
@section('action-btn')
    @can('Create Lead')
        <a href="#" data-url="" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{__('Create New Lead')}}"title="{{__('Create')}}" class="btn btn-sm btn-primary btn-icon m-1">
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
                                <th scope="col" class="sort" data-sort="name">{{__('Email Template')}}</th>
                                <th scope="col" class="sort" data-sort="name">{{__('Title')}}</th>
                                <th scope="col" class="text-end">{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>
                                        <span class="budget"><b>aa</b></span>
                                    </td>
                                    <td>
                                       aa
                                    </td>
                                        <div class="action-btn bg-danger ms-2">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['lead.destroy', $lead->id]]) !!}
                                            <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                <i class="ti ti-trash"></i>
                                            </a>
                                            {!! Form::close() !!}
                                        </div>
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