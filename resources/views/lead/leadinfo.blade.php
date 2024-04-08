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
<li class="breadcrumb-item">{{__('Lead Information')}}</li>
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
                                                @if(Gate::check('Show Lead') || Gate::check('Edit Lead') ||
                                                Gate::check('Delete Lead'))
                                                <th scope="col" class="text-end">{{__('Action')}}</th>
                                                @endif
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
                                                <td>
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
                                                </td>
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
            <h4 class="m-b-10">
                <div class="page-header-title">
                    {{__(' Billing Details')}}
                </div>
            </h4>

            <div class="container-fluid xyz mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
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
            <h4 class="m-b-10">
                <div class="page-header-title">
                    {{__('Documents')}}
                </div>
            </h4>

            <div class="container-fluid xyz mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body" style="    display: inline-flex;">
        @foreach($docs as $doc)
        <div style=" width: 18%;">
        @if(Storage::disk('public')->exists($doc->filepath))
        @if(pathinfo($doc->filepath, PATHINFO_EXTENSION) == 'pdf')
        <img src="{{ asset('extension_img/pdf.png') }}" style="       width: 50%;
    height: auto;">
        @else
        <img src="{{ asset('extension_img/doc.png') }}" style="         width: 40%;
    height: auto;">
        @endif
        <h6>{{$doc->filename}}</h6>
        <p><a href="{{ Storage::url('app/public/'.$doc->filepath) }}" download><i class="fa fa-download"></i></a></p>

        @endif

        </div>
        <!-- Assuming $folder and $filename are passed to the view -->
       
        @endforeach
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