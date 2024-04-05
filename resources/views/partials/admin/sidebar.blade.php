<div id="sidebar-wrapper">
    <div class="card">
        <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
            <div class="navbar-brand-box">
                <a href="#" class="navbar-brand">
                    <img src="{{$logo.'3_logo-light.png'}}" alt="{{ config('app.name', 'Centraverse') }}"
                        class="logo logo-lg nav-sidebar-logo" height="50" />
                </a>
            </div>
            <div class="scrollbar">
                @if(\Request::route()->getName() == 'lead.review')
                <a href="#useradd-1" class="list-group-item list-group-item-action border-0">{{ __('Review Lead') }}
                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                </a>
                @endif
                @if(\Request::route()->getName() == 'dashboard')
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext">{{ __('Dashboard') }} </span></a>
                </a>
                @endif
                @if(\Request::route()->getName() == 'settings')
                @if (\Auth::user()->type == 'owner')
                <a href="#company-email-setting" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-envelope  "></i></span>
                    <span class="dash-mtext">{{ __('Email') }} </span></a>
                </a>
                <a href="#twilio-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-sms"></i></span>
                    <span class="dash-mtext">{{ __('Twilio') }}</span>
                </a>
                @endif
                @if (\Auth::user()->type == 'super admin')
                <a href="#recaptcha-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Recaptcha') }}</span>
                </a>
                @endif
                @can('Manage User')
                <a href="#user-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-user"></i></span>
                    <span class="dash-mtext">{{ __('Staff') }}</span>
                </a>
                @endcan
                @can('Manage Role')
                <a href="#role-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="{{asset('icons/user.png')}}" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext">{{ __('Role') }}</span>
                </a>
                @endif
                @if(Gate::check('Manage Lead') || Gate::check('Manage Meeting'))
                <a href="#eventtype-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks"></i></span>
                    <span class="dash-mtext">{{ __('Event-Type') }}</span>
                </a>

                <a href="#venue-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="{{asset('icons/location.png')}}" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext">{{ __('Venue') }}</span>
                </a>
                <a href="#function-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="{{asset('icons/restaurant.png')}}" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext">{{ __('Function') }}</span>
                </a>
                <a href="#bar-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fas fa-cocktail"></i></span>
                    <span class="dash-mtext">{{ __('Bar') }}</span>
                </a>
                <a href="#floor-plan-setting" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="{{asset('icons/roadmap.png')}}" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext">{{ __('Setup') }}</span>
                </a>
                @endif
                @can('Manage Payment')
                <a href="#billing-setting" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fas fa-file-invoice"></i></span>
                    <span class="dash-mtext">{{ __('Invoice') }}</span>
                </a>
                @endcan
                @if (\Auth::user()->type == 'owner')
                <a href="#buffer-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="{{asset('icons/loading.png')}}" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext">{{ __('Buffer') }}</span>
                </a>
                <a href="#add-signature" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="{{asset('icons/signature.png')}}" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext">{{ __('Authorised Signature') }}</span>
                </a>
                <a href="#campaign-type" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="{{asset('icons/marketing.png')}}" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext">{{ __('Campaign Type') }}</span>
                </a>
                <a href="#additional-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="{{asset('icons/addition-thick-symbol.png')}}"
                            alt="" style="    width: 22px;"></span>
                    <span class="dash-mtext">{{ __('Additional') }}</span>
                </a>
                @endif
                @endif
                @if(\Request::route()->getName() == 'billing.index')
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                    <span class="dash-mtext">{{ __('Billing') }} </span></a>
                @endif
                @if(\Request::route()->getName() == 'billing.create')
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                    <span class="dash-mtext">{{ __('Create Billing') }} </span></a>
                @endif
                @if(\Request::route()->getName() == 'customer.index')
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                    <span class="dash-mtext">{{ __('Campaign') }} </span></a>
                <a href="{{route('campaign-list')}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('View Campaigns') }} </span></a>
                @endif
                @if(\Request::route()->getName() == 'userlist')
                <a href="{{route('siteusers')}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-users"></i></span>
                    <span class="dash-mtext">{{ __('All Customers') }} </span></a>
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('External ') }} </span></a>

                <a href="{{route('event_customers')}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Event ') }} </span></a>
                <a href="{{route('lead_customers')}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Leads') }} </span></a>
                @endif
                @if(\Request::route()->getName() == 'event_customers')
                <a href="{{route('siteusers')}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-users"></i></span>
                    <span class="dash-mtext">{{ __('All Customers') }} </span></a>
                <a href="{{route('userlist')}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('External ') }} </span></a>

                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Event ') }} </span></a>
                <a href="{{route('lead_customers')}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Leads ') }} </span></a>
                @endif
                @if(\Request::route()->getName() == 'siteusers')

                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-users"></i></span>
                    <span class="dash-mtext">{{ __('All Customers') }} </span></a>
                <a href="{{route('userlist')}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('External') }} </span></a>

                <a href="{{route('event_customers')}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Event ') }} </span></a>
                <a href="{{route('lead_customers')}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Leads') }} </span></a>
                @endif
                @if(\Request::route()->getName() == 'lead_customers')
                <a href="{{route('siteusers')}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-users"></i></span>
                    <span class="dash-mtext">{{ __('All Customers') }} </span></a>
                <a href="{{route('userlist')}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('External ') }} </span></a>

                <a href="{{route('event_customers')}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Event ') }} </span></a>
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Leads') }} </span></a>
                @endif
                @if(\Request::route()->getName() == 'campaign-list' )
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('View Campaigns') }} </span></a>
                @endif
                @if(\Request::route()->getName() == 'meeting.index')
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext">{{ __('Event') }} </span></a>

                </a>
                @endif
                @if( \Request::route()->getName() == 'report.index' || \Request::route()->getName() == 'report.show' ||
                \Request::route()->getName() == 'report.edit' ? ' active ' : '')
                <!-- <a href="{{ route('report.index') }}" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"><i class="ti ti-trending-up"></i></span>
                    <span class="dash-mtext">{{ __('Custom Report') }} </span></a>

                </a> -->
                <a href="{{ route('report.leadsanalytic') }}" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Leads Analytics') }} </span></a>

                </a>
                <!-- <a href="{{ route('report.invoiceanalytic') }}" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Invoice Analytics') }} </span></a>

                </a>
                <a href="{{ route('report.salesorderanalytic') }}" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Sales Order Analytics') }} </span></a>

                </a>
                <a href="{{ route('report.quoteanalytic') }}" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Quote Analytics') }} </span></a>
                </a> -->
                @endif
                @if(\Request::route()->getName() == 'meeting.create' ||\Request::route()->getName() == 'meeting.edit' )
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                    <span class="dash-mtext">{{ __('Event') }} </span></a>
                <a href="#event-details" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Event Details') }} </span></a>
                <a href="#special_req" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Special Requirements') }} </span></a>
                <a href="#other_info" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('Other Information') }} </span></a>
                @endif
                @if(\Request::route()->getName() == 'meeting.review' )
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                    <span class="dash-mtext">{{ __('Review Event') }} </span></a>
                @endif
                @if(\Request::route()->getName() == 'lead.index' )
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext">{{ __('Leads') }} </span></a>
                </a>
                @endif
                @if(\Request::route()->getName() == 'lead.edit' )
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext">{{ __('Edit Lead') }} </span></a>
                </a>
                @endif

            </div>
        </div>
    </div>
</div>