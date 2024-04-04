@extends('layouts.admin')
@section('page-title')
{{__('Customers')}}
@endsection
@section('title')
<div class="page-header-title">
    {{__('Customers')}}
</div>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
<li class="breadcrumb-item">{{__('All Customers')}}</li>
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
                                                <!-- <th scope="col" class="sort" data-sort="name">{{__('Lead')}}</th> -->
                                                <th scope="col" class="sort" data-sort="name">{{__('Name')}}</th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Email')}}</th>
                                                <th scope="col" class="sort">{{__('Phone')}}</th>
                                                <th scope="col" class="sort">{{__('Address')}}</th>            
                                                <th scope="col" class="sort">{{__('Category')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($allcustomers as $customers)
                                            <tr>
                                                <td>{{ucfirst($customers->name)}}</td>
                                                <td>{{ucfirst($customers->email)}}</td>
                                                <td>{{ucfirst($customers->phone)}}</td>
                                                <td>{{ucfirst($customers->address)}}</td>
                                                <td>{{ucfirst($customers->category)}}</td>
                                            </tr>
                                            @endforeach
                                            @foreach($importedcustomers as $customers)
                                            <tr>
                                                <td>{{ucfirst($customers->name)}}</td>
                                                <td>{{ucfirst($customers->email)}}</td>
                                                <td>{{ucfirst($customers->phone)}}</td>
                                                <td>{{ucfirst($customers->address)}}</td>
                                                <td>{{ucfirst($customers->category)}}</td>
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