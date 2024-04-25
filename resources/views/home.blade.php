@extends('layouts.admin')
@section('breadcrumb')
@endsection
@section('page-title')
{{ __('Home') }}
@endsection
@section('title')
{{ __('Dashboard') }}
@endsection
@section('action-btn')
@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz" id="useradd-1">
                <div class="row">
                    @if (\Auth::user()->type == 'owner'||\Auth::user()->type == 'Admin')
                    <div class="col-lg-4 col-sm-12 totallead" style="padding: 15px;">
                        <div class="card">
                            <div class="card-body newcard_body" onclick="leads();">
                                <div class="theme-avtar bg-info">
                                    <i class="fas fa-address-card"></i>
                                </div>
                                <div class="right_side">
                                    <h6 class="mb-3">{{ __('Active Leads') }}</h6>
                                    <h3 class="mb-0">{{ $data['totalLead'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12" id="toggleDiv" style="padding: 15px;">
                        <div class="card">
                            <div class="card-body newcard_body">
                                <div class="theme-avtar bg-warning">
                                    <i class="fa fa-tasks"></i>
                                </div>
                                <div class="right_side">
                                    <h6 class="mb-3">{{ __('Active/Upcoming Events') }}</h6>
                                    <h3 class="mb-0">{{ @$totalevent }} </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-12" style="padding: 15px;">
                        <div class="card">
                            <div class="card-body newcard_body">
                                <div class="theme-avtar bg-success">
                                    <i class="fa fa-dollar-sign"></i>
                                </div>
                                <div class="right_side">
                                    <h6 class="mb-3">{{ __('Amount(E)') }}</h6>
                                    <h3 class="mb-0">{{ $events_revenue != 0 ? '$'.number_format($events_revenue) : '--' }}</h3>

                                    <!-- </div>
                                    <div class="right_side" style="    width: 35% !important;"> -->
                                    <h6 class="mb-3">{{ __('Amount Recieved(E)') }}</h6>
                                    <h3 class="mb-0">
                                        {{ $events_revenue_generated != 0 ? '$'.number_format($events_revenue_generated) : '--' }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif
                    @php
                    $setting = App\Models\Utility::settings();
                    @endphp
                </div>

                <div class="row">
                    <div class="col-sm">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Active Leads</h5>
                            @foreach($activeLeads as $lead)
                            <div class="card">
                                <div class="card-body new_bottomcard">
                                    <h5 class="card-text">{{ $lead['leadname'] }}
                                        <span>({{ $lead['type'] }})</span>
                                    </h5>
                                    @if($lead['start_date'] == $lead['end_date'])
                                    <p>{{ Carbon\Carbon::parse($lead['start_date'])->format('M d')}}</p>
                                    @else
                                    <p>{{ Carbon\Carbon::parse($lead['start_date'])->format('M d')}} -
                                        {{ \Auth::user()->dateFormat($lead['end_date'])}}
                                    </p>
                                    @endif
                                    @can('Show Lead')
                                    <div class="action-btn bg-warning ms-2">
                                        <a href="javascript:void(0);" data-size="md"
                                            data-url="{{ route('lead.show',$lead['id']) }}" data-bs-toggle="tooltip"
                                            title="{{__('Quick View')}}" data-ajax-popup="true"
                                            data-title="{{__('Lead Details')}}"
                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                            @endforeach
                            @can('Create Lead')
                            <div class="col-12 text-end mt-3">
                                <a href="javascript:void(0);" data-url="{{ route('lead.create',['lead',0]) }}"
                                    data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip"
                                    data-title="{{__('Create New Lead')}}" title="{{__('Create Lead')}}"
                                    class="btn btn-sm btn-primary btn-icon m-1">
                                    <i class="ti ti-plus"></i>
                                </a>
                            </div>
                            @endcan
                        </div>

                    </div>
                    <div class="col-sm">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Active/Upcoming Events</h5>
                            @foreach($activeEvent as $event)

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-text">{{ $event['name'] }}
                                        <span>({{ $event['type'] }})</span>
                                    </h5>
                                    @if($event['start_date'] == $event['end_date'])
                                    <p>{{ Carbon\Carbon::parse($event['start_date'])->format('M d')}}</p>
                                    @else
                                    <p>{{ Carbon\Carbon::parse($event['start_date'])->format('M d')}} -
                                        {{ \Auth::user()->dateFormat($event['end_date'])}}
                                    </p>
                                    @endif
                                    @can('Show Meeting')
                                    <div class="action-btn bg-warning ms-2">
                                        <a href="javascript:void(0);" data-size="md"
                                            data-url="{{ route('meeting.show', $event['id']) }}" data-ajax-popup="true"
                                            data-bs-toggle="tooltip" data-title="{{ __('Event Details') }}"
                                            title="{{ __('Quick View') }}"
                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                    </div>
                                    @endcan
                                </div>
                            </div>
                            @endforeach
                            @can('Create Meeting')
                            <div class="col-12 text-end mt-3">
                                <a href="{{ route('meeting.create',['meeting',0]) }}">
                                    <button data-bs-toggle="tooltip" title="{{ __('Create Event') }}"
                                        class="btn btn-sm btn-primary btn-icon m-1">
                                        <i class="ti ti-plus"></i></button>
                                </a>
                            </div>
                            @endcan
                        </div>

                    </div>
                    <div class="col-sm">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Finance</h5>
                            <div class="card">
                                <div class="card-body">
                                    @foreach($events as $event)
                                        <?php 
                                            $pay = App\Models\PaymentLogs::where('event_id',$event['id'])->get();
                                            $total = 0;
                                            foreach($pay as $p){
                                            $total += $p->amount;
                                            }
                                        ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-text">{{ $event['name'] }}
                                                <span>({{ $event['type'] }})</span>
                                            </h5>

                                            @if($event['start_date'] == $event['end_date'])
                                            <p>{{ Carbon\Carbon::parse($event['start_date'])->format('M d, Y')}}</p>
                                            @else
                                            <p>{{ Carbon\Carbon::parse($event['start_date'])->format('M d, Y')}} -
                                                {{ \Auth::user()->dateFormat($event['end_date'])}}
                                            </p>
                                            @endif
                                            <div style="    color: #a99595;">
                                            Billing Amount: ${{ number_format($event['total'])}}<br>
                                            Pending Amount: ${{number_format($event['total']- $total)}}
                                            </div>
                                           
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<style>
h5.card-text {
    font-size: 16px;
}
</style>
@endsection