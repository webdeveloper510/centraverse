
<div class="row">
    <div class="col-lg-12">
            <div class="">
                <dl class="row">
                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Event')}}</span></dt>
                    @if($meeting->attendees_lead != 0)
                    <dd class="col-md-6"><span class="text-md">{{ !empty($meeting->attendees_leads->leadname)?$meeting->attendees_leads->leadname:'--' }}</span></dd>
                  @else
                  <dd class="col-md-6"><span class="text-md">{{$meeting->eventname}}</span></dd>
                  @endif
                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Start Date')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{\Auth::user()->dateFormat($meeting->start_date)}}</span></dd>
                   
                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('End Date')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{\Auth::user()->dateFormat($meeting->end_date)}}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Start Time')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{date('h:i A', strtotime($meeting->start_time))}}</span></dd>
                    
                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('End Time')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{date('h:i A', strtotime($meeting->end_time))}}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Guest Count')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{$meeting->guest_count}}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Venue')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{$meeting->venue_selection}}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Function')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{$meeting->function}}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Event Type')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{$meeting->type}}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-sm mb-0">{{__('Assigned Staff')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{ $name }}</span></dd>

                    <dt class="col-md-6"><span class="h6 text-sm mb-0">{{__('Created')}}</span></dt>
                    <dd class="col-md-6"><span class="text-md">{{\Auth::user()->dateFormat($meeting->created_at)}}</span></dd>
                </dl>
            </div>

    </div>

    <div class="w-100 text-end pr-2">
    <!-- @if($meeting->start_date >= now())
    <a href="{{ url('/meeting-download/' . $meeting->id) }}"><i class="fa fa-download action-btn bg-info ms-1" style="cursor:pointer;"></i></a>
    @endif -->
    @can('Edit Meeting')
        <div class="action-btn bg-info ms-2">
            <a href="{{ route('meeting.edit',$meeting->id) }}" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip"data-title="{{__('Edit Call')}}" title="{{__('Edit')}}"><i class="ti ti-edit"></i>
            </a>
        </div>
    @endcan
    </div>
</div>


