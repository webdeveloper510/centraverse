<div id="sidebar-wrapper">
            <div class="card">
     
                <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">

                <div class="navbar-brand-box">
            <a href="#" class="navbar-brand">
                <img src="{{$logo.'logo.svg'}}"
                    alt="{{ config('app.name', 'Centraverse') }}" class="logo logo-lg nav-sidebar-logo" height="50"/>
            </a>
         </div>

         <div class="scrollbar">

                    <a href="#company-email-setting" class="list-group-item list-group-item-action">
                        <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                        <span class="dash-mtext">{{ __('Email Settings') }} </span></a>
                    </a>
                    <a href="#twilio-settings" class="list-group-item list-group-item-action border-0">
                        <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                        <span class="dash-mtext">{{ __('Twilio Settings') }}</span>
                    </a>
                    @if (\Auth::user()->type == 'super admin')
                    <a href="#recaptcha-settings" class="list-group-item list-group-item-action border-0">
                        <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                        <span class="dash-mtext">{{ __('Recaptcha Settings') }}</span>
                    </a>
                    @endif
                    <a href="#user-settings" class="list-group-item list-group-item-action border-0">
                         <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                        <span class="dash-mtext">{{ __('Staff Settings') }}</span>
                    </a>
                    <a href="#role-settings" class="list-group-item list-group-item-action border-0"> 
                        <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                        <span class="dash-mtext">{{ __('Role Settings') }}</span>
                    </a>

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
                        <span class="dash-mtext">{{ __('Floor Plan Settings') }}</span>
                    </a>
                    <a href="#billing-setting" class="list-group-item list-group-item-action border-0"> 
                        <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                        <span class="dash-mtext">{{ __('Billing Settings') }}</span>
                    </a>
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

</div>
                </div>
            </div>
            <!-- <div class="card sticky-top" style="top:30px">
                    <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
                        <a href="#useradd-1" class="list-group-item list-group-item-action">
                            <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                            <span class="dash-mtext">{{ __('Create Billing') }} </span></a>
                    </div>
                </div> -->
        </div>