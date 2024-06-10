@extends('layouts.admin')
@section('page-title')
{{ __('Event Edit') }}
@endsection
@section('title')
{{ __('Edit Event') }}
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
if(!empty($meeting->func_package)){
$func_package = json_decode($meeting->func_package,true);
}
$fun_ad_opts = json_decode($meeting->ad_opts,true);
$selectedPackages = json_decode($meeting->bar_package,true);
$eventdoc = App\Models\EventDoc::where('event_id',$meeting->id)->get();
@endphp

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
<li class="breadcrumb-item"><a href="{{ route('meeting.index') }}">{{ __('Event') }}</a></li>
<li class="breadcrumb-item">{{ __('Edit') }}</li>
@endsection
@section('content')
<style>
.floorimages {
    height: 400px;
    width: 600px;
    margin: 0px !important;
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

.fa-asterisk {
    font-size: xx-small;
    position: absolute;
    padding: 1px;
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

#previewDiv .position-relative {
    position: relative;
    width: 60%;
}

.remove-setup {
    position: absolute;
    top: 5px;
    right: 0px;
    background: red;
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1.2em;
    line-height: 1em;
    padding: 0.2em 0.4em;
}
#remove-preview {
    position: absolute;
    top: 5px;
    right: 0px;
    background: red;
    color: white;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    font-size: 1.2em;
    line-height: 1em;
    padding: 0.2em 0.4em;
}
</style>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper p0">
            <div class="container-fluid xyz p0">
                <div class="row1">
                    <div class="col-lg-12 p0">
                        {{ Form::model($meeting, ['route' => ['meeting.update', $meeting->id],'enctype' => 'multipart/form-data', 'method' => 'PUT' ,'id'=> 'formdata']) }}
                        <div id="useradd-1" class="card">
                            <div class="col-md-12">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                            <h5>{{ __('Event') }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @if($meeting->attendees_lead != 0 )
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{ Form::label('attendees_lead', __('Lead'), ['class' => 'form-label']) }}
                                                {{Form::text('attendees_lead',$attendees_lead,array('class'=>'form-control','required'=>'required','readonly'=>'readonly'))}}
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{ Form::label('eventname', __('Event Name'), ['class' => 'form-label']) }}
                                                {{Form::text('eventname',$meeting->eventname,array('class'=>'form-control','required'=>'required','readonly'=>'readonly'))}}
                                            </div>
                                        </div>
                                        @endif

                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{Form::label('Assigned Staff',__('Assigned Staff'),['class'=>'form-label']) }}
                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                @foreach($users as $user)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="user[]"
                                                        value="{{ $user->id }}" id="user_{{ $user->id }}"
                                                        {{ in_array($user->id, $user_id) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="user_{{ $user->id }}">
                                                        {{ $user->name }} ({{ $user->type }})
                                                    </label>
                                                </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{Form::label('company_name',__('Company Name'),['class'=>'form-label']) }}
                                                {{Form::text('company_name',null,array('class'=>'form-control','placeholder'=>__('Enter Company Name')))}}
                                            </div>
                                        </div>

                                        <div class="col-12  p-0 modaltitle pb-3 mb-3">
                                            <h5 style="margin-left: 14px;">{{ __('Contact Information') }}</h5>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{Form::label('name',__('Name'),['class'=>'form-label']) }}
                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{Form::label('phone',__('Phone'),['class'=>'form-label']) }}
                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <div class="intl-tel-input">
                                                    <input type="tel" id="phone-input" name="phone"
                                                        class="phone-input form-control" placeholder="Enter Phone"
                                                        maxlength="16" required>
                                                    <input type="hidden" name="countrycode" id="country-code">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{Form::label('email',__('Email'),['class'=>'form-label']) }}
                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{Form::label('lead_address',__('Address'),['class'=>'form-label']) }}
                                                {{Form::text('lead_address',null,array('class'=>'form-control','placeholder'=>__('Address')))}}
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{Form::label('relationship',__('Relationship'),['class'=>'form-label']) }}
                                                {{Form::text('relationship',null,array('class'=>'form-control','placeholder'=>__('Enter Relationship')))}}
                                            </div>
                                        </div>

                                        <div id="contact-info" style="display:none">
                                            <div class="row">
                                                <div class="col-12  p-0 modaltitle pb-3 mb-3">
                                                    <h5 style="margin-left: 14px;">{{ __('Other Contact Information') }}
                                                    </h5>
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
                                            <button data-bs-toggle="tooltip" id="opencontact"
                                                title="{{ __('Add Contact') }}"
                                                class="btn btn-sm btn-primary btn-icon m-1">
                                                <i class="ti ti-plus"></i>
                                            </button>
                                        </div>
                                        @if (isset($setting['is_enabled']) && $setting['is_enabled'] == 'on')
                                        <div class="form-group col-md-6">
                                            <label>{{ __('Synchronize in Google Calendar') }}</label>
                                            <div class="form-check form-switch pt-2">
                                                <input id="switch-shadow" class="form-check-input" value="1"
                                                    name="is_check" type="checkbox">
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

                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{Form::label('type',__('Event Type'),['class'=>'form-label']) }}
                                                {!! Form::select('type', $type_arr, null,array('class' =>
                                                'form-control')) !!}
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                <label for="venue" class="form-label">{{ __('Venue') }}</label>
                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                @foreach($venue as $key => $label)
                                                <div>
                                                    <input type="checkbox" name="venue[]" id="{{ $label }}"
                                                        value="{{ $label }}"
                                                        {{ in_array($label, $venue_function) ? 'checked' : '' }}>
                                                    <label for="{{ $label }}">{{ $label }}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                {!! Form::date('start_date', null, ['class' => 'form-control',
                                                'required' => 'required']) !!}
                                            </div>
                                        </div>

                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{ Form::label('start_time', __('Start Time'), ['class' => 'form-label']) }}
                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                {!! Form::input('time', 'start_time',null, ['class' => 'form-control',
                                                'required' => 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{ Form::label('end_time', __('End Time'), ['class' => 'form-label']) }}
                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                {!! Form::input('time', 'end_time', null, ['class' => 'form-control',
                                                'required' => 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{Form::label('guest_count',__('Guest Count'),['class'=>'form-label']) }}
                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                {!! Form::number('guest_count', null,array('class' =>
                                                'form-control','min'=> 0)) !!}
                                            </div>
                                        </div>
                                        <div class="col-6 need_full">
                                            <div class="form-group">
                                                {{ Form::label('function', __('Function'), ['class' => 'form-label']) }}
                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                <br>
                                                @foreach($function as $value)
                                                <label>
                                                    <input type="checkbox" id="{{ $value['function'] }}"
                                                        name="function[]" value="{{ $value['function'] }}"
                                                        class="function-checkbox"
                                                        {{ in_array($value['function'], $function_p) ? 'checked' : '' }}
                                                        onchange="toggleDiv(" {{ $value['function'] }}"")">
                                                    {{ $value['function'] }}
                                                </label>
                                                <br>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-6 need_full" id="mailFunctionSection">
                                            @if(isset($function) && !empty($function))
                                            @foreach($function as $key =>$value)
                                            <div class="form-group" data-main-index="{{$key}}"
                                                data-main-value="{{$value['function']}}" id="function_package"
                                                style="display: none;">
                                                {{ Form::label('package', __($value['function']), ['class' => 'form-label']) }}
                                                <span class="text-sm">
                                                    <i class="fa fa-asterisk text-danger" aria-hidden="true"></i>
                                                </span>
                                                @foreach($value['package'] as $k => $package)
                                                <?php $isChecked = false; ?>
                                                @if(isset($func_package) && !empty($func_package))
                                                @foreach($func_package as $func => $pack)
                                                @foreach($pack as $keypac => $packval)
                                                @if($package == $packval)
                                                <?php $isChecked = true; ?>
                                                @endif
                                                @endforeach
                                                @endforeach
                                                @endif
                                                <div class="form-check" data-main-index="{{$k}}"
                                                    data-main-package="{{$package}}">
                                                    {!! Form::checkbox('package_'.str_replace(' ', '',
                                                    strtolower($value['function'])).'[]',$package, $isChecked, ['id' =>
                                                    'package_' . $key.$k, 'data-function' => $value['function'], 'class'
                                                    => 'form-check-input']) !!}
                                                    {{ Form::label($package, $package, ['class' => 'form-check-label']) }}
                                                </div>
                                                @endforeach
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <div class="col-6 need_full" id="additionalSection">
                                            @if(isset($additional_items) && !empty($additional_items))
                                            {{ Form::label('additional', __('Additional items'), ['class' => 'form-label']) }}
                                            @foreach($additional_items as $ad_key =>$ad_value)
                                            @foreach($ad_value as $fun_key =>$packageVal)
                                            <div class="form-group" data-additional-index="{{$fun_key}}"
                                                data-additional-value="{{key($packageVal)}}" id="ad_package"
                                                style="display: none;">
                                                {{ Form::label('additional', __($fun_key), ['class' => 'form-label']) }}
                                                @foreach($packageVal as $pac_key =>$item)
                                                <div class="form-check" data-additional-index="{{$pac_key}}"
                                                    data-additional-package="{{$pac_key}}">
                                                    <?php $isCheckedif = false; ?>
                                                    @if(isset($fun_ad_opts) && !empty($fun_ad_opts ))
                                                    @foreach($fun_ad_opts as $keys=>$valss)
                                                    @foreach($valss as $val)
                                                    @if($pac_key == $val)
                                                    <?php $isCheckedif = true;?>
                                                    @endif
                                                    @endforeach
                                                    @endforeach
                                                    @endif
                                                    {!! Form::checkbox('additional_'.str_replace(' ', '_',
                                                    strtolower($fun_key)).'[]',$pac_key, $isCheckedif, ['data-function'
                                                    =>
                                                    $fun_key, 'class' => 'form-check-input']) !!}
                                                    {{ Form::label($pac_key, $pac_key, ['class' => 'form-check-label']) }}
                                                </div>
                                                @endforeach
                                            </div>
                                            @endforeach
                                            @endforeach
                                            @endif

                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">

                                                <label><b>Food Description</b></label>
                                                <textarea name="food_package_description" rows="4"
                                                    class="form-control">{{ $meeting->food_description ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <label><b>Setup</b></label>
                                                @foreach($setup as $s)
                                                <div class="col-6  mt-4 need_full">
                                                    <input type="radio" id="image_{{ $loop->index }}"
                                                        name="uploadedImage" class="form-check-input "
                                                        value="{{$s->image}}"
                                                        {{ $s->image ==$meeting->floor_plan ? 'checked' : '' }}
                                                        style="display:none">
                                                    <label for="image_{{ $loop->index }}" class="form-check-label">
                                                        <img src="{{asset('floor_images/'. $s->image)}}"
                                                            alt="Uploaded Image" class="img-thumbnail floorimages zoom"
                                                            data-bs-toggle="tooltip" title="{{$s->Description}}">
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 mt-4">
                                            <div class="form-group">
                                                <label><b>Upload Setup</b></label>
                                                <input type='file' id="imgInp" class="form-control" name="setupplans[]"
                                                    multiple />
                                            </div>
                                        </div>
                                        <?php $setups = App\Models\Setuplans::where('event_id',$meeting->id)->exists(); ?>

                                        <div class="col-12" id="previewDiv">
                                            @if($setups)
                                            @foreach($setupplanss as $setup_plan)
                                            <?php $setupname = explode('/', $setup_plan->setup_docs); ?>
                                            <div class="form-group position-relative setup-item"
                                                style="border: 1px solid; padding: 40px; margin-bottom: 20px;">
                                                @if(in_array(pathinfo($setupname[1], PATHINFO_EXTENSION), ['png',
                                                'jpg']))
                                                <img src="{{ Storage::url('app/public/'.$setup_plan->setup_docs) }}"
                                                    style="width: 70%;" alt="">
                                                @elseif(pathinfo($setupname[1], PATHINFO_EXTENSION) == 'pdf')
                                                <a href="{{ Storage::url('app/public/'.$setup_plan->setup_docs) }}"
                                                    download>
                                                    <img src="{{ asset('extension_img/pdf.png') }}" alt=""
                                                        style="width: 10%;">
                                                </a>
                                                @elseif(in_array(pathinfo($setupname[1], PATHINFO_EXTENSION), ['doc',
                                                'docs']))
                                                <a href="{{ Storage::url('app/public/'.$setup_plan->setup_docs) }}"
                                                    download>
                                                    <img src="{{ asset('extension_img/doc.png') }}" alt=""
                                                        style="width: 10%;">
                                                </a>
                                                @endif
                                                <button type="button" class="btn btn-danger remove-setup"
                                                    data-setup-id="{{ $setup_plan->id }}">&times;</button>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    <div  class="col-12">
                                        <img id="blah" src="#" alt="Preview" class="form-control"
                                            style="display:none;width:30%" />
                                        <button type="button" id="remove-preview"
                                            class="btn btn-danger position-absolute "
                                            style="display:none;">&times;</button>
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
                                                <input type="number" name="rooms" min=0 class="form-control"
                                                    value="{{$meeting->room}}">
                                            </div>
                                            <div class="col-6 need_full">
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

                                            <div class="col-6 need_full">
                                                <div class="form-group">
                                                    {!! Form::label('baropt', 'Bar') !!}
                                                    @foreach($baropt as $key => $label)
                                                    <div>
                                                        {{ Form::radio('baropt', $label, isset($meeting->bar) && $meeting->bar == $label ? true : false, ['id' => $label, 'class' => 'baropt-radio']) }}
                                                        {{ Form::label('baropt' . ($key + 1), $label) }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-6 need_full" id="barpacakgeoptions" style="display: none;">
                                                @if(isset($bar_package) && !empty($bar_package))
                                                @foreach($bar_package as $key =>$value)
                                                <div class="form-group" data-main-index="{{$key}}"
                                                    data-main-value="{{$value['bar']}}">
                                                    {{ Form::label('bar', __($value['bar']), ['class' => 'form-label']) }}
                                                    @foreach($value['barpackage'] as $k => $bar)
                                                    <?php $checkedif = false; ?>
                                                    <div class="form-check" data-main-index="{{$k}}"
                                                        data-main-package="{{$bar}}">
                                                        @if($selectedPackages)
                                                        @if(isset($selectedPackages[$value['bar']]) &&
                                                        $selectedPackages[$value['bar']] == $bar)
                                                        <?php $checkedif = true; ?>
                                                        @endif
                                                        @endif
                                                        {!! Form::checkbox('bar'.'_'.str_replace(' ', '',
                                                        strtolower($value['bar'])), $bar, $checkedif, ['id' => 'bar_' .
                                                        $key.$k, 'data-function' => $value['bar'], 'class' =>
                                                        'form-check-input single-select']) !!}
                                                        {{ Form::label($bar, $bar, ['class' => 'form-check-label']) }}
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label><b>Bar Description</b></label>
                                                    <textarea name="bar_package_description" rows="4"
                                                        class="form-control">{{$meeting->bar_description ?? ''}}</textarea>
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
                                            <div class="col-12">
                                                <div class="form-group">
                                                    {{Form::label('atttachment',__('Attachments (If Any)'),['class'=>'form-label']) }}
                                                    <input type="file" name="atttachment" id="atttachment"
                                                        class="form-control">

                                                </div>
                                            </div>
                                            @if(isset($eventdoc) && !empty($eventdoc))
                                            <div class="col-lg-12">
                                                <div class="card" id="useradd-1">
                                                    <div class="card-body table-border-style">

                                                        <h3>Attachments</h3>
                                                        <hr>
                                                        <div class="col-md-12" style="display:flex;">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <th>Attachment</th>
                                                                    <th>Action</th>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($eventdoc as $file)
                                                                    <?php $fname = 'app/public/Event/'.$meeting->id.'/'.$file->filename ;?>
                                                                    <tr>
                                                                        <td>{{ ucfirst($file->filename) }}</td>
                                                                        <td>
                                                                            <a href="{{ Storage::url($fname) }}"
                                                                                download
                                                                                style=" position: absolute;color: #1551c9 !important">
                                                                                View Document</a>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" id="removedoc"
                                                                                data-main-value="{{$file->filename}}"
                                                                                class="btn btn-danger" title="Delete"><i
                                                                                    class="fa fa-trash"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        {{ Form::submit(__('Save Changes'), ['class' => 'btn  btn-primary ']) }}
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

    @endsection
    @push('script-page')
    <style>
    .iti.iti--allow-dropdown.iti--separate-dial-code {
        width: 100%;
    }
    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.single-select');
        const baroptRadios = document.querySelectorAll('.baropt-radio');

        // Function to uncheck all checkboxes
        function uncheckAllCheckboxes() {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }

        // Add event listener to baropt radio buttons
        baroptRadios.forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (this.value !==
                    'package choice'
                ) { // Replace 'package choice' with the actual value to check
                    uncheckAllCheckboxes();
                }
            });
        });

        // Add event listener to checkboxes for single selection behavior
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const group = this.getAttribute('data-function');
                const groupCheckboxes = document.querySelectorAll(
                    `input[data-function='${group}']`);

                groupCheckboxes.forEach(function(cb) {
                    if (cb !== checkbox) {
                        cb.checked = false;
                    }
                });
            });
        });
    });

    $('#removedoc').click(function(event) {

        var filename = $(this).data('main-value');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "This action can not be undone. Do you want to continue?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('meeting.removeattachment',$meeting->id) }}",
                    data: {
                        "filename": filename,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(result) {
                        // console.log(result);
                        if (result == true) {
                            swal.fire("Done!", result.message, "success");
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal.fire("Error!", result.message, "error");
                        }
                    }
                });
            }
        })
    });

    
    document.addEventListener('DOMContentLoaded', function() {
        const imgInp = document.getElementById('imgInp');
        const previewDiv = document.getElementById('previewDiv');
        const blah = document.getElementById('blah');
        const removePreviewButton = document.getElementById('remove-preview');

        imgInp.addEventListener('change', function() {
            const [file] = imgInp.files;
            if (file) {
                const fileName = file.name.toLowerCase();
                const fileExtension = fileName.split('.').pop();
                // if (fileExtension === 'png' || fileExtension === 'pdf') {
                if (fileExtension == 'png' || fileExtension == 'jpg') {
                    blah.src = URL.createObjectURL(file);
                    previewDiv.style.display = 'block';
                } else {
                    // Handle PDF file case here if needed
                    console.log('The file is a PDF.');
                    blah.src = '#'; // or some placeholder for PDF
                    previewDiv.style.display = 'none';
                }
            }
        });

        removePreviewButton.addEventListener('click', function() {
            blah.src = '#';
            blah.style.display = 'none';
            removePreviewButton.style.display = 'none';
            imgInp.value = ''; // Clear the file input
        });

        previewDiv.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-setup')) {
                const setupId = event.target.getAttribute('data-setup-id');
                removeSetup(setupId, event.target);
            }
        });

        function removeSetup(setupId, button) {
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "This action can not be undone. Do you want to continue?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
            fetch('{{route("meeting.removesetup",$meeting->id)}}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        setup_id: setupId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const setupDiv = button.closest('.setup-item');
                        setupDiv.remove();
                            swal.fire("Done!", data.message, "success");
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal.fire("Error!", data.message, "error");
                        }
                    // if (data.success) {
                    //     const setupDiv = button.closest('.setup-item');
                    //     setupDiv.remove();
                    // } else {
                    //     alert('Failed to remove setup. Please try again.');
                    // }
                })
                .catch(error => console.error('Error:', error));
            }
        })
        }
    });
    </script>
    <!-- <script>
imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}
</script> -->

    <script>
    function validateCheckboxGroup(groupName) {
        var checkboxes = $("input[name='" + groupName + "']");
        var isChecked = checkboxes.is(":checked");
        var errorMessage = '';
        if (!isChecked) {
            if (checkboxes.attr('type') === 'checkbox') {
                errorMessage = 'At least one ' + groupName.replace('[]', '') + ' must be selected.';
            } else if (checkboxes.attr('type') === 'radio') {
                errorMessage = 'Please select one ' + groupName.replace('[]', '') + '.';
            }
        }
        // if (!isChecked) {
        //     errorMessage = 'At least one ' + groupName.replace('[]', '') + ' must be selected.';
        // }

        // Remove any existing error message
        checkboxes.closest('.form-group').find('.validation-error').remove();

        // Append the error message if it exists
        if (errorMessage != '') {
            checkboxes.closest('.form-group').append(
                '<div class="validation-error text-danger" style="padding:2px;">' +
                errorMessage + '</div>');
        }
    }
    $(document).ready(function() {
        // Attach a keyup event listener to input fields
        $('input').on('keyup', function() {
            // Get the input value
            var value = $(this).val();
            // Check if the input value contains spaces
            if (value.indexOf(' ') !== -1) {
                // Display validation message
                $('#validationMessage').text('Spaces are not allowed in this field').show();
            } else {
                // Hide validation message if no spaces are found
                $('#validationMessage').hide();
            }
        });
    });
    $('#formdata').on('submit', function(event) {
        let isValid = true;

        // Remove previous error messages
        $('.error-message').remove();

        // Function to display error messages
        function displayError(inputId, message) {
            $(`<span class="error-message">${message}</span>`).insertAfter(`#${inputId}`);
        }


        // Name validation
        let name = $('#name').val().trim();
        if (name === '') {
            displayError('name', 'Name is required and must not contain only spaces.');
            isValid = false;
        }
        let startTime = $('#start_time').val();
        let endTime = $('#end_time').val();
        if (startTime != '' && endTime <= startTime) {
            displayError('end_time', 'End time must be after start time.');
            isValid = false;
        }

        // Prevent form submission if any validation fails
        if (!isValid) {
            event.preventDefault();
        }
    });
    $(document).ready(function() {
        $("input[type='text'][name='lead_name'],input[type='text'][name='name'],input[type='text'][name='email'], select[name='type'],input[type='tel'][name='phone'],input[name='guest_count'],input[name='start_date'],input[name='start_time'],input[name='end_time'],input[type='checkbox']")
            .focusout(function() {

                var input = $(this);
                var errorMessage = '';
                if (input.attr('name') === 'email' && input.val() !== '') {
                    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(input.val())) {
                        errorMessage = 'Invalid email address.';
                    }
                } else if (input.val() == '') {
                    errorMessage = 'This field is required.';
                }

                if (errorMessage != '') {
                    input.css('border', 'solid 2px red');
                } else {
                    // If it is not blank. 
                    input.css('border', 'solid 2px black');
                }

                // Remove any existing error message
                input.next('.validation-error').remove();

                // Append the error message if it exists
                if (errorMessage != '') {
                    input.after('<div class="validation-error text-danger" style="padding:2px;">' +
                        errorMessage + '</div>');
                }
                $("input[name='user[]']").change(validateCheckboxGroup('user[]'));
                $("input[name='user[]']").focusout(validateCheckboxGroup('user[]'));
                $("input[name='venue[]']").change(validateCheckboxGroup('venue[]'));
                $("input[name='venue[]']").focusout(validateCheckboxGroup('venue[]'));
                $("input[name='function[]']").change(validateCheckboxGroup('function[]'));
                $("input[name='function[]']").focusout(validateCheckboxGroup('function[]'));
                $("input[type='radio'][name='meal']").focusout(validateInputGroup('meal'));
                $("input[type='radio'][name='meal']").change(validateInputGroup('meal'));
            });
    });
    </script>
    <script>
    $(document).ready(function() {
        var phoneNumber = "<?php echo $meeting->phone;?>";
        var num = phoneNumber.trim();
        // if (phoneNumber.trim().length < 10) {
        //     alert('Please enter a valid phone number with at least 10 digits.');
        //     return;
        // }
        var lastTenDigits = phoneNumber.substr(-10);
        var formattedPhoneNumber = '(' + lastTenDigits.substr(0, 3) + ') ' + lastTenDigits.substr(3, 3) + '-' +
            lastTenDigits.substr(6);
        $('#phone-input').val(formattedPhoneNumber);
    })
    </script>
    <script>
    $(document).ready(function() {
        var input = document.querySelector("#phone-input");
        var iti = window.intlTelInput(input, {
            separateDialCode: true,
        });

        var indiaCountryCode = iti.getSelectedCountryData().iso2;
        var countryCode = iti.getSelectedCountryData().dialCode;
        $('#country-code').val(countryCode);
        if (indiaCountryCode !== 'us') {
            iti.setCountry('us');
        }
    });
    </script>
    <script>
    const isNumericInput = (event) => {
        const key = event.keyCode;
        return ((key >= 48 && key <= 57) || // Allow number line
            (key >= 96 && key <= 105) // Allow number pad
        );
    };
    const isModifierKey = (event) => {
        const key = event.keyCode;
        return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
            (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
            (key > 36 && key < 41) || // Allow left, up, right, down
            (
                // Allow Ctrl/Command + A,C,V,X,Z
                (event.ctrlKey === true || event.metaKey === true) &&
                (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
            )
    };
    const enforceFormat = (event) => {
        // Input must be of a valid number format or a modifier key, and not longer than ten digits
        if (!isNumericInput(event) && !isModifierKey(event)) {
            event.preventDefault();
        }
    };
    const formatToPhone = (event) => {
        if (isModifierKey(event)) {
            return;
        }
        // I am lazy and don't like to type things more than once
        const target = event.target;
        const input = event.target.value.replace(/\D/g, '').substring(0, 10); // First ten digits of input only
        const zip = input.substring(0, 3);
        const middle = input.substring(3, 6);
        const last = input.substring(6, 10);

        if (input.length > 6) {
            target.value = `(${zip}) ${middle} - ${last}`;
        } else if (input.length > 3) {
            target.value = `(${zip}) ${middle}`;
        } else if (input.length > 0) {
            target.value = `(${zip}`;
        }
    };
    const inputElement = document.getElementById('phone-input');
    inputElement.addEventListener('keydown', enforceFormat);
    inputElement.addEventListener('keyup', formatToPhone);
    </script>
    <script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
    $(document).ready(function() {
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
        var selectedValue = $('input[name="bar"]:checked').val();
        if (selectedValue == 'Package Choice') {
            $('#package').show();
        }
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
        var selectedValue = $("input[name='baropt']:checked").val();
        if (selectedValue == 'Package Choice') {
            $('div#barpacakgeoptions').show();
        }
        $('input[type=radio][name = baropt]').change(function() {
            $('div#barpacakgeoptions').hide();
            var value = $(this).val();
            if (value == 'Package Choice') {
                $('div#barpacakgeoptions').show();
            }
        });
    });
    </script>

    <script>
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

    function toggleDiv(value) {
        var divId = value.toLowerCase();
        var div = document.getElementById(divId);

        if (div) {
            div.style.display = document.getElementById(value).checked ? 'block' : 'none';
        }
    }
    $(document).ready(function() {
        $('input[name="uploadedImage"]').each(function() {
            if ($(this).prop('checked')) {
                var imageId = $(this).attr('id');
                $('label[for="' + imageId + '"] img').addClass('selected-image');
            }
        });
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