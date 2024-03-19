<div class="row">
    <div class="col-md-12">
        <dl class="row">
            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Type')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $event->type }}</span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Customer Name')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $event->name }}</span></dd>
            
            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Email')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $event->email }}</span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Phone')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $event->phone }}</span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Address')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">{{ $event->lead_address }}</span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Start Date')}}</span></dt>
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
            <dd class="col-md-6"><span class="text-md">{{\Auth::user()->dateFormat($event->created_at)}}</span></dd>
            
            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Any Special Requirements')}}</span></dt>
            @if($event->spcl_req) 
                <dd class="col-md-6"><span class="text-md">{{$event->spcl_req}}</span></dd>
            @else
                <dd class="col-md-6"><span class="text-md">--</span></dd>
            @endif
            <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Status')}}</span></dt>
            <dd class="col-md-6"><span class="text-md">
                @if($billing->status == 0)
                    <span class="badge bg-info p-2 px-3 rounded">{{__(\App\Models\Billing::$status[$billing->status]) }}</span>
                @elseif($billing->status == 1)
                    <span class="badge bg-warning p-2 px-3 rounded">{{__(\App\Models\Billing::$status[$billing->status]) }}</span>
                @else($billing->status == 2)
                    <span class="badge bg-success p-2 px-3 rounded">{{__(\App\Models\Billing::$status[$billing->status]) }}</span>
                @endif
            </dd>
        </dl>
    </div>
    <div class="w-100 text-end pr-2">
            @can('Manage Payment')
            <div class="action-btn bg-warning ms-2">
                <a href="{{ route('billing.estimateview',urlencode(encrypt($event->id)))}}"> 
                <button  data-bs-toggle="tooltip"title="{{ __('View Billing') }}" class="btn btn-sm btn-secondary btn-icon m-1">
                <i class="ti ti-eye"></i></button>
            </a>
            </div>
            @endcan
        </div>
</div>