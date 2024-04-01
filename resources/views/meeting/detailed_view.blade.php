<?php 
// echo "<pre>";print_r($event);die;

$package = json_decode($event->func_package,true);
$additional = json_decode($event->ad_opts,true);
if(isset($event->bar_package) && !empty($event->bar_package)){
    $bar = json_decode($event->bar_package,true);
}
// echo "<pre>";print_r($bar);die;
?>
<div class="row">
    <div class="col-lg-12">
        <!-- <div class=""> -->
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

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Start Date')}}</span></dt>
            <dd class="col-md-6"><span class="">{{\Auth::user()->dateFormat($event->start_date)}}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('End Date')}}</span></dt>
            <dd class="col-md-6"><span class="">{{\Auth::user()->dateFormat($event->end_date)}}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Time')}}</span></dt>
            <dd class="col-md-6"><span class="">{{date('h:i A', strtotime($event->start_time))}} -
                    {{date('h:i A', strtotime($event->end_time))}}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Guest Count')}}</span></dt>
            <dd class="col-md-6"><span class="">{{$event->guest_count}}</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0">{{__('Venue')}}</span></dt>
            <dd class="col-md-6"><span class="">{{$event->venue_selection}}</span></dd>
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

            <dt class="col-md-6"><span class="h6  mb-3">{{__('Setup')}}</span></dt>
            <img src="{{$event->floor_plan}}" alt="">
        </dl>
        <!-- </div> -->

    </div>

    <div class="w-100 text-end pr-2">
        <!-- @if($event->start_date >= now())
    <a href="{{ url('/event-download/' . $event->id) }}"><i class="fa fa-download action-btn bg-info ms-1" style="cursor:pointer;"></i></a>
    @endif -->
        @can('Edit event')
        <div class="action-btn bg-info ms-2">
            <a href="{{ route('event.edit',$event->id) }}"
                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip"
                data-title="{{__('Edit Call')}}" title="{{__('Edit')}}"><i class="ti ti-edit"></i>
            </a>
        </div>
        @endcan
    </div>
</div>