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
if(isset($setting['function']) && !empty($setting['function'])){
$function = json_decode($setting['function'],true);
}
if(isset($setting['additional_items']) && !empty($setting['additional_items'])){
$additional_items = json_decode($setting['additional_items'],true);
}
$meal = ['Formal Plated' ,'Buffet Style' , 'Family Style'];
$baropt = ['Open Bar', 'Cash Bar', 'Package Choice'];
if(isset($setting['barpackage']) && !empty($setting['barpackage'])){
$bar_package = json_decode($setting['barpackage'],true);
}
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
                                                    @if(isset($function) && !empty($function))
                                                    @foreach($function as $key => $value)
                                                    <div class="form-check">
                                                        {!! Form::checkbox('function[]',$value['function'], null, ['id' => 'function_' . $key, 'class' => 'form-check-input']) !!}
                                                        {{ Form::label($value['function'], $value['function'], ['class' => 'form-check-label']) }}
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                </div>
                                              
                                            </div>
                                            <div class="col-6" id="mailFunctionSection">
                                                @if(isset($function) && !empty($function))
                                                @foreach($function as $key =>$value)
                                                <div class="form-group" data-main-index="{{$key}}" data-main-value="{{$value['function']}}" id="function_package" style="display: none;">
                                                    {{ Form::label('package', __($value['function']), ['class' => 'form-label']) }}
                                                    @foreach($value['package'] as $k => $package)
                                                    <div class="form-check" data-main-index="{{$k}}" data-main-package="{{$package}}">
                                                        {!! Form::checkbox('package_'.str_replace(' ', '', strtolower($value['function'])).'[]',$package, null, ['id' => 'package_' . $key.$k, 'data-function' => $value['function'], 'class' => 'form-check-input']) !!}
                                                        {{ Form::label($package, $package, ['class' => 'form-check-label']) }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="col-6" id="additionalSection">
                                                @if(isset($additional_items) && !empty($additional_items))
                                                {{ Form::label('additional', __('Additional items'), ['class' => 'form-label']) }}
                                                @foreach($additional_items as $ad_key =>$ad_value)
                                                @foreach($ad_value as $fun_key =>$packageVal)
                                                <div class="form-group" data-additional-index="{{$fun_key}}" data-additional-value="{{key($packageVal)}}" id="ad_package" style="display: none;">
                                                    {{ Form::label('additional', __($fun_key), ['class' => 'form-label']) }}
                                                    @foreach($packageVal as $pac_key =>$item)
                                                    <div class="form-check" data-additional-index="{{$pac_key}}" data-additional-package="{{$pac_key}}">
                                                        {!! Form::checkbox('additional_'.str_replace(' ', '_', strtolower($fun_key)).'[]',$pac_key, null, ['data-function' => $fun_key, 'class' => 'form-check-input']) !!}
                                                        {{ Form::label($pac_key, $pac_key, ['class' => 'form-check-label']) }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endforeach
                                                @endforeach
                                                @endif

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
                                                    {!! Form::label('baropt', 'Bar') !!}
                                                    @foreach($baropt as $key => $label)
                                                    <div>
                                                        {{ Form::radio('baropt', $label, false, ['id' => $label]) }}
                                                        {{ Form::label('baropt' . ($key + 1), $label) }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-6" id="barpacakgeoptions" style="display: none;">
                                                @if(isset($bar_package) && !empty($bar_package))
                                                @foreach($bar_package as $key =>$value)
                                                <div class="form-group" data-main-index="{{$key}}" data-main-value="{{$value['bar']}}">
                                                    {{ Form::label('bar', __($value['bar']), ['class' => 'form-label']) }}
                                                    @foreach($value['barpackage'] as $k => $bar)
                                                    <div class="form-check" data-main-index="{{$k}}" data-main-package="{{$bar}}">
                                                        {!! Form::radio('bar'.'_'.str_replace(' ', '', strtolower($value['bar'])), $bar, false, ['id' => 'bar_' . $key.$k, 'data-function' => $value['bar'], 'class' => 'form-check-input']) !!}
                                                        {{ Form::label($bar, $bar, ['class' => 'form-check-label']) }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endforeach
                                                @endif
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
    document.addEventListener('DOMContentLoaded', async function() {
        try {
            const getSessionStorage = () => {
                return new Promise((resolve, reject) => {
                    try {
                        const storedSessionData = window.sessionStorage.getItem("selectedDate");
                        resolve(storedSessionData);
                    } catch (error) {
                        reject(error);
                    }
                });
            };
            const storedSessionData = await getSessionStorage();
            if (storedSessionData) {
                console.log(`sessionStorage: ${storedSessionData}`);
                document.getElementById('newevent').click();
                const startDateInput = document.getElementById('start_date');
                if (startDateInput) {
                    startDateInput.setAttribute('value', storedSessionData);
                    startDateInput.value = storedSessionData;
                    console.log("Value set successfully.");
                } else {
                    console.error("Element with ID 'start_date' not found.");
                }
            } else {
                console.log("No sessionStorage data found.");
            }
        } catch (error) {
            console.error("Error occurred while retrieving sessionStorage:", error);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('input[name=newevent]').prop('checked', false);
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
        $('select[name= "lead"]').on('change', function() {
            $("input[name='user[]'").prop('checked', false);
            $("input[name='bar']").prop('checked', false);
            $("input[name='user[]']").prop('checked', false);
            $("input[name='venue[]']").prop('checked', false);
            $("input[name='function[]']").prop('checked', false);
            var venu = this.value;
            $.ajax({
                url: "{{ route('meeting.lead') }}",
                type: 'POST',
                data: {
                    "venue": venu,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
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
                    var mailFunctionSection = document.getElementById('mailFunctionSection');
                    var divs = mailFunctionSection.querySelectorAll('.form-group');
                    divs.forEach(function(div) {
                        var mainValue = div.getAttribute('data-main-value');
                        if (checkedFunctions.includes(mainValue)) {
                            div.style.display = 'block';
                        } else {
                            div.style.display = 'none';
                        }
                    });                   
                }
            });
        });
        
        jQuery(function() {
            $('input[name="function[]"]').change(function() {
                $('div#mailFunctionSection > div').hide();
                $('input[name="function[]"]:checked').each(function() {
                    var funVal = $(this).val();
                    $('div#mailFunctionSection > div').each(function() {
                        var attr_value = $(this).data('main-value');
                        if (attr_value == funVal) {
                            $(this).show();
                        }
                    });
                });
            });
        });
        jQuery(function() {
            $('div#mailFunctionSection input[type=checkbox]').change(function() {
                $('div#additionalSection > div').hide();
                $('div#mailFunctionSection input[type=checkbox]:checked').each(function() {
                    var funcValue = $(this).val();
                    $('div#additionalSection > div').each(function() {
                        var ad_val = $(this).data('additional-index');
                        if (funcValue == ad_val) {
                            $(this).show();
                        }
                    });
                });
            });
        });
        jQuery(function() {
            $('input[type=radio][name = baropt]').change(function() {
                $('div#barpacakgeoptions').hide();
                var value = $(this).val();
               if(value == 'Package Choice'){
                    $('div#barpacakgeoptions').show();
               }
            });
        });
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