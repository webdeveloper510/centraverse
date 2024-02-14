@extends('layouts.admin')
@section('page-title')
    {{__('Billing')}}
@endsection
@section('title')
        <div class="page-header-title">
            {{__('Billing')}}
        </div>
@endsection
@section('action-btn')
@endsection
@section('filter')
@endsection
@php
$labels =
    [ 
        'venue_rental' => 'Venue Rental',
        'hotel_rooms'=>'Hotel Rooms',
        'equipment'=>'Tent, Tables, Chairs, AV Equipment',
        'setup' =>'Setup',
        'gold_2hrs'=>'Bar Package',
        'special_req' =>'Special Requests /Other',
        'classic_brunch'=>'Brunch/Lunch/Dinner Package',
    ]; 
@endphp 
@section('content')
<div class="container-field">
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
                    <a href="#useradd-1" class="list-group-item list-group-item-action">
                        <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                        <span class="dash-mtext">{{ __('Create Billing') }} </span></a>
                </div>
            </div>
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                    {{Form::open(array('url'=>'billing','method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))}}
                    <div class = "col-md-12" id = "useradd-1" >
                        <div class="form-group">
                            <label class="form-label">Select Customer :</label>
                            <select class="form-select" id = "userinfo" name = "event" required>
                                <option value= '-1' disabled selected>Select Customer</option>
                                @foreach($meeting as $meet)
                                    <option value="{{$meet->id}}">{{$meet->name}} (Event- {{$meet->type}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
               
                    <div class = "col-md-12">
                        <div class = "form-group">
                        <label>No. of Guests : </label>
                        <input type ="text"  value = "" readonly name ="guestcount" style = "border:none" >
                    </div>                  
               
                    <div class="col-md-12">
                            <div class="form-group">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{__('Description')}} </th>
                                            <th>{{__('Cost')}} </th>
                                            <th>{{__('Quantity')}} </th>
                                            <th>{{__('Notes')}} </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($labels as $key=> $label)
                                            <tr>
                                                <td>{{ucfirst($label)}}</td>
                                                <td>
                                                <input type = "text" name ="billing[{{$key}}][cost]" value="${{$billing->$key}}" class= "form-control" readonly></td>
                                                <td> 
                                                <input type = "number" name ="billing[{{$key}}][quantity]" min = '0' class= "form-control" required>
                                                </td>
                                                <td><input type = "text" name ="billing[{{$key}}][notes]" class= "form-control"></td> 
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class= "form-group">
                                <label class = "form-label"> Deposit on file: </label>
                                <input type = "number" name = "deposits" min = '0'  class= "form-control" required>
                                </div>
                        </div>
                    </div>
                {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
                {{ Form::close() }}    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
@push('script-page')
<script>
    $('select[name= "event"]').on('change', function() {
        var id = this.value ;
        $.ajax({
            url: "{{ route('billing.eventdetail') }}",
            type: 'POST',
            data: {
                "id": id,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                $('input[name ="guestcount"]').val(data[0].guest_count);
                $('input[name ="billing[venue_rental][notes]"]').val(data[0].venue_selection);
                $('input[name ="billing[hotel_rooms][quantity]"]').val(data[0].room);
                $('input[name ="billing[gold_2hrs][notes]"]').val(data[0].bar);
                $('input[name ="billing[special_req][notes]"]').val(data[0].spcl_request);
                $('input[name ="billing[classic_brunch][notes]"]').val(data[0].function +','+ data[0].func_package);
                $('input[name ="billing[hotel_rooms][quantity]"]').attr('readonly', true);
                $('input[name ="billing[venue_rental][notes]"]').attr('readonly', true);
                $('input[name ="billing[gold_2hrs][notes]"]').attr('readonly', true);
                $('input[name ="billing[classic_brunch][notes]"]').attr('readonly', true);
            }
        });          
    });
</script>
@endpush