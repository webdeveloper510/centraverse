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
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a></li>
<li class="breadcrumb-item"><a href="{{ route('lead.index') }}">{{__('Leads')}}</a></li>
<li class="breadcrumb-item">{{__('Lead Details')}}</li>
@endsection
@section('action-btn')

@endsection
@section('content')
<?php  
$converted_to_event = App\Models\Meeting::where('attendees_lead',$lead->id)->exists();
?>

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
                                                <th scope="col" class="sort" data-sort="name">{{__('Name')}}</th>
                                                <th scope="col" class="sort" data-sort="name">{{__('Event Name')}}</th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Phone')}}</th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Email')}}</th>
                                                <th scope="col" class="sort" data-sort="budget">{{__('Address')}}</th>
                                                <th scope="col" class="sort">{{__('Status')}}</th>
                                                <th scope="col" class="sort">{{__('Type')}}</th>
                                                <th scope="col" class="sort">{{__('Converted to event')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ucfirst($lead->name)}}</td>
                                                <td>{{ucfirst($lead->company_name ?? '--')}}</td>
                                                <td>{{$lead->phone}}</td>
                                                <td>{{$lead->email ?? '--'}}</td>
                                                <td>{{$lead->address ?? '--'}}</td>
                                                <td>{{ __(\App\Models\Lead::$stat[$lead->lead_status]) }}</td>
                                                <td>{{$lead->type}}</td>
                                                @if(App\Models\Meeting::where('attendees_lead',$lead->id)->exists())
                                                <td> <span
                                                        class="badge bg-success p-2 px-3 rounded">{{ __('Yes') }}</span>
                                                </td>
                                                @else
                                                <td> <span
                                                        class="badge bg-danger p-2 px-3 rounded">{{ __('No') }}</span>
                                                </td>
                                                @endif

                                            </tr>
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
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <h3 class="mt-3">Lead Details ( {{ucfirst($lead->name)}} )</h3>
                                <div class=" mt-4">
                                    <hr>
                                    <dl class="row">
                                        <dt class="col-md-6 need_half"><span
                                                class="h6  mb-0">{{__('Guest Count')}}</span></dt>
                                        <dd class="col-md-6 need_half"><span class="">{{ $lead->guest_count }}</span>
                                        </dd>
                                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Venue ')}}</span>
                                        </dt>
                                        <dd class="col-md-6 need_half"><span
                                                class="">{{ $lead->venue_selection ??'--' }}</span>
                                        </dd>
                                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Function')}}</span>
                                        </dt>
                                        <dd class="col-md-6 need_half"><span class="">{{$lead->function ?? '--'}}</span>
                                        </dd>
                                        <dt class="col-md-6 need_half"><span
                                                class="h6  mb-0">{{__('Assigned User')}}</span></dt>
                                        <dd class="col-md-6 need_half"><span class="">@if($lead->assigned_user != 0)
                                                {{ App\Models\User::where('id', $lead->assigned_user)->first()->name }}
                                                @else
                                                --
                                                @endif</span>
                                        </dd>
                                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Bar')}}</span></dt>
                                        <dd class="col-md-6 need_half"><span class="">{{ $lead->bar ?? '--' }}</span>
                                        </dd>
                                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Package')}}</span>
                                        </dt>
                                        <dd class="col-md-6 need_half"><span class="">
                                                <?php $package = json_decode($lead->func_package,true);
                                                            if(isset($package) && !empty($package)){
                                                                foreach ($package as $key => $value) {
                                                                    echo implode(',',$value);
                                                                } 
                                                            }else{
                                                                echo '--';
                                                            }
                                                            ?>
                                            </span></dd>
                                        <dt class="col-md-6 need_half"><span
                                                class="h6  mb-0">{{__('Additional Items')}}</span>
                                        </dt>
                                        <dd class="col-md-6 need_half"><span class="">
                                                <?php $additional = json_decode($lead->ad_opts,true);
                                                            if(isset($additional) && !empty($additional)){
                                                                foreach ($additional as $key => $value) {
                                                                    echo implode(',',$value);
                                                                } 
                                                            }else{
                                                                echo "--";
                                                            }
                                                                
                                                            ?>
                                            </span></dd>
                                        <dt class="col-md-6 need_half"><span
                                                class="h6  mb-0">{{__('Description')}}</span></dt>
                                        <dd class="col-md-6 need_half"><span
                                                class="">{{ $lead->description ??' --' }}</span></dd>
                                        <dt class="col-md-6 need_half"><span
                                                class="h6  mb-0">{{__('Any Special Requests')}}</span>
                                        </dt>
                                        <dd class="col-md-6 need_half"><span class="">{{$lead->spcl_req ?? '--'}}</span>
                                        </dd>
                                        <dt class="col-md-6 need_half"><span
                                                class="h6  mb-0">{{__('Proposal Response')}}</span>
                                        </dt>
                                        <dd class="col-md-6 need_half"><span
                                                class="">@if(App\Models\Proposal::where('lead_id',$lead->id)->exists())
                                                <?php  $proposal = App\Models\Proposal::where('lead_id',$lead->id)->first()->notes; ?>

                                                {{$proposal}}
                                                @else --
                                                @endif</span></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($converted_to_event)
            <?php $eventdetails = App\Models\Meeting::where('attendees_lead',$lead->id)->first();?>
                @if($eventdetails)
                <?php $existingbill = App\Models\Billing::where('event_id',$eventdetails->id)->exists();  ?>
                <div class="container-fluid xyz mt-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body table-border-style">
                                    <div class=" mt-4">
                                        <dl class="row">
                                            <dt class="col-md-4 need_half"><span
                                                    class="h6  mb-0">{{__('Meal Preference')}}</span></dt>
                                            <dd class="col-md-8 need_half"><span
                                                    class="">{{ $eventdetails->meal ?? '--'}}</span></dd>

                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body table-border-style">
                                    <div class=" mt-4">
                                        <dl class="row">
                                            <dt class="col-md-4 need_half"><span
                                                    class="h6  mb-0">{{__('Food Description')}}</span></dt>
                                            <dd class="col-md-8 need_half"><span
                                                    class="">{{ $eventdetails->food_description ?? '--'}}</span></dd>
                                        </dl>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body table-border-style">
                                    <div class=" mt-4">
                                        <dl class="row">
                                            <dt class="col-md-4 need_half"><span
                                                    class="h6  mb-0">{{__('Bar Description ')}}</span></dt>
                                            <dd class="col-md-8 need_half"><span
                                                    class="">{{ $eventdetails->bar_description ??'--' }}</span>
                                            </dd>
                                        </dl>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body table-border-style">
                                    <div class=" mt-4">
                                        <dl class="row">

                                            <dt class="col-md-4 need_half"><span class="h6  mb-3">{{__('Set-up')}}</span>
                                            </dt>
                                            <dd class="col-md-8 need_half"><span class="">
                                                    @if($eventdetails->setup_plans != '')
                                                    <img src="{{ Storage::url('app/public/'.$eventdetails->setup_plans) }}"
                                                        style="    width: 70%;" alt="">

                                                    @else
                                                    --
                                                    @endif
                                                </span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    @if($existingbill)
                    <?php  
                            $billdetails=  App\Models\Billing::where('event_id',$eventdetails->id)->first();
                            $billing_data = unserialize($billdetails->data);    
                            $total = [];
                            $bar_pck = json_decode($eventdetails['bar_package'], true);
                            $payments = App\Models\PaymentLogs::where('event_id',$eventdetails->id)->exists();
                        
                        ?>
                   <div class="container-fluid mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div id="useradd-1" class="card shadow-sm">
                <div class="card-body table-border-style">
                    <h3 class="mt-3 text-center">Billing Summary - Estimate</h3>
                    <div class="mt-4">
                        <hr>
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Name: {{$eventdetails['name']}}</th>
                                    <th colspan="2"></th>
                                    <th colspan="3">Bill created on: <?php echo date("d/m/Y"); ?></th>
                                    <th>Event: {{$eventdetails['type']}}</th>
                                </tr>
                                <tr style="background-color:#063806;">
                                    <th style="color:#ffffff; text-align:left;">Description</th>
                                    <th colspan="2" style="color:#ffffff;">&nbsp;</th>
                                    <th style="color:#ffffff; text-align:right;">Cost</th>
                                    <th style="color:#ffffff; text-align:right;">Quantity</th>
                                    <th style="color:#ffffff; text-align:right;">Total Price</th>
                                    <th style="color:#ffffff;">Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Venue Rental</td>
                                    <td colspan="2"></td>
                                    <td>${{$billing_data['venue_rental']['cost']}}</td>
                                    <td>{{$billing_data['venue_rental']['quantity']}}</td>
                                    <td>${{$total[] = $billing_data['venue_rental']['cost'] * $billing_data['venue_rental']['quantity']}}</td>
                                    <td>{{$eventdetails['venue_selection']}}</td>
                                </tr>
                                <tr>
                                    <td>Brunch / Lunch / Dinner Package</td>
                                    <td colspan="2"></td>
                                    <td>${{$billing_data['food_package']['cost']}}</td>
                                    <td>{{$billing_data['food_package']['quantity']}}</td>
                                    <td>${{$total[] = $billing_data['food_package']['cost'] * $billing_data['food_package']['quantity']}}</td>
                                    <td>{{$eventdetails['function']}}</td>
                                </tr>
                                <tr>
                                    <td>Bar Package</td>
                                    <td colspan="2"></td>
                                    <td>${{$billing_data['bar_package']['cost']}}</td>
                                    <td>{{$billing_data['bar_package']['quantity']}}</td>
                                    <td>${{$total[] = $billing_data['bar_package']['cost'] * $billing_data['bar_package']['quantity']}}</td>
                                    <td>{{implode(',',$bar_pck)}}</td>
                                </tr>
                                <tr>
                                    <td>Hotel Rooms</td>
                                    <td colspan="2"></td>
                                    <td>${{$billing_data['hotel_rooms']['cost']}}</td>
                                    <td>{{$billing_data['hotel_rooms']['quantity']}}</td>
                                    <td>${{$total[] = $billing_data['hotel_rooms']['cost'] * $billing_data['hotel_rooms']['quantity']}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Tent, Tables, Chairs, AV Equipment</td>
                                    <td colspan="2"></td>
                                    <td>${{$billing_data['equipment']['cost']}}</td>
                                    <td>{{$billing_data['equipment']['quantity']}}</td>
                                    <td>${{$total[] = $billing_data['equipment']['cost'] * $billing_data['equipment']['quantity']}}</td>
                                    <td></td>
                                </tr>
                                @if(!$billing_data['setup']['cost'] == '')
                                <tr>
                                    <td>Welcome / Rehearsal / Special Setup</td>
                                    <td colspan="2"></td>
                                    <td>${{$billing_data['setup']['cost']}}</td>
                                    <td>{{$billing_data['setup']['quantity']}}</td>
                                    <td>${{$total[] = $billing_data['setup']['cost'] * $billing_data['setup']['quantity']}}</td>
                                    <td></td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Special Requests / Others</td>
                                    <td colspan="2"></td>
                                    <td>${{$billing_data['special_req']['cost']}}</td>
                                    <td>{{$billing_data['special_req']['quantity']}}</td>
                                    <td>${{$total[] = $billing_data['special_req']['cost'] * $billing_data['special_req']['quantity']}}</td>
                                    <td>{{$billing_data['special_req']['notes']}}</td>
                                </tr>
                                <tr>
                                    <td>Additional Items</td>
                                    <td colspan="2"></td>
                                    <td>${{$billing_data['additional_items']['cost']}}</td>
                                    <td>{{$billing_data['additional_items']['quantity']}}</td>
                                    <td>${{$total[] = $billing_data['additional_items']['cost'] * $billing_data['additional_items']['quantity']}}</td>
                                    <td>{{$billing_data['additional_items']['notes']}}</td>
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td colspan="2"></td>
                                    <td colspan="3"></td>
                                    <td></td>
                                </tr>
                                <tr class="table-primary">
                                    <td>Total</td>
                                    <td colspan="2"></td>
                                    <td colspan="2"></td>
                                    <td>${{array_sum($total)}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Sales, Occupancy Tax</td>
                                    <td colspan="2"></td>
                                    <td colspan="2"></td>
                                    <td>${{ 7 * array_sum($total) / 100 }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Service Charges & Gratuity</td>
                                    <td colspan="2"></td>
                                    <td colspan="2"></td>
                                    <td>${{ 20 * array_sum($total) / 100 }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td colspan="2"></td>
                                    <td colspan="2"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr class="table-success">
                                    <td>Grand Total / Estimated Total</td>
                                    <td colspan="2"></td>
                                    <td colspan="2"></td>
                                    <td>${{$grandtotal = array_sum($total) + 20 * array_sum($total) / 100 + 7 * array_sum($total) / 100}}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                       @if($payments)
                       <?php $payinfo = App\Models\PaymentLogs::where('event_id',$eventdetails->id)->get(); ?>
                       <div class="col-lg-12">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <div class="table-responsive overflow_hidden">
                                    <table id="datatable" class="table datatable align-items-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">{{ __('Created On') }}</th>
                                                <th scope="col" class="sort" data-sort="status">{{ __('Name') }}</th>
                                                <th scope="col" class="sort" data-sort="completion">{{ __('Transaction Id') }}</th>
                                                <th>{{__('Invoice')}}</th>
                                                <th scope="col" class="sort" data-sort="completion">{{ __('Amount Recieved') }}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($payinfo as $payment)
                                            
                                            <tr>

                                                <td>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $payment->created_at)->format('M d, Y')}}</td>
                                                <td>{{$payment->name_of_card}}</td>
                                                <td>{{$payment->transaction_id}}</td>
                                                <td><a href="{{ Storage::url('app/public/Invoice/'.$payment->event_id.'/'.$payment->invoices) }}"download style="    color: #1551c9 !important;">{{ucfirst($payment->invoices)}}</a></td>
                                                <td>${{$payment->amount + (isset($billdetails)? $billdetails->deposits : 0 )}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                       @endif
                    @endif
                @endif
            @endif


        </div>
    </div>
</div>
<div class="container-fluid xyz mt-3">
    <div class="row">
        <div class="col-lg-6">
            <div class="card" >
                <div class="card-body table-border-style">
                    <h3>Upload Documents</h3>
                    {{Form::open(array('route' => ['lead.uploaddoc', $lead->id],'method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))}}
                    <label for="customerattachment">Attachment</label>
                    <input type="file" name="customerattachment" id="customerattachment" class="form-control" required>
                    <input type="submit" value="Submit" class="btn btn-primary mt-4" style="float: right;">
                    {{Form::close()}}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body table-border-style">
                    <h3>Attachments</h3>
                    <div class="table-responsive ">
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
        </div>
    </div>
</div>
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