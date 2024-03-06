@php 
$settings = App\Models\Utility::settings();
$campaign_type = explode(',',$settings['campaign_type'])
@endphp
{{Form::open(array('route'=>['importuser'],'method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{Form::label('name',__('Name'),['class'=>'form-label']) }}
            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('phone',__('Phone'),['class'=>'form-label']) }}
            <div class="intl-tel-input">
            <input type="tel" id="phone-input" name="phone" class="phone-input form-control" placeholder="Enter Phone" maxlength="16" required>
            <input type="hidden" name="countrycode" id="country-code">
        </div>
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
            {{Form::label('address',__('Address'),['class'=>'form-label']) }}
            {{Form::text('address',null,array('class'=>'form-control','placeholder'=>__('Enter Address')))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('organization',__('Organization'),['class'=>'form-label']) }}
            {{Form::text('organization',null,array('class'=>'form-control','placeholder'=>__('Enter Organization')))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="category">Select Category</label>
            <select name="category" id="category" class="form-control" required>
                <option selected disabled>Select Category</option>
                @foreach($campaign_type as $campaign)
                <option value="{{$campaign}}" class="form-control">{{$campaign}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-12">
    <div class="form-group">
        <label for="users">Upload File</label>
        <input type="file" name="users" id="users" class="form-control"required>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light"
            data-bs-dismiss="modal">Close</button>
                {{Form::submit(__('Save'),array('class'=>'btn  btn-primary  '))}}
    </div>
</div>
{{Form::close()}}
