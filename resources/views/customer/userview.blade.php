@extends('layouts.admin')
@section('page-title')
{{ __('External Customers') }}
@endsection
@section('title')
{{ __('External Customers') }}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
<li class="breadcrumb-item">{{ __('External Customers') }}</li>
@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">

        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12 order-lg-1">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <small class="h6  mb-3 mb-md-0">{{__('Name')}} </small>
                                    </div>
                                    <div class="col-md-5">
                                        <span class="">{{ $users->name }}</span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0">{{__('Email')}}</small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class="">{{ $users->email }}</span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0">{{__('Phone')}}</small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class="">{{ $users->phone }}</span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0">{{__('Address')}}</small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class="">{{ $users->address }}</span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0">{{__('Category')}}</small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class="">{{ $users->category }}</span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0">{{__('Notes')}}</small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class="">{{ $users->notes }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Upload Documents</h3>
                                <form action="{{route('upload-info',urlencode(encrypt($users->id)))}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <label for="customerattachment">Attachment</label>
                                    <input type="file" name="customerattachment" id="customerattachment"
                                        class="form-control" required>
                                    <input type="submit" value="Submit" class="btn btn-primary mt-2">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Attachments</h3>
                                <?php   
                                    $files = Storage::files('app/public/External_customer/'.$users->id);
                                ?>
                                @if(isset($files) && !empty($files))

                                <div class="col-md-12" style="    display: flex;">
                                    @foreach ($files as $file)
                                    <div>
                                        <p>{{ basename($file) }}</p>
                                        <div>

                                            @if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf')
                                            <img src="{{ asset('extension_img/pdf.png') }}" alt="File"
                                                style="max-width: 100px; max-height: 150px;">
                                            @else
                                            <img src="{{ asset('extension_img/doc.png') }}" alt="File"
                                                style="max-width: 100px; max-height: 150px;">
                                            @endif
                                            <a href="{{ Storage::url($file) }}" download style=" position: absolute;">
                                                <i class="fa fa-download"></i></a>

                                        </div>

                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<style>
.list-group-flush .list-group-item {
    background: none;
}
</style>