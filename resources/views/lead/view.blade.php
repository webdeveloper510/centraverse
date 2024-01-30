
@php
    $startdate = \Carbon\Carbon::createFromFormat('Y-m-d', $lead->start_date)->format('d/m/Y');
    $enddate = \Carbon\Carbon::createFromFormat('Y-m-d', $lead->end_date)->format('d/m/Y');
@endphp
<div class="row">
    <div class="col-lg-12">
            <div class="col-md-12">
                <dl class="row">
                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Name of Lead')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->leadname }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Customer Name')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->name }}</span></dd>
                    
                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Email')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->email }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Phone')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->phone }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Address')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->lead_address }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Start Date')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ \Auth::user()->dateFormat($lead->start_date)}}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('End Date')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ \Auth::user()->dateFormat($lead->end_date) }}</span></dd>
                    
                </dl>
            </div>
            <div class="col-md-12">
                <dl class="row">
                 <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Start Time')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{date('h:i A', strtotime($lead->start_time))}}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('End Time')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{date('h:i A', strtotime($lead->end_time))}}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Venue')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->venue_selection }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Event')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $lead->type }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Assigned Staff')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ !empty($lead->assign_user)?$lead->assign_user->name:''}} ({{$lead->assign_user->type}})</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Lead Created')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{\Auth::user()->dateFormat($lead->created_at)}}</span></dd>
                    
                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Any Special Requirements')}}</span></dt>
                    @if($lead->spcl_req) 
                        <dd class="col-md-6"><span class="text-md">{{$lead->spcl_req}}</span></dd>
                    @else
                        <dd class="col-md-6"><span class="text-md">--</span></dd>
                    @endif
                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Status')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">
                        @if($lead->status == 0)
                            <span class="badge bg-info p-2 px-3 rounded">{{__(\App\Models\Lead::$status[$lead->status]) }}</span>
                        @elseif($lead->status == 1)
                            <span class="badge bg-warning p-2 px-3 rounded">{{__(\App\Models\Lead::$status[$lead->status]) }}</span>
                        @else($lead->status == 2)
                            <span class="badge bg-success p-2 px-3 rounded">{{__(\App\Models\Lead::$status[$lead->status]) }}</span>
                        @endif
                    </dd>
                </dl>
            </div>
    <div class="w-100 text-end pr-2">
        @can('Edit Lead')
        <div class="action-btn bg-info ms-2">
            <a href="{{ route('lead.edit',$lead->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip"data-title="{{__('Lead Edit')}}" title="{{__('Edit')}}"><i class="ti ti-edit"></i>
            </a>
        </div>
        @endcan
    </div>
</div>

