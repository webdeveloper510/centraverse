@extends('layouts.admin')
@section('page-title')
{{__('Lead Information')}}
@endsection
@section('title')
<div class="page-header-title">
    {{__('Lead Information')}}
</div>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
<li class="breadcrumb-item"><a href="{{ route('lead.index') }}">{{__('Leads')}}</a></li>
<li class="breadcrumb-item">{{__('Lead Details')}}</li>
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
                                <div class="table-responsive">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <!-- <th scope="col" class="sort" data-sort="name">{{__('Lead')}}</th> -->
                                                <th scope="col" class="sort" data-sort="name">{{__('Name')}}</th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Phone')}}</th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Email')}}</th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Address')}}</th>
                                                <th scope="col" class="sort">{{__('Status')}}</th>
                                                <th scope="col" class="sort">{{__('Type')}}</th>
                                                <th scope="col" class="sort">{{__('Converted events')}}</th>
                                                <!-- @if(Gate::check('Show Lead') || Gate::check('Edit Lead') ||
                                                Gate::check('Delete Lead')) -->
                                                <!-- <th scope="col" class="text-end">{{__('Action')}}</th> -->
                                                <!-- @endif -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($leads as $lead)
                                            <tr>
                                                <td>{{$lead->name}}</td>
                                                <td>{{$lead->phone}}</td>
                                                <td>{{$lead->email ?? '--'}}</td>
                                                <td>{{$lead->address ?? '--'}}</td>

                                                <td>{{ __(\App\Models\Lead::$stat[$lead->lead_status]) }}</td>
                                                <td>{{$lead->type}}</td>
                                                @if(App\Models\Meeting::where('attendees_lead',$lead->id)->exists())
                                                <td> Yes </td>
                                                @else
                                                <td> No </td>
                                                @endif
                                                <!-- <td>
                                                    <div class="action-btn bg-info ms-2" style="float: right;">
                                                        <a href="#" data-size="md"
                                                            data-url="{{route('lead.uploads',$lead->id)}}"
                                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                                            data-title="{{ __('Upload Document') }}"
                                                            title="{{ __('Upload Document') }}"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-upload"></i>
                                                        </a>
                                                    </div>
                                                    @if(App\Models\LeadDoc::where('lead_id',$lead->id)->exists())
                                                    <div class="action-btn bg-warning ms-2" style="float: right;">
                                                        <a href="#" data-size="md"
                                                            data-url="{{ route('lead.uploaded_docs',$lead->id) }}"
                                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                                            data-title="{{ __('View Document') }}"
                                                            title="{{ __(' View Documents') }}"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                    @endif
                                                    @if(!App\Models\Meeting::where('attendees_lead',$lead->id)->exists()
                                                    && $lead->status == 2)
                                                    <div class="action-btn bg-secondary ms-2" style="    float: right;">
                                                        <a href="{{ route('meeting.create',['meeting',0]) }}?lead={{urlencode(encrypt($lead->id)) }}"
                                                            data-size="md" data-url="#" data-id="{{$lead->id}}"
                                                            data-bs-toggle="tooltip" data-title="{{ __('Convert') }}"
                                                            title="{{ __('Convert To Event') }}"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="fas fa-plus"></i> </a>
                                                    </div>
                                                    @endif
                                                </td> -->
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <h4 class="m-b-10">
                <div class="page-header-title">
                    {{__(' Billing Details')}}
                </div>
            </h4> -->

            <div class="container-fluid xyz mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                       
                            <div class="card-body table-border-style">
                            <h3>Billing Details</h3>
                                <div class="table-responsive mt-4">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <!-- <th scope="col" class="sort" data-sort="name">{{__('Lead')}}</th> -->
                                                <th scope="col" class="sort" data-sort="name">{{__('Created On')}}</th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Name')}}</th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Amount')}}</th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Due')}}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($leads as $lead)
                                            <?php 
                                $event= App\Models\Meeting::where('attendees_lead',$lead->id)->first();
                                
                                    if($event)
                                    {
                                        $billing = App\Models\PaymentLogs::where('event_id',$event->id)->get();
                                        
                                            $lastpaid = App\Models\PaymentLogs::where('event_id',$event->id)->orderby('id','DESC')->first();
                                        
                                            if(isset($lastpaid) && !empty($lastpaid)){
                                            $amount = App\Models\PaymentInfo::where('event_id',$event->id)->first();
                                            $amountpaid = 0;
                                            foreach($billing as $pay){
                                                $amountpaid += $pay->amount;
                                            }
                                            echo "<tr>";
                                            echo "<td>".Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lastpaid->created_at)->format('M d, Y')."</td>";
                                            echo "<td>".$lead->name."</td>";
                                            echo "<td>".$amount->amount."</td>";
                                            echo "<td>".$amount->amounttobepaid - $amountpaid."</td>";
                                            echo "</tr>";
                                        }
                                    }else{
                                        echo "<tr>";
                                        echo "<td></td>";
                                        echo "<td style='text-align: center;'><b><h4 class='text-secondary'>Lead Not Converted to Event Yet.</h4><b></td>";
                                        echo "<td></td>";
                                        echo "</tr>";
                                    }
                                ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <h4 class="m-b-10">
                <div class="page-header-title">
                    {{__('Documents')}}
                </div>
            </h4> -->

            <div class="container-fluid xyz mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Upload Documents</h3>
                                {{Form::open(array('route' => ['lead.uploaddoc', $lead->id],'method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))}}
                                <label for="customerattachment">Attachment</label>
                                <input type="file" name="customerattachment" id="customerattachment"
                                    class="form-control" required>
                                <input type="submit" value="Submit" class="btn btn-primary mt-4" style="float: right;">
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                    
                    <!-- <div class="col-lg-6">
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
                    </div> -->
                    
                    <div class="col-lg-12">
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
                    <!-- <div class="col-lg-6">
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
                                            <td>{{(App\Models\User::where('id',$note->created_by)->first()->name)}}</td>
                                            <td>{{\Auth::user()->dateFormat($note->created_at)}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
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