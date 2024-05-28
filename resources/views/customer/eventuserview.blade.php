@extends('layouts.admin')
@section('page-title')
{{__('Event Customer')}}
@endsection
@section('title')
<div class="page-header-title">
    {{__('Event Customer')}}
</div>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item"><a href="{{ route('userlist') }}">{{__('Customers')}}</a></li>
<li class="breadcrumb-item"><a href="{{ route('event_customers') }}">{{__('Event Customers')}}</a></li>
<li class="breadcrumb-item">{{__('Customer Details')}}</li>
@endsection
@section('action-btn')
@can('Create Meeting')
<div class="col-12 text-end mt-3">
    <a href="{{ route('meeting.create',['meeting',0]) }}">
        <button data-bs-toggle="tooltip" title="{{ __('Create') }}" class="btn btn-sm btn-primary btn-icon m-1">
            <i class="ti ti-plus"></i></button>
    </a>
</div>
@endcan
@endsection
@section('content')

<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz p0">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="row align-items-center">
                                <div class="table-responsive">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">{{__('Name')}}</th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Event Type')}}</th>
                                                <th scope="col" class="sort">{{__('Guest Count')}}</th>
                                                <th scope="col" class="sort">{{__('Event Date')}}</th>
                                                <th scope="col" class="sort">{{__('Function')}}</th>
                                                <th scope="col" class="sort">{{__('Package')}}</th>
                                                <th scope="col" class="sort">{{__('Bar')}}</th>
                                                <th scope="col" class="sort">{{__('Status')}}</th>
                                                <th scope="col" class="sort">{{__('Billing Amount')}}</th>
                                                <th scope="col" class="sort">{{__('Amount Paid')}}</th>
                                                <th scope="col" class="sort">{{__('Created On')}}</th> 

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($events as $event)
                                            <?php 
                                            if(isset($event->func_package) && !empty($event->func_package)){
                                                $package = json_decode($event->func_package,true);
                                            }
                                            if(isset($event->ad_opts) && !empty($event->ad_opts)){
                                                $additional = json_decode($event->ad_opts,true);
                                            }
                                            if(isset($event->bar_package) && !empty($event->bar_package)){
                                                $bar = json_decode($event->bar_package,true);
                                            }
                                            $pay = App\Models\PaymentLogs::where('event_id',$event->id)->get();
                                            $total = 0;
                                            $latefee = 0;
                                                $adjustments = 0;
                                            foreach($pay as $p){
                                            $total += $p->amount;
                                            }
                                            $info = App\Models\PaymentInfo::where('event_id',$event->id)->get();
                                                foreach($info as $inf){
                                                $latefee += $inf->latefee;
                                                $adjustments += $inf->adjustments;
                                                }
                                            if(App\Models\Billing::where('event_id',$event->id)->exists()){
                                                $deposit = App\Models\Billing::where('event_id',$event->id)->first();
                                            }

                                        ?>
                                            <tr>
                                                <td>
                                                @if($event->attendees_lead != 0)
                                                        <?php $leaddata = \App\Models\Lead::where('id',$event->attendees_lead)->first() ?>
                                                        <a href="{{ route('lead.info',urlencode(encrypt($leaddata->id)))}}" data-size="md"
                                                        data-title="{{ __('Event Details') }}"
                                                        class="action-item text-primary"
                                                        style=" color: #1551c9 !important;">
                                                        {{ucfirst($leaddata->leadname)}}
                                                        </a>
                                                        @else
                                                           <a href="{{route('meeting.detailview',urlencode(encrypt($event->id)))}}"
                                                            data-size="md" title="{{ __('Detailed view ') }}"
                                                            class="action-item text-primary"  style=" color: #1551c9 !important;">
                                                            {{ucfirst($event->eventname)}}</a>
                                                        @endif
                                                </td>
                                                <td><b> {{ ucfirst($event->type) }}</b></td>
                                                <td>
                                                    <span class="budget">{{ $event->guest_count }}</span>
                                                </td>
                                                <td>{{\Auth::user()->dateFormat($event->start_date)}}</td>

                                                <td>{{ ucfirst($event->function) }}</td>
                                                <td>
                                                   <?php
                                                        foreach ($package as $key => $value){
                                                            echo implode(',',$value);
                                                        }
                                                   ?>
                                                </td>
                                                <td>{{($event->bar)}}</td>

                                                <td>{{ __(\App\Models\Meeting::$status[$event->status]) }}</td>
                                                <td>${{($event->total)}}</td>
                                                <td>${{ $total + ((isset($deposit)) ?  $deposit->deposits  : 0) }}</td>
                                                <td>{{\Auth::user()->dateFormat($event->created_at)}}</td>

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
                                    {{Form::open(array('route' => ['event.uploaddoc', $event->id],'method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))}}

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
                                    <form method="POST" id="addeventnotes">
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
        $('#addeventnotes').on('submit', function(e) {
            e.preventDefault();
            var id = <?php echo  $event->id; ?>;
            var notes = $('input[name="notes"]').val();
            var createrid = <?php echo Auth::user()->id ;?>;

            $.ajax({
                url: "{{ route('addeventnotes', ['id' => $event->id]) }}", // URL based on the route with the actual user ID
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