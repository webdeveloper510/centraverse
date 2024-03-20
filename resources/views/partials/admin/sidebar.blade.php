<div id="sidebar-wrapper">
    <div class="card">
        <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
            <div class="navbar-brand-box">
                <a href="#" class="navbar-brand">
                    <img src="{{$logo.'logo.svg'}}" alt="{{ config('app.name', 'Centraverse') }}" class="logo logo-lg nav-sidebar-logo" height="50" />
                </a>
            </div>

            <div class="scrollbar">
                @if(\Request::route()->getName() == 'lead.review')
                <a href="#useradd-1" class="list-group-item list-group-item-action border-0">{{ __('Review Lead') }}
                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                </a>
                @endif
                @if(\Request::route()->getName() == 'dashboard')
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext">{{ __('Dashboard') }} </span></a>
                </a>
                @endif
                @if(\Request::route()->getName() == 'settings')
                @if (\Auth::user()->type == 'owner')
                <a href="#company-email-setting" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Email Settings') }} </span></a>
                </a>
                <a href="#twilio-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Twilio Settings') }}</span>
                </a>
                @endif
                @if (\Auth::user()->type == 'super admin')
                <a href="#recaptcha-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Recaptcha Settings') }}</span>
                </a>
                @endif
                @can('Manage User')
                <a href="#user-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Staff Settings') }}</span>
                </a>
                @endcan
                @can('Manage Role')
                <a href="#role-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Role Settings') }}</span>
                </a>
                @endif
                @if(Gate::check('Manage Lead') || Gate::check('Manage Meeting'))
                <a href="#eventtype-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Event-Type Settings') }}</span>
                </a>

                <a href="#venue-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Venue Settings') }}</span>
                </a>
                <a href="#function-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Function Settings') }}</span>
                </a>
                <a href="#bar-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Bar Settings') }}</span>
                </a>
                <a href="#floor-plan-setting" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Setup Settings') }}</span>
                </a>
                @endif
                @can('Manage Payment')
                <a href="#billing-setting" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Billing Settings') }}</span>
                </a>
                @endcan
                @if (\Auth::user()->type == 'owner')
                <a href="#buffer-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Buffer Settings') }}</span>
                </a>
                <a href="#add-signature" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Authorised Signature') }}</span>
                </a>
                <a href="#campaign-type" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Campaign Type') }}</span>
                </a>
                <a href="#additional-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext">{{ __('Additional Settings') }}</span>
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
                @if(\Request::route()->getName() == 'userlist')
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                    <span class="dash-mtext">{{ __('Campaign') }} </span></a>
                <a href="{{route('campaign-list')}}" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('View Campaigns') }} </span></a>
                @endif
                @if(\Request::route()->getName() == 'campaign-list' )
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext">{{ __('View Campaigns') }} </span></a>
                @endif
                @if(\Request::route()->getName() == 'meeting.index')
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext">{{ __('Event') }} </span></a>

                </a>
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
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext">{{ __('Lead') }} </span></a>
                </a>
                @endif
                @if(\Request::route()->getName() == 'lead.edit' )
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext">{{ __('Edit Lead') }} </span></a>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>