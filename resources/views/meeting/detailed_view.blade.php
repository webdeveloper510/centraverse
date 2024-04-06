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
$payments = App\Models\PaymentLogs::where('event_id',$event->id)->get();
$payinfo = App\Models\PaymentInfo::where('event_id',$event->id)->orderby('id','desc')->first();

?>
<div class="row">
    <div class="col-lg-12">
        <dl class="row">
            <dt class="col-md-6"><span class="h6  mb-0">{{__('Event')}}</span></dt>
            @if($event->attendees_lead != 0)
            <dd class="col-md-6"><span
                    class="">{{ !empty($event->attendees_leads->leadname)?$event->attendees_leads->leadname:'--' }}</span>
            </dd>
            @else
            <dd class="col-md-6"><span class="">{{$event->eventname}}</span></dd>
            @endif
            <dt class="col-md-6"><span class="h6  mb-0">{{__('Event Type')}}</span></dt>
            <dd class="col-md-6"><span class="">{{$event->type}}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Date')}}</span></dt>
            @if($event->start_date == $event->end_date)
            <dd class="col-md-6"><span class="">{{\Auth::user()->dateFormat($event->start_date)}}</span></dd>
            @else
            <dd class="col-md-6"><span class="">{{\Auth::user()->dateFormat($event->start_date)}} -
                    {{\Auth::user()->dateFormat($event->end_date)}}</span></dd>
            @endif

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Time')}}</span></dt>
            <dd class="col-md-6"><span class="">{{date('h:i A', strtotime($event->start_time))}} -
                    {{date('h:i A', strtotime($event->end_time))}}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Guest Count')}}</span></dt>
            <dd class="col-md-6"><span class="">{{$event->guest_count}}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Venue')}}</span></dt>
            <dd class="col-md-6"><span class="">{{$event->venue_selection}}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Room')}}</span></dt>
            <dd class="col-md-6"><span class="">@if($event->room != 0){{$event->room}}@else -- @endif</span></dd>
            @if(isset($package) && !empty($package))
            <dt class="col-md-6"><span class="h6  mb-0">{{__('Package')}}</span></dt>
            <dd class="col-md-6"><span class="">@foreach ($package as $key => $value)
                    {{implode(',',$value)}}
                    @endforeach
                </span>
            </dd>
            @endif

            @if(isset($additional) && !empty($additional))
            <dt class="col-md-6"><span class="h6  mb-0">{{__('Additional Items')}}</span></dt>
            <dd class="col-md-6"><span class="">@foreach ($additional as $key => $value)
                    {{implode(',',$value)}}
                    @endforeach
                </span>
            </dd>
            @endif
            @if(isset($bar) && !empty($bar))
            <dt class="col-md-6"><span class="h6  mb-0">{{__('Bar Package')}}</span></dt>
            <dd class="col-md-6"><span class="">
                    {{implode(',',$bar)}}
                </span>
            </dd>
            @endif
            <hr class="mt-5">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h3>{{ __('Setup') }}</h3>
                </div>
            </div>
            <hr>
            <img src="{{$event->floor_plan}}" alt="">
        </dl>
    </div>
    @php
    $files = Storage::files('app/public/Event/'.$event->id);
    @endphp
    <hr>
    <div class="row">
        @if(isset($files) && !empty($files))
        <h3>Attachments</h3>
        <hr>
        <div class="col-md-12">
            @foreach ($files as $file)
            <div>
                <!-- Display file name -->
                <p>{{ basename($file) }}</p>
                <div>

                    <!-- Display preview if it's a PDF -->
                    @if (pathinfo($file, PATHINFO_EXTENSION) === 'pdf')
                    <img src="{{ asset('extension_img/pdf.png') }}" alt="File"
                        style="max-width: 100px; max-height: 150px;">
                    <!-- <iframe src="{{ Storage::url($file) }}" width="50%" height="300px"></iframe> -->
                    @else
                    <img src="{{ asset('extension_img/doc.png') }}" alt="File"
                        style="max-width: 100px; max-height: 150px;">
                    <!-- Placeholder icon for non-PDF files -->
                    @endif
                    <a href="{{ Storage::url($file) }}" download style=" position: absolute;"> <i
                            class="fa fa-download"></i></a>

                    <!-- Download link -->
                </div>

            </div>
            @endforeach
        </div>
        @endif
    </div>
    <hr>
    <div class="row">
        <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-3">
            <h5 style="margin-left: 14px;">{{ __('Billing Details') }}</h5>
        </div>
        @if(isset($payments) && !empty($payments))
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Created On</th>
                        <th scope="col">Name</th>
                        <th scope="col">Transaction Id</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Amount Recieved</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <td>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $payment->created_at)->format('M d, Y')}}</td>
                    <td>{{$payment->name_of_card}}</td>
                    <td>{{$payment->transaction_id}}</td>
                    @if($payinfo)
                    <td>{{$payinfo->amounttobepaid}}</td>
                    @else
                    <td> -- </td>
                    @endif
                    <td>{{$payment->amount}}</td>
                    @endforeach

                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

</div>