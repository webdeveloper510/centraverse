<div class="row">
    <div class="col-md-12">
        <dl class="row">
           
            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Customer Name')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $event->name }}</span></dd>

            <!-- <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Type')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $event->type }}</span></dd> -->


            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Total Amount')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $event->total }}</span></dd>

             <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Advance Paid')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $deposit = App\Models\Billing::where('event_id',$event->id)->pluck('deposits')->first() }}</span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Late Fee')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $deposit = App\Models\Billing::where('event_id',$event->id)->pluck('latefee')->first() }}</span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Adjustments')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $deposit = App\Models\Billing::where('event_id',$event->id)->pluck('adjustments')->first() }}</span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Balance Due')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $event->total - $deposit }}</span></dd>

                        <!-- <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Start Date')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ \Auth::user()->dateFormat($event->start_date)}}</span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('End Date')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ \Auth::user()->dateFormat($event->end_date) }}</span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Start Time')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{date('h:i A', strtotime($event->start_time))}}</span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('End Time')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{date('h:i A', strtotime($event->end_time))}}</span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Venue')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $event->venue_selection }}</span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Lead Created')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{\Auth::user()->dateFormat($event->created_at)}}</span></dd> -->
        </dl>
    </div>
</div>