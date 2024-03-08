@extends('layouts.admin')
@section('page-title')
    {{ __('Lead Edit') }}
@endsection
@php
    $plansettings = App\Models\Utility::plansettings();
    $setting = App\Models\Utility::settings();
    $type_arr= explode(',',$setting['event_type']);
    $type_arr = array_combine($type_arr, $type_arr);
    $venue = explode(',',$setting['venue']);
    if(isset($setting['function']) && !empty($setting['function'])){
        $function = json_decode($setting['function']);
    }
    $bar = ['Open Bar', 'Cash Bar', 'Package Choice'];
    $platinum = ['Platinum - 4 Hours', 'Platinum - 3 Hours', 'Platinum - 2 Hours'];
    $gold = ['Gold - 4 Hours', 'Gold - 3 Hours', 'Gold - 2 Hours'];
    $silver = ['Silver - 4 Hours', 'Silver - 3 Hours', 'Silver - 2 Hours'];
    $beer = ['Beer & Wine - 4 Hours', 'Beer & Wine - 3 Hours', 'Beer & Wine - 2 Hours'];
@endphp
@section('title')
    <div class="page-header-title">
        {{ __('Edit Lead') }} {{ '(' . $lead->name . ')' }}
    </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('lead.index') }}">{{ __('Lead') }}</a></li>
    <li class="breadcrumb-item">{{ __('Details') }}</li>
@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">
        
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                    <div id="useradd-1" class="card">
                    {{ Form::model($lead, ['route' => ['lead.update', $lead->id], 'method' => 'PUT', 'id' => "formdata"]) }}
                    <div class="card-header">
                        <h5>{{ __('Overview') }}</h5>
                        <small class="text-muted">{{ __('Edit About Your Lead Information') }}</small>
                    </div>
                    <div class="card-body"> 
                            <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    {{Form::label('lead_name',__('Lead Name'),['class'=>'form-label']) }}
                                    {{Form::text('lead_name',$lead->leadname,array('class'=>'form-control','placeholder'=>__('Enter Lead Name')))}}
                                    @error('lead_name')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
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
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    {{Form::label('email',__('Email'),['class'=>'form-label']) }}
                                    {{Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter Email'),'required'=>'required'))}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {{Form::label('lead_address',__('Address'),['class'=>'form-label']) }}
                                    {{Form::text('lead_address',null,array('class'=>'form-control','placeholder'=>__('Address'),'required'=>'required'))}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {{Form::label('relationship',__('Relationship'),['class'=>'form-label']) }}
                                    {{Form::text('relationship',null,array('class'=>'form-control','placeholder'=>__('Enter Relationship'),'required'=>'required'))}}
                                </div>
                            </div>
                            <div class="col-12  p-0 modaltitle pb-3 mb-3">
                                <h5 style="margin-left: 14px;">{{ __('Event Details') }}</h5>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {{Form::label('type',__('Event Type'),['class'=>'form-label']) }}
                                    {!! Form::select('type', $type_arr, null,array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-6">
                            <div class="form-group">
                                <label for="venue" class="form-label">{{ __('Venue') }}</label>
                                @foreach($venue as $key => $label)
                                    <div>
                                        <input type="checkbox" name="venue[]" id="{{ $label }}" value="{{ $label }}" 
                                            {{ in_array($label, @$venue_function) ? 'checked' : '' }}>
                                        <label for="{{ $label }}">{{ $label }}</label>
                                    </div>
                                @endforeach  
                            </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                    {!! Form::date('start_date', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                                    {!! Form::date('end_date', null, ['class' => 'form-control', 'required' => 'required']) !!}
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="form-group">
                                    {{Form::label('guest_count',__('Guest Count'),['class'=>'form-label']) }}
                                    {!! Form::number('guest_count', null,array('class' => 'form-control','min'=> 0)) !!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {{ Form::label('function', __('Function'), ['class' => 'form-label']) }}
                                    <div class="checkbox-group">
                                        @foreach($function as $key => $value)
                                            <label>
                                                <input type="checkbox" id="{{ $value->function }}" name="function[]" value="{{  $value->function }}" class="function-checkbox" {{ in_array( $value->function, $function_package) ? 'checked' : '' }}>
                                                {{ $value->function }}
                                            </label><br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-6">
                                <div class="form-group">
                                    {{Form::label('Assign Staff',__('Assign Staff'),['class'=>'form-label']) }}
                                    <select class="form-control" name= 'user'>
                                        @foreach($users as $user)
                                    <option class= "form-control" value= "{{$user->id}}" {{ $user->id == $lead->assigned_user ? 'selected' : '' }}>{{$user->name}}  - {{$user->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-12  p-0 modaltitle pb-3 mb-3">
                                <h5 style="margin-left: 14px;">{{ __('Other Information') }}</h5>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {{Form::label('allergies',__('Allergies'),['class'=>'form-label']) }}
                                    {{Form::text('allergies',null,array('class'=>'form-control','placeholder'=>__('Enter Allergies(if any)')))}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {{Form::label('spcl_req',__('Any Special Requirements'),['class'=>'form-label']) }}
                                    {{Form::textarea('spcl_req',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Any Special Requirements')))}}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    {{Form::label('Description',__('How did you hear about us?'),['class'=>'form-label']) }}
                                    {{Form::textarea('description',null,array('class'=>'form-control','rows'=>2))}}
                                </div>
                            </div> 
                            <div class="col-12  p-0 modaltitle pb-3 mb-3">
                                <h5 style="margin-left: 14px;">{{ __('Estimate Billing Summary Details') }}</h5>
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
                            <div class="col-6">
                                <div class="form-group">
                                {{Form::label('rooms',__('Room'),['class'=>'form-label']) }}
                                <input type="number" name="rooms" value= "{{$lead->rooms}}"  class = "form-control" >    
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {{ Form::label('start_time', __('Estimated Start Time'), ['class' => 'form-label']) }}
                                    {!! Form::input('time', 'start_time', $lead->start_time, ['class' => 'form-control', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {{ Form::label('end_time', __('Estimated End Time'), ['class' => 'form-label']) }}
                                    {!! Form::input('time', 'end_time', $lead->end_time, ['class' => 'form-control', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="text-end">
                                {{ Form::submit(__('Update'), ['class' => 'btn-submit btn btn-primary']) }}
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
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>

    <script>
        $(document).on('change', 'select[name=parent]', function() {
            console.log('h');
            var parent = $(this).val();
            getparent(parent);
        });

        function getparent(bid) {
            console.log(bid);
            $.ajax({
                url: "{{ route('task.getparent') }}",
                type: 'POST',
                data: {
                    "parent": bid,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    $('#parent_id').empty();
                    // {{-- $('#parent_id').append('<option value="">{{__("Select Parent")}}</option>'); --}}

                    $.each(data, function(key, value) {
                        $('#parent_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                    if (data == '') {
                        $('#parent_id').empty();
                    }
                }
            });
        }
    </script>
    <script>
        $(document).on('click', '#billing_data', function() {
            $("[name='shipping_address']").val($("[name='billing_address']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
        });
    </script>
@endpush
