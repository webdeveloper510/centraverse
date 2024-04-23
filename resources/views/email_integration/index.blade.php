@extends('layouts.admin')
@section('page-title')
{{__('Emails')}}
@endsection
@section('title')
<div class="page-header-title">
    {{__('Emails')}}
</div>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
<li class="breadcrumb-item">{{__('Emails')}}</li>
@endsection
@section('action-btn')

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
                                                <th scope="col" class="sort" data-sort="name">{{__('Type')}}</th>

                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($leads as $lead)
                                            <tr>
                                                <td>{{ucfirst($lead->name)}}</td>
                                                <td>{{ucfirst($lead->type)}}</td>
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