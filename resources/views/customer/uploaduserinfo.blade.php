@php
$settings = App\Models\Utility::settings();
$campaign_type = explode(',',$settings['campaign_type']);
@endphp
<div class="form-group col-md-12">
    <div class="badges">
        <ul class="nav nav-tabs tabActive" style="border-bottom: none">
            <li class="badge rounded p-2 m-1 px-3 bg-primary">
                <a style="color: white;font-size: larger;" data-toggle="tab" href="#barmenu0" class="active">Individual
                    Customer</a>
            </li>
            <li class="badge rounded p-2 m-1 px-3 bg-primary">
                <a style="color: white;    font-size: larger;" data-toggle="tab" href="#barmenu1" class="">Bulk
                    Customer</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="barmenu0" class="tab-pane fade in active show mt-5">
                {{Form::open(array('route'=>['importuser'],'method'=>'post','enctype'=>'multipart/form-data'))}}
                <div class="row">
                    <div class="col-6">
                        <input type="hidden" name="customerType" value="addForm" />
                        <div class="form-group">
                            {{Form::label('name',__('Name'),['class'=>'form-label']) }}
                            {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))}}
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            {{Form::label('phone',__('Phone'),['class'=>'form-label']) }}
                            <div class="intl-tel-input">
                                <input type="tel" id="phone-input" name="phone" class="phone-input form-control"
                                    placeholder="Enter Phone" maxlength="16" required>
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
                                <option selected disabled value="">Select Category</option>
                                @foreach($campaign_type as $campaign)
                                <option value="{{$campaign}}" class="form-control">{{$campaign}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group" style="margin-top: 35px;">
                            {{Form::label('name',__('Active'),['class'=>'form-label']) }}
                            <input type="checkbox" class="form-check-input" name="is_active" checked>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            {{Form::submit(__('Save'),array('class'=>'btn btn-primary  '))}}
                        </div>
                    </div>
                </div>
                {{Form::close()}}
            </div>
            <div id="barmenu1" class="tab-pane fade mt-5">
                {{Form::open(array('route'=>['importuser'],'method'=>'post','enctype'=>'multipart/form-data'))}}
                <div class="row">
                    <input type="hidden" name="customerType" value="uploadFile" />
                    <div class="col-12">
                        <div class="form-group">
                            <label for="category">Select Category</label>
                            <select name="category" id="category" class="form-control" required>
                                <option selected disabled value="">Select Category</option>
                                @foreach($campaign_type as $campaign)
                                <option value="{{$campaign}}" class="form-control">{{$campaign}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="users">Upload File</label>
                            <input type="file" name="users" id="users" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            {{Form::submit(__('Save'),array('class'=>'btn btn-primary  '))}}
                        </div>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
<style>
    li:has(> a.active) {
        border-color: #2980b9;
        box-shadow: 0 0 15px rgba(41, 128, 185, 0.8);
    }
</style>