@extends('layouts.admin')
@section('page-title')
{{ __('Event Create') }}
@endsection
@section('title')
{{ __('Create Event') }}
@endsection
@php

$plansettings = App\Models\Utility::plansettings();
$setting = App\Models\Utility::settings();
$type_arr= explode(',',$setting['event_type']);
$type_arr = array_combine($type_arr, $type_arr);
$venue = explode(',',$setting['venue']);
$function = explode(',',$setting['function']);
$meal = ['Formal Plated' ,'Buffet Style' , 'Family Style'];
$bar = ['Open Bar', 'Cash Bar', 'Package Choice'];
$platinum = ['Platinum - 4 Hours', 'Platinum - 3 Hours', 'Platinum - 2 Hours'];
$gold = ['Gold - 4 Hours', 'Gold - 3 Hours', 'Gold - 2 Hours'];
$silver = ['Silver - 4 Hours', 'Silver - 3 Hours', 'Silver - 2 Hours'];
$beer = ['Beer & Wine - 4 Hours', 'Beer & Wine - 3 Hours', 'Beer & Wine - 2 Hours'];
@endphp
@section('content')
<style>
    .floorimages {
        height: 400px;
        width: 600px;
        margin: 26px;
    }

    .selected-image {
        border: 2px solid #3498db;
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.5);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .selected-image:hover {
        border-color: #2980b9;
        box-shadow: 0 0 15px rgba(41, 128, 185, 0.8);
    }

    .zoom {
        background-color: none;
        transition: transform .2s;
    }

    .zoom:hover {
        -ms-transform: scale(1.5);
        -webkit-transform: scale(1.5);
        transform: scale(1.2);
    }
</style>
<div class="container-field">
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
                    <a href="#useradd-1" class="list-group-item list-group-item-action">
                        <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                        <span class="dash-mtext">{{ __('Event') }} </span></a>
                    <a href="#useradd-1" class="list-group-item list-group-item-action">
                        <span class="fa-stack fa-lg pull-left"></span>
                        <span class="dash-mtext">{{ __('Event Details') }} </span></a>
                    <a href="#useradd-1" class="list-group-item list-group-item-action">
                        <span class="fa-stack fa-lg pull-left"></span>
                        <span class="dash-mtext">{{ __('Special Requirements') }} </span></a>
                    <a href="#useradd-1" class="list-group-item list-group-item-action">
                        <span class="fa-stack fa-lg pull-left"></span>
                        <span class="dash-mtext">{{ __('Other Information') }} </span></a>
                </div>
            </div>
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <h5>{{ __('Event') }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {{Form::label('Select Existing Lead/New Event',__('Select Existing Lead/New Event'),['class'=>'form-label']) }}
                                    <div class="form-group">
                                        {{ Form::radio('newevent',__('Existing Lead'),false) }}
                                        {{ Form::label('newevent','Existing Lead') }}
                                        {{ Form::radio('newevent',__('New Event'),false) }}
                                        {{ Form::label('newevent','New Event') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="event_option" style="display: none;">
                            {{ Form::open(['url' => 'meeting', 'method' => 'post', 'enctype' => 'multipart/form-data','id'=>'formdata'] )  }}
                            <div id="useradd-1" class="card">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <h5>{{ __('Create Event') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6" id="lead_select" style="display: none;">
                                                <div class="form-group">
                                                    {{ Form::label('lead', __('Lead'), ['class' => 'form-label']) }}
                                                    {!! Form::select('lead', $attendees_lead, null, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-6" id="new_event" style="display: none;">
                                                <div class="form-group">
                                                    {{ Form::label('eventname', __('Event Name'), ['class' => 'form-label']) }}
                                                    {{Form::text('eventname',null,array('class'=>'form-control','placeholder'=>__('Enter Event Name')))}}
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    {{Form::label('Assigned Staff',__('Assigned Staff'),['class'=>'form-label']) }}
                                                    @foreach($users as $user)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="user[]" value="{{ $user->id }}" id="user_{{ $user->id }}">
                                                        <label class="form-check-label" for="user_{{ $user->id }}">
                                                            {{ $user->name }} ({{ $user->type }})
                                                        </label>
                                                    </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    {{Form::label('type',__('Event Type'),['class'=>'form-label']) }}
                                                    {!! Form::select('type', $type_arr, null,array('class' => 'form-control')) !!}
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    {{Form::label('company_name',__('Company Name'),['class'=>'form-label']) }}
                                                    {{Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Enter Company Name'),'required'=>'required'))}}
                                                </div>

                                            </div>
                                            <div class="col-12  p-0 modaltitle pb-3 mb-3">
                                                <h5 style="margin-left: 14px;">{{ __('Contact Information') }}</h5>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    {{Form::label('name',__('Name'),['class'=>'form-label']) }}
                                                    {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    {{Form::label('phone',__('Phone'),['class'=>'form-label']) }}
                                                    {{Form::text('phone',null,array('class'=>'form-control','placeholder'=>__('Enter Phone'),'required'=>'required'))}}
                                                </div>
                                                @error('phone')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    {{Form::label('email',__('Email'),['class'=>'form-label']) }}
                                                    {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
                                                </div>
                                                @error('email')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    {{Form::label('lead_address',__('Address'),['class'=>'form-label']) }}
                                                    {{Form::text('lead_address',null,array('class'=>'form-control','placeholder'=>__('Address'),'required'=>'required'))}}
                                                </div>
                                                @error('lead_address')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    {{Form::label('relationship',__('Relationship'),['class'=>'form-label']) }}
                                                    {{Form::text('relationship',null,array('class'=>'form-control','placeholder'=>__('Enter Relationship')))}}
                                                </div>
                                            </div>
                                            <div id="contact-info" style="display:none">
                                                <div class="row">
                                                    <div class="col-12  p-0 modaltitle pb-3 mb-3">
                                                        <h5 style="margin-left: 14px;">{{ __('Other Contact Information') }}</h5>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            {{Form::label('alter_name',__('Name'),['class'=>'form-label']) }}
                                                            {{Form::text('alter_name',null,array('class'=>'form-control','placeholder'=>__('Enter Name')))}}
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            {{Form::label('alter_phone',__('Phone'),['class'=>'form-label']) }}
                                                            {{Form::text('alter_phone',null,array('class'=>'form-control','placeholder'=>__('Enter Phone')))}}
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            {{Form::label('alter_email',__('Email'),['class'=>'form-label']) }}
                                                            {{Form::text('alter_email',null,array('class'=>'form-control','placeholder'=>__('Enter Email')))}}
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            {{Form::label('alter_lead_address',__('Address'),['class'=>'form-label']) }}
                                                            {{Form::text('alter_lead_address',null,array('class'=>'form-control','placeholder'=>__('Address')))}}
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            {{Form::label('alter_relationship',__('Relationship'),['class'=>'form-label']) }}
                                                            {{Form::text('alter_relationship',null,array('class'=>'form-control','placeholder'=>__('Enter Relationship')))}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-end mt-3">
                                                <button data-bs-toggle="tooltip" id="opencontact" title="{{ __('Add Contact') }}" class="btn btn-sm btn-primary btn-icon m-1">
                                                    <i class="ti ti-plus"></i>
                                                </button>
                                            </div>
                                            @if (isset($setting['is_enabled']) && $setting['is_enabled'] == 'on')
                                            <div class="form-group col-md-6">
                                                <label>{{ __('Synchronize in Google Calendar') }}</label>
                                                <div class="form-check form-switch pt-2">
                                                    <input id="switch-shadow" class="form-check-input" value="1" name="is_check" type="checkbox">
                                                    <label class="form-check-label" for="switch-shadow"></label>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="event-details" class="card">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <h5>{{ __('Event Details') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">


                                            <div class="col-6">
                                                <div class="form-group">
                                                    {{Form::label('guest_count',__('Guest Count'),['class'=>'form-label']) }}
                                                    {!! Form::number('guest_count', null,array('class' => 'form-control','min'=> 0)) !!}
                                                </div>
                                                @error('guest_count')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="venue_selection" class="form-label">Venue</label>
                                                    @foreach($venue as $key => $label)
                                                    <div>
                                                        <input type="checkbox" name="venue[]" value="{{ $label }}" id="venue{{ $key + 1 }}">
                                                        <label for="{{ $label }}">{{ $label }}</label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @error('venue')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>



                                            <div class="col-6">
                                                <div class="form-group">
                                                    {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                                    {!! Form::date('start_date', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                                </div>
                                                @error('start_date')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                                                    {!! Form::date('end_date',null, ['class' => 'form-control', 'required' => 'required']) !!}
                                                </div>
                                                @error('end_date')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    {{ Form::label('start_time', __('Start Time'), ['class' => 'form-label']) }}
                                                    {!! Form::input('time', 'start_time', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                                </div>
                                                @error('start_time')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    {{ Form::label('end_time', __('End Time'), ['class' => 'form-label']) }}
                                                    {!! Form::input('time', 'end_time', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                                </div>
                                                @error('end_time')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>


                                            <div class="col-6">
                                                <div class="form-group">
                                                    {{ Form::label('function', __('Function'), ['class' => 'form-label']) }}
                                                    @foreach($function as $key => $value)
                                                    <div class="form-check">
                                                        {!! Form::checkbox('function[]',$value, null, ['id' => 'function_' . $key, 'class' => 'form-check-input']) !!}
                                                        {{ Form::label($value, $value, ['class' => 'form-check-label']) }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @error('function')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-6" id="breakfast" style="display:none">
                                                <div class="form-group">
                                                    {{ Form::label('break_package', __('Breakfast Package'), ['class' => 'form-label']) }}
                                                    @foreach($breakfast as $key => $label)
                                                    <div>
                                                        {{ Form::radio('break_package[]',$label, false, ['id' => 'break_package' . ($key + 1)]) }}
                                                        {{ Form::label($label, $label) }}
                                                    </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                            <div class="col-6" id="lunch" style="display:none">
                                                <div class="form-group">
                                                    {{ Form::label('lunch_package', __('Lunch Package'), ['class' => 'form-label']) }}
                                                    @foreach($lunch as $key => $label)
                                                    <div>
                                                        {{ Form::radio('lunch_package[]', $label, false, ['id' => 'lunch_package' . ($key + 1)]) }}
                                                        {{ Form::label($label, $label) }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-6" id="dinner" style="display:none">
                                                <div class="form-group">
                                                    {{ Form::label('dinner_package', __('Dinner Package'), ['class' => 'form-label']) }}
                                                    @foreach($dinner as $key => $label)
                                                    <div>
                                                        {{ Form::radio('dinner_package[]', $label, false, ['id' => 'dinner_package' . ($key + 1)]) }}
                                                        {{ Form::label($label, $label) }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-6" id="wedding" style="display:none">
                                                <div class="form-group">
                                                    {{ Form::label('wedding_package', __('Wedding Package'), ['class' => 'form-label']) }}
                                                    @foreach($wedding as $key => $label)
                                                    <div>
                                                        {{ Form::radio('wedding_package[]', $label, false, ['id' => 'wedding_package' . ($key + 1)]) }}
                                                        {{ Form::label($label, $label) }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                {{Form::label('add_opts',__('Additional Options'),['class'=>'form-label']) }}
                                                <button data-bs-toggle="tooltip" id="ad_opt" class="btn btn-sm  btn-icon m-1">
                                                    <i class="ti ti-plus"></i></button>
                                            </div>
                                            <div class="col-12" id='add_opts' style="display:none">
                                                <div class="form-group">
                                                    {{Form::text('add_opts',null,array('class'=>'form-control','placeholder'=>__('Any Additional Optionas')))}}
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <label><b>Setup</b></label>
                                                    @foreach($setup as $s)
                                                    <div class="col-6  mt-4">
                                                        <input type="radio" id="image_{{ $loop->index }}" name="uploadedImage" class="form-check-input " value="{{ asset('floor_images/' . $s->image) }}" style="display:none;">
                                                        <label for="image_{{ $loop->index }}" class="form-check-label">
                                                            <img src="{{asset('floor_images/'.$s->image)}}" alt="Uploaded Image" class="img-thumbnail floorimages zoom" data-bs-toggle="tooltip" title="{{$s->Description}}">
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @error('uploadedImage')
                                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="special_req" class="card">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <h5>{{ __('Any Special Requirements') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group">
                                                {{Form::label('rooms',__('Room'),['class'=>'form-label']) }}
                                                <input type="number" name="rooms" min=0 class="form-control">

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    {!! Form::label('meal', 'Meal Preference') !!}
                                                    @foreach($meal as $key => $label)
                                                    <div>
                                                        {{ Form::radio('meal', $label , false, ['id' => $label]) }}
                                                        {{ Form::label('meal' . ($key + 1), $label) }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    {!! Form::label('bar', 'Bar') !!}
                                                    @foreach($bar as $key => $label)
                                                    <div>
                                                        {{ Form::radio('bar', $label, false, ['id' => $label]) }}
                                                        {{ Form::label('bar' . ($key + 1), $label) }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="row" id="package" style="display:none">
                                                {{ Form::label('bar_package', __('Bar Packages'), ['class' => 'form-label']) }}
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        {{ Form::label('platinum_package', __('Platinum Package'), ['class' => 'form-label']) }}
                                                        @foreach($platinum as $key => $label)
                                                        <div>
                                                            {{ Form::radio('bar_package', 'platinum_package' . ($key + 1), false) }}
                                                            {{ Form::label('platinum_package' . ($key + 1), $label) }}
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        {{ Form::label('gold_package', __('Gold Package'), ['class' => 'form-label']) }}
                                                        @foreach($gold as $key => $label)
                                                        <div>
                                                            {{ Form::radio('bar_package', 'gold_package' . ($key + 1), false) }}
                                                            {{ Form::label('gold_package' . ($key + 1), $label) }}
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        {{ Form::label('silver_package', __('Silver Package'), ['class' => 'form-label']) }}
                                                        @foreach($silver as $key => $label)
                                                        <div>
                                                            {{ Form::radio('bar_package', 'silver_package' . ($key + 1), false) }}
                                                            {{ Form::label('silver_package' . ($key + 1), $label) }}
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        {{ Form::label('beer_package', __('Beer & Wine'), ['class' => 'form-label']) }}
                                                        @foreach($beer as $key => $label)
                                                        <div>
                                                            {{ Form::radio('bar_package', 'beer_package' . ($key + 1), false) }}
                                                            {{ Form::label('beer_package' . ($key + 1), $label) }}
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    {{Form::label('spcl_request',__('Special Requests / Considerations'),['class'=>'form-label']) }}
                                                    {{Form::text('spcl_request',null,array('class'=>'form-control'))}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="other_info" class="card">
                                <div class="col-md-12">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                                <h5>{{ __('Other Information') }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    {{Form::label('allergies',__('Allergies'),['class'=>'form-label']) }}
                                                    {{Form::text('allergies',null,array('class'=>'form-control','placeholder'=>__('Enter Allergies(if any)')))}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <input type="reset" id="resetForm" value="" style="display: none;">
                                        {{ Form::submit(__('Save'), ['class' => 'btn  btn-primary ']) }}
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
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
    $('input[name="newevent"]').on('click', function() {
        $('#lead_select').hide();
        $('#new_event').hide();
        $('#event_option').show();
        var selectedValue = $(this).val();
        if (selectedValue == 'Existing Lead') {
            $('#lead_select').show();
        } else {
            $('#new_event').show();
            $('input#resetForm').trigger('click');
        }
    });
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
    document.getElementById('opencontact').addEventListener('click', function(event) {
        var x = document.getElementById("contact-info");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
        event.stopPropagation();
        event.preventDefault();
    });
    $('select[name= "lead"]').on('change', function() {
        $('#breakfast').hide();
        $('#lunch').hide();
        $('#dinner').hide();
        $('#wedding').hide();
        var venu = this.value;
        $.ajax({
            url: "{{ route('meeting.lead') }}",
            type: 'POST',
            data: {
                "venue": venu,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                console.log(data);
                venue_str = data.venue_selection;
                venue_arr = venue_str.split(",");
                func_str = data.function;
                func_arr = func_str.split(",");
                $('input[name ="company_name"]').val(data.company_name);
                $('input[name ="name"]').val(data.name);
                $('input[name ="phone"]').val(data.phone);
                $('input[name ="relationship"]').val(data.relationship);
                $('input[name ="start_date"]').val(data.start_date);
                $('input[name ="end_date"]').val(data.end_date);

                $('input[name ="start_time"]').val(data.start_time);
                $('input[name ="end_time"]').val(data.end_time);
                $('input[name ="rooms"]').val(data.rooms);
                $('input[name ="email"]').val(data.email);
                $('input[name ="lead_address"]').val(data.lead_address);
                $("select[name='type'] option[value='" + data.type + "']").prop("selected", true);
                $("input[name='bar'][value='" + data.bar + "']").prop('checked', true);
                // $("select[name='user'] option[value='"+data.assigned_user+"']").prop("selected", true);
                $("input[name='user[]'][value='" + data.assigned_user + "']").prop('checked', true);
                $.each(venue_arr, function(i, val) {
                    $("input[name='venue[]'][value='" + val + "']").prop('checked', true);
                });

                $.each(func_arr, function(i, val) {
                    $("input[name='function[]'][value='" + val + "']").prop('checked', true);
                });

                $('input[name ="guest_count"]').val(data.guest_count);

                var checkedFunctions = $('input[name="function[]"]:checked').map(function() {
                    return $(this).val();
                }).get();
                console.log("check", checkedFunctions);

                if (checkedFunctions.includes('Breakfast') || checkedFunctions.includes('Brunch')) {
                    // console.log("fdsfdsfds")
                    $('#breakfast').show();
                }
                if (checkedFunctions.includes('Lunch')) {
                    $('#lunch').show();
                }
                if (checkedFunctions.includes('Dinner')) {
                    $('#dinner').show();
                }
                if (checkedFunctions.includes('Wedding')) {
                    $('#wedding').show();
                }
            }
        });
    });
    $('input[name= "function[]"]').on('change', function() {
        $('#breakfast').hide();
        $('#lunch').hide();
        $('#dinner').hide();
        $('#wedding').hide();
        var checkedFunctions = $('input[name="function[]"]:checked').map(function() {
            return $(this).val();
        }).get();
        if (checkedFunctions.includes('Breakfast') || checkedFunctions.includes('Brunch')) {
            $('#breakfast').show();
        }
        if (checkedFunctions.includes('Lunch')) {
            $('#lunch').show();
        }
        if (checkedFunctions.includes('Dinner')) {
            $('#dinner').show();
        }
        if (checkedFunctions.includes('Wedding')) {
            $('#wedding').show();
        }
    });
    $('input[type=radio][name=bar]').change(function() {
        $('#package').hide();
        var val = $(this).val();
        if (val == 'Package Choice') {
            $('#package').show();
        }
    });
    document.getElementById('ad_opt').addEventListener('click', function(event) {
        $('#add_opts').toggle();
        event.stopPropagation();
        event.preventDefault();
    });
</script>
<script>
    $(document).ready(function() {
        $('input[name="uploadedImage"]').change(function() {
            $('.floorimages').removeClass('selected-image');

            if ($(this).is(':checked')) {
                var imageId = $(this).attr('id');
                $('label[for="' + imageId + '"] img').addClass('selected-image');
            }
        });
    });
</script>
@endpush