<div class="row">
    <div class="col-lg-12">

        <div class="">
            <dl class="row">
                <dt class="col-md-5"><span class="h6 text-md mb-0">{{__('Start Date')}}</span></dt>
                <dd class="col-md-5"><span class="text-md">{{\Auth::user()->dateFormat($user_data->start_date)}}</span></dd>

                <dt class="col-md-5"><span class="h6 text-md mb-0">{{__('End Date')}}</span></dt>
                <dd class="col-md-5"><span class="text-md">{{\Auth::user()->dateFormat($user_data->end_date)}}</span></dd>

                <dt class="col-md-5"><span class="h6 text-md mb-0">{{__('Start Time')}}</span></dt>
                <dd class="col-md-5"><span class="text-md">{{date('h:i A', strtotime($user_data->start_time))}}</span></dd>

                <dt class="col-md-5"><span class="h6 text-md mb-0">{{__('End Time')}}</span></dt>
                <dd class="col-md-5"><span class="text-md">{{date('h:i A', strtotime($user_data->end_time))}}</span></dd>

                <dt class="col-md-5"><span class="h6 text-md mb-0">{{__('Venue')}}</span></dt>
                <dd class="col-md-5"><span class="text-md">{{$user_data->venue}}</span></dd>

                <dt class="col-md-5"><span class="h6 text-md mb-0">{{__('Purpose')}}</span></dt>
                <dd class="col-md-5"><span class="text-md">{{$user_data->purpose}}</span></dd>

                <dt class="col-md-5"><span class="h6 text-md mb-0">{{__('Blocked_by')}}</span></dt>
                <dd class="col-md-5"><span class="text-md">{{$blocked_username}}</span></dd>
            </dl>
        </div>
    </div>
    <div>
        @if(\Auth::user()->type == 'owner')
        <div class="w-100 text-center pr-2">
            <a href="{{ url('/unblock-date/' . $user_data->id) }}" style="cursor:pointer; color:red;">Unblock This Date</a>
        </div>
        @else
            @if(\Auth::user()->id == $user_data->created_by)
            <div class="w-100 text-center pr-2">
                <a href="{{ url('/unblock-date/' . $user_data->id) }}" style="cursor:pointer; color:red;">Unblock This Date</a>
            </div>
            @endif
        @endif
        <!-- <div class="w-100  pr-2" style="margin-top: -19px;">
            <a href="{{ url('/unblock-all-dates/' . $user_data->id) }}" style="color:red; cursor:pointer;">Unblock All Dates</a>
        </div> -->
    </div>

</div>