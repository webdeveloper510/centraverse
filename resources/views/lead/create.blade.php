@php
$plansettings = App\Models\Utility::plansettings();
$settings = Utility::settings();
$type_arr= explode(',',$settings['event_type']);
$type_arr = array_combine($type_arr, $type_arr);
$venue = explode(',',$settings['venue']);
if(isset($settings['function']) && !empty($settings['function'])){
$function = json_decode($settings['function'],true);
}
if(isset($settings['barpackage']) && !empty($settings['barpackage'])){
$bar_package = json_decode($settings['barpackage'],true);
}
$baropt = ['Open Bar', 'Cash Bar', 'Package Choice'];
if(isset($settings['barpackage']) && !empty($settings['barpackage'])){
$bar_package = json_decode($settings['barpackage'],true);
}
if(isset($settings['additional_items']) && !empty($settings['additional_items'])){
$additional_items = json_decode($settings['additional_items'],true);
}
@endphp
{{Form::open(array('url'=>'lead','method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))}}
<input type="hidden" name="storedid" value="">
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{Form::label('lead_name',__('Lead Name'),['class'=>'form-label']) }}
            {{Form::text('lead_name',old('lead_name') ,array('class'=>'form-control','placeholder'=>__('Enter Lead Name'),'required'=>'required'))}}
            @error('lead_name')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('company_name',__('Company Name'),['class'=>'form-label']) }}
            {{Form::text('company_name',old('company_name'),array('class'=>'form-control','placeholder'=>__('Enter Company Name'),'required'=>'required'))}}
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
            {!! Form::select('type', isset($type_arr) ? $type_arr : '', null,array('class' =>
            'form-control','required'=>'required')) !!}
        </div>
    </div>
    @if(isset($venue) && !empty($venue))
    <div class="col-6">
        <div class="form-group">
            {{ Form::label('venue_selection', __('Venue'), ['class' => 'form-label']) }}
            <div>
                @foreach($venue as $key => $label)
                {{ Form::checkbox('venue[]', $label, false, ['id' => 'venue' . ($key + 1)]) }}
                {{ Form::label($label, $label) }}
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <div class="col-6">
        <div class="form-group">
            {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
            {!! Form::date('start_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
            {!! Form::date('end_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            {{Form::label('guest_count',__('Guest Count'),['class'=>'form-label']) }}
            {!! Form::number('guest_count',old('guest_count'),array('class' => 'form-control','min'=> 0, 'required' => 'required')) !!}
        </div>
    </div>
    @if(isset($function) && !empty($function))
    <div class="col-6">
        <div class="form-group">
            {{ Form::label('function', __('Function'), ['class' => 'form-label']) }}
            <div>
                @foreach($function as $key => $value)
                <div class="form-check" style="    padding-left: 2.75em !important;">
                    {!! Form::checkbox('function[]', $value['function'], null, ['class' => 'form-check-input', 'id' =>
                    'function_' . $key]) !!}
                    {{ Form::label($value['function'], $value['function'], ['class' => 'form-check-label']) }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-6" id="mailFunctionSection">
        @if(isset($function) && !empty($function))
        @foreach($function as $key =>$value)
        <div class="form-group" data-main-index="{{$key}}" data-main-value="{{$value['function']}}"
            id="function_package" style="display: none;">
            {{ Form::label('package', __($value['function']), ['class' => 'form-label']) }}
            @foreach($value['package'] as $k => $package)
            <div class="form-check" data-main-index="{{$k}}" data-main-package="{{$package}}">
                {!! Form::checkbox('package_'.str_replace(' ', '', strtolower($value['function'])).'[]',$package, null,
                ['id' => 'package_' . $key.$k, 'data-function' => $value['function'], 'class' => 'form-check-input'])
                !!}
                {{ Form::label($package, $package, ['class' => 'form-check-label']) }}
            </div>
            @endforeach
        </div>
        @endforeach
        @endif
    </div>
    @if(isset($additional_items) && !empty($additional_items))
    <div class="col-6" id="additionalSection">

        {{ Form::label('additional', __('Additional items'), ['class' => 'form-label']) }}
        @foreach($additional_items as $ad_key =>$ad_value)
        @foreach($ad_value as $fun_key =>$packageVal)
        <div class="form-group" data-additional-index="{{$fun_key}}" data-additional-value="{{key($packageVal)}}"
            id="ad_package" style="display: none;">
            {{ Form::label('additional', __($fun_key), ['class' => 'form-label']) }}
            @foreach($packageVal as $pac_key =>$item)
            <div class="form-check" data-additional-index="{{$pac_key}}" data-additional-package="{{$pac_key}}">
                {!! Form::checkbox('additional_'.str_replace(' ', '_', strtolower($fun_key)).'[]',$pac_key, null,
                ['data-function' => $fun_key, 'class' => 'form-check-input']) !!}
                {{ Form::label($pac_key, $pac_key, ['class' => 'form-check-label']) }}
            </div>
            @endforeach
        </div>
        @endforeach
        @endforeach
    </div>
    @endif

    @endif
    <div class="col-6">
        <div class="form-group">
            {{Form::label('Assign Staff',__('Assign Staff'),['class'=>'form-label']) }}
            <select class="form-control" name='user'>
                <option class="form-control" selected disabled>Select Staff</option>
                @foreach($users as $user)
                <option class="form-control" value="{{$user->id}}">{{$user->name}} ({{$user->type}})</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3">
        <!-- <hr class="mt-2 mb-2"> -->
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
        <!-- <hr class="mt-2 mb-2"> -->
        <h5 style="margin-left: 14px;">{{ __('Estimate Billing Summary Details') }}</h5>
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
                {!! Form::radio('bar'.'_'.str_replace(' ', '', strtolower($value['bar'])), $bar, false, ['id' => 'bar_'
                . $key.$k, 'data-function' => $value['bar'], 'class' => 'form-check-input']) !!}
                {{ Form::label($bar, $bar, ['class' => 'form-check-label']) }}
            </div>
            @endforeach
        </div>
        @endforeach
        @endif
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('rooms',__('Room'),['class'=>'form-label']) }}
            <input type="number" name="rooms" id="" placeholder="Enter No. of Room(if required)" min='0'
                class="form-control" value="{{old('guest_count')}}" required>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{ Form::label('start_time', __('Estimated Start Time (24-Hour Format)'), ['class' => 'form-label']) }}
            {!! Form::input('time', 'start_time', 'null', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{ Form::label('end_time', __('Estimated End Time (24-Hour Format)'), ['class' => 'form-label']) }}
            {!! Form::input('time', 'end_time', 'null', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
</div>
<script>
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
        if (value == 'Package Choice') {
            $('div#barpacakgeoptions').show();
        }
    });
});
$(document).ready(function() {
    var storedId = localStorage.getItem('clickedLinkId');
    $.ajax({
        url: "{{ route('getcontactinfo') }}",
        type: 'POST',
        data: {
            "customerid": storedId,
            "_token": "{{ csrf_token() }}",
        },
        success: function(data) {
            localStorage.removeItem('clickedLinkId');
            $('input[name="name"]').val(data[0].name);
            $('input[name="phone"]').val(data[0].phone);
            $('input[name="email"]').val(data[0].email);
            $('input[name="lead_address"]').val(data[0].address);
            $('input[name="company_name"]').val(data[0].organization);
        }
    });
})

//   $('input[name = "storedid"]').val(storedId);
</script>
{{Form::close()}}