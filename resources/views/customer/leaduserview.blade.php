@extends('layouts.admin')
@section('page-title')
{{__('Lead Customer')}}
@endsection
@section('title')
<div class="page-header-title">
    {{__('Lead Customer')}}
</div>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
<li class="breadcrumb-item"><a href="{{ route('siteusers') }}">{{__('Customers')}}</a></li>
<li class="breadcrumb-item"><a href="{{ route('lead_customers') }}">{{__('Lead Customers')}}</a></li>
<li class="breadcrumb-item">{{__('Customer Details')}}</li>
@endsection
@section('action-btn')

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
                                <div class="row align-items-center">
                                <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0">{{__('Lead Status')}}</small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class="">
                                            {{ __(\App\Models\Lead::$stat[$lead->lead_status]) }}
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="h6  mb-3 mb-md-0">{{__('Name')}} </small>
                                    </div>
                                    <div class="col-md-5">
                                        <span class="">{{ $lead->name }}</span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0">{{__('Email')}}</small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class="">{{ $lead->email }}</span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0">{{__('Phone')}}</small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class="">{{ $lead->phone }}</span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0">{{__('Address')}}</small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class="">{{ $lead->lead_address ?? '--'}}</span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0">{{__('Lead Type')}}</small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class="">{{ $lead->type }}</span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0">{{__('Date')}}</small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class=""> @if($lead->start_date == $lead->end_date)
                                            {{ \Auth::user()->dateFormat($lead->start_date) }}
                                            @else
                                            {{ \Auth::user()->dateFormat($lead->start_date) }} -
                                            {{ \Auth::user()->dateFormat($lead->end_date) }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0">{{__('Status')}}</small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class="">
                                            {{ __(\App\Models\Lead::$status[$lead->status]) }}
                                        </span>
                                    </div>
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               

                <div class="container-fluid xyz mt-3">
                    <div class="row">
                        
                    <div class="col-lg-6">
                            <div class="card" id="useradd-1">
                                <div class="card-body table-border-style">
                                    <h3>Attachments</h3>
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Attachment</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($docs as $doc)
                                            @if(Storage::disk('public')->exists($doc->filepath))
                                            <tr>
                                                <td>{{$doc->filename}}</td>
                                                <td><a href="{{ Storage::url('app/public/'.$doc->filepath) }}" download
                                                        style="color: teal;" title="Download">View Document <i
                                                            class="fa fa-download"></i></a>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card" id="useradd-1">
                                <div class="card-body table-border-style">
                                    <h3>Notes</h3>
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Notes</th>
                                            <th>Created By</th>
                                            <th>Date</th>
                                        </thead>
                                        <tbody>
                                            @foreach($notes as $note)
                                            <tr>
                                                <td>{{ucfirst($note->notes)}}</td>
                                                <td>{{(App\Models\User::where('id',$note->created_by)->first()->name)}}
                                                </td>
                                                <td>{{\Auth::user()->dateFormat($note->created_at)}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card" id="useradd-1">
                                <div class="card-body table-border-style">
                                    <h3>Upload Documents</h3>
                                    {{Form::open(array('route' => ['lead.uploaddoc', $lead->id],'method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))}}
                                    <label for="customerattachment">Attachment</label>
                                    <input type="file" name="customerattachment" id="customerattachment"
                                        class="form-control" required>
                                    <input type="submit" value="Submit" class="btn btn-primary mt-4"
                                        style="float: right;">
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body table-border-style">
                                    <h3>Add Notes/Comments</h3>
                                    <form method="POST" id="addnotes">
                                        @csrf
                                        <label for="notes">Notes</label>
                                        <input type="text" class="form-control" name="notes" required>
                                        <input type="submit" value="Submit" class="btn btn-primary mt-4"
                                            style=" float: right;">
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <style>
.modal-dialog.modal-md {
    max-width: 850px;
}
</style> -->
    @endsection
    @push('script-page')
    <script>
    $(document).ready(function() {
        $('#addnotes').on('submit', function(e) {
            e.preventDefault();
            var id = <?php echo  $lead->id; ?>;
            var notes = $('input[name="notes"]').val();
            var createrid = <?php echo Auth::user()->id ;?>;

            $.ajax({
                url: "{{ route('addleadnotes', ['id' => $lead->id]) }}", // URL based on the route with the actual user ID
                type: 'POST',
                data: {
                    "notes": notes,
                    "createrid": createrid,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    location.reload();
                }
            });

        });
    });
    </script>
    @endpush