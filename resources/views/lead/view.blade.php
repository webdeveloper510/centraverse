@php
$startdate = \Carbon\Carbon::createFromFormat('Y-m-d', $lead->start_date)->format('d/m/Y');
$enddate = \Carbon\Carbon::createFromFormat('Y-m-d', $lead->end_date)->format('d/m/Y');
@endphp
<div class="row">
    <div class="col-md-12">
        <dl class="row">
            <dt class="col-md-6"><span class="h6  mb-0">{{__('Lead')}}</span></dt>
            <dd class="col-md-6"><span class="">{{ $lead->leadname }}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Email')}}</span></dt>
            <dd class="col-md-6"><span class="">{{ $lead->email }}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Phone')}}</span></dt>
            <dd class="col-md-6"><span class="">{{ $lead->phone }}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Address')}}</span></dt>
            <dd class="col-md-6"><span class="">{{ $lead->lead_address ?? '--'}}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Event Date')}}</span></dt>
            <dd class="col-md-6"><span class="">
                    @if($lead->start_date == $lead->end_date)
                    {{ \Auth::user()->dateFormat($lead->start_date) }}
                    @else
                    {{ \Auth::user()->dateFormat($lead->start_date) }} -
                    {{ \Auth::user()->dateFormat($lead->end_date) }}
                    @endif
                </span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Time')}}</span></dt>
            <dd class="col-md-6"><span class="">
                    @if($lead->start_time == $lead->end_time)
                    --
                    @else
                    {{date('h:i A', strtotime($lead->start_time))}} - {{date('h:i A', strtotime($lead->end_time))}}
                    @endif
                </span>
            </dd>
            <dt class="col-md-6"><span class="h6  mb-0">{{__('Venue')}}</span></dt>
            <dd class="col-md-6">
                <span class="">{{  !empty($lead->venue_selection)? $lead->venue_selection :'--'}}</span>
            </dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Type')}}</span></dt>
            <dd class="col-md-6"><span class="">{{ $lead->type }}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Guest Count')}}</span></dt>
            <dd class="col-md-6"><span class="">{{ $lead->guest_count }}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Assigned Staff')}}</span></dt>
            <dd class="col-md-6"><span class="">{{ !empty($lead->assign_user)?$lead->assign_user->name:'Not Assigned Yet'}}
                    {{ !empty($lead->assign_user)? '('.$lead->assign_user->type.')' :''}}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Lead Created')}}</span></dt>
            <dd class="col-md-6"><span class="">{{\Auth::user()->dateFormat($lead->created_at)}}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Any Special Requirements')}}</span></dt>
            @if($lead->spcl_req)
            <dd class="col-md-6"><span class="">{{$lead->spcl_req}}</span></dd>
            @else
            <dd class="col-md-6"><span class="">--</span></dd>
            @endif
            <dt class="col-md-6"><span class="h6  mb-0">{{__('Status')}}</span></dt>
            <dd class="col-md-6"><span class="">
                    @if($lead->status == 0)
                    <span
                        class="badge bg-info p-2 px-3 rounded">{{ __(\App\Models\Lead::$status[$lead->status]) }}</span>
                    @elseif($lead->status == 1)
                    <span
                        class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Lead::$status[$lead->status]) }}</span>
                    @elseif($lead->status == 2)
                    <span
                        class="badge bg-secondary p-2 px-3 rounded">{{ __(\App\Models\Lead::$status[$lead->status]) }}</span>
                    @elseif($lead->status == 3)
                    <span
                        class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\Lead::$status[$lead->status]) }}</span>
                    @elseif($lead->status == 4)
                    <span
                        class="badge bg-success p-2 px-3 rounded">{{ __(\App\Models\Lead::$status[$lead->status]) }}</span>
                    @elseif($lead->status == 5)
                    <span
                        class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Lead::$status[$lead->status]) }}</span>
                    @endif
            </dd>
        </dl>
    </div>
    @if($lead->status != 2)
    <div class="w-100 text-end pr-2">
        @can('Edit Lead')
        <div class="action-btn bg-info ms-2">
            <a href="{{ route('lead.edit',$lead->id) }}"
                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip"
                data-title="{{__('Lead Edit')}}" title="{{__('Edit')}}"><i class="ti ti-edit"></i>
            </a>
        </div>
        @endcan
    </div>
    @endif
</div>