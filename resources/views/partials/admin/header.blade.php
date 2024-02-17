@php
    $users = \Auth::user();
    // $profile = asset(Storage::url('upload/profile/'));
    $profile = \App\Models\Utility::get_file('upload/profile/');
    $unseenCounter = App\Models\ChMessage::where('to_id', Auth::user()->id)
        ->where('seen', 0)
        ->count();
    $lang = isset($users->lang) ? $users->lang : 'en';
    if ($lang == null) {
        $lang = 'en';
    }
    $LangName = \App\Models\Languages::where('code', $lang)->first();
    if (empty($LangName)) {
        $LangName  = new App\Models\Utility();
        $LangName->fullName = 'English';
    }
    $logo=\App\Models\Utility::get_file('uploads/logo/');


$company_logo = \App\Models\Utility::GetLogo();

$users = \Auth::user();
$currantLang = $users->currentLanguage();
$emailTemplate = App\Models\EmailTemplate::getemailtemplate();
$defaultView = App\Models\UserDefualtView::select('module','route')->where('user_id', $users->id)->get()->pluck('route', 'module')->toArray();

@endphp

 @if (isset($settings['cust_theme_bg']) && $settings['cust_theme_bg'] == 'on')
    <header class="dash-header transprent-bg">
    @else
    <header class="dash-header">
@endif
<div class="new_header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <img src="{{$logo.'logo.svg'}}"
                    alt="{{ config('app.name', 'Centraverse') }}" class="logo logo-lg nav-sidebar-logo" height="50"/>
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <ul class="dash-navbar">  
                        <li class="dash-item {{ \Request::route()->getName() == 'dashboard' ? ' active' : '' }}">
                            <a href="{{ route('dashboard') }}" class="dash-link"><span class="dash-mtext">{{ __('Dashboard') }}</span></a>
                        </li>
                        @can('Manage Lead')
                        <li class="dash-item {{ \Request::route()->getName() == 'lead' || \Request::route()->getName() == 'lead.edit' ? ' active' : '' }}">
                            {{-- <a href="{{ !empty(\Auth::user()->getDefualtViewRouteByModule('lead')) ? route(\Auth::user()->getDefualtViewRouteByModule('lead')) : route('lead.index') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-filter"></i></span><span class="dash-mtext">{{ __('Leads') }}</span>
                            </a> --}}
                            <a href="{{  array_key_exists('lead',$defaultView) ? route($defaultView['lead']) : route('lead.index') }}"   class="dash-link">
                                <!-- <span class="dash-micon"><i class="ti ti-filter"></i></span> -->
                                <span class="dash-mtext">{{ __('Leads') }}</span>
                            </a>
                        </li>
                        @endcan
                        @can('Manage Meeting')
                        <li class="dash-item {{ \Request::route()->getName() == 'meeting' || \Request::route()->getName() == 'meeting.show' || \Request::route()->getName() == 'meeting.edit' ? ' active' : '' }}">
                            {{-- <a href="{{ !empty(\Auth::user()->getDefualtViewRouteByModule('meeting')) ? route(\Auth::user()->getDefualtViewRouteByModule('meeting')) : route('meeting.index') }}"
                                class="dash-link">
                                <span class="dash-micon"><i class="ti ti-calendar"></i></span><span class="dash-mtext">{{ __('Event') }}</span>
                            </a> --}}
                            <a href="{{ array_key_exists('meeting',$defaultView) ? route($defaultView['meeting']) : route('meeting.index') }}"
                                class="dash-link">
                                <!-- <span class="dash-micon"><i class="ti ti-calendar"></i></span> -->
                                <span class="dash-mtext">{{ __('Event') }}</span>
                            </a>
                        </li>
                        @endcan
                        <!-- @if (\Auth::user()->type == 'owner') 
                            <li class="dash-item">
                                <a href="{{ route('email.template.view') }}" class="dash-link">
                                <span
                                class="dash-mtext">{{ __('Email Template') }}</span></a>
                            </li>
                        @endif  -->
                        @if (\Auth::user()->type == 'owner') 
                            <li class="dash-item">
                                <a href="{{ route('customer.index') }}" class="dash-link">
                                    <!-- <span class="dash-micon"><i class="ti ti-template"></i></span> -->
                                    <span
                                class="dash-mtext">{{ __('Campaign') }}</span></a>
                            </li>
                        @endif 
                        @if(\Auth::user()->type =='owner')
                            <li class="dash-item {{ \Request::route()->getName() == 'billing' || \Request::route()->getName() == 'billing.index' ? ' active' : '' }}">
                                <a href="{{ route('billing.index') }}" class="dash-link">
                                    <span class="dash-mtext">{{ __('Billing') }}</span>
                                </a>
                            </li>
                            <li class="dash-item {{ \Request::route()->getName() == 'customer-list' ? ' active' : '' }}">
                            <a href="{{route('userlist')}}" class="dash-link"><span class="dash-mtext">{{ __('Customer') }}</span></a>
                        </li>
                        @endif
                        @if (\Auth::user()->type == 'super admin' || \Auth::user()->type == 'owner')
                            <li class="dash-item  {{ Request::route()->getName() == 'settings' ? 'active' : '' }}">
                                <a href="{{ route('settings') }}" class="dash-link">
                                    <!-- <span class="dash-micon"><i class="ti ti-settings"></i></span> -->
                                    <span class="dash-mtext">{{ __('Settings') }}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="navbar-nav ms-auto">
                    <li class="dropdown dash-h-item drp-company">
                        <a class="dash-head-link dropdown-toggle arrow-none me-0" data-target="#sidenav-main"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="theme-avtar">
                                @php
                                    $profile = \App\Models\Utility::get_file('upload/profile/');
                                @endphp
                                @if (\Request::route()->getName() == 'chats')
                                    <img class="rounded-circle"
                                        src="{{ !empty($users->avatar) ? $users->avatar : 'avatar.png' }}" style="width:30px;">
                                @else
                                    <img class="rounded-circle"
                                        @if ($users->avatar) src="{{ $profile }}{{ !empty($users->avatar) ? $users->avatar : 'avatar.png' }}" @else src="{{ $profile . 'avatar.png' }}" @endif
                                                            alt="{{ $users->name }}"style="width:30px;">
                                @endif
                            </span>
                            <span class="hide-mob ms-2">{{ __('Hi') }}, {{ $users->name }}</span>
                            <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown">

                            <a href="{{ route('profile') }}" class="dropdown-item">
                                <i class="ti ti-user"></i>
                                <span>{{ __('Profile') }}</span>
                            </a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                                class="dropdown-item">
                                <i class="ti ti-power"></i>
                                <span>{{ __('Logout') }}</span>
                            </a>
                            <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                    <!-- <a href="#" class="nav-item nav-link">Login</a> -->
                </div>
            </div>
        </div>
    </nav>
</div>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> -->
        <!-- <div class="container-fluid">
            <a href="#" class="navbar-brand">
                <img src="https://www.tutorialrepublic.com/examples/images/logo.svg" height="28" alt="CoolBrand">
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <a href="#" class="nav-item nav-link active">Dashboard</a>
                    <a href="#" class="nav-item nav-link">Leads</a>
                    <a href="#" class="nav-item nav-link">Event</a>
                    <a href="#" class="nav-item nav-link">Calendar</a>
                    <a href="#" class="nav-item nav-link">Email template</a>
                    <a href="#" class="nav-item nav-link">Campaign</a>	
                    <a href="#" class="nav-item nav-link">Billing</a>	
                    <a href="#" class="nav-item nav-link">Settings</a>						
                </div>
                <div class="navbar-nav ms-auto">
                    <a href="#" class="nav-item nav-link">Login</a>
                </div>
            </div>
        </div>
    </nav> -->
    <!-- <div class="header-wrapper">
        <div class="me-auto dash-mob-drp">
            <ul class="list-unstyled" >
                <li class="dash-h-item mob-hamburger">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin"
                        data-target="#sidenav-main"></a>
                    <a href="#!" class="dash-head-link" id="mobile-collapse">
                        <div class="hamburger hamburger--arrowturn">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="dropdown dash-h-item drp-company">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-target="#sidenav-main"
                        data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="theme-avtar">
                            @php
                                $profile = \App\Models\Utility::get_file('upload/profile/');
                            @endphp
                            @if (\Request::route()->getName() == 'chats')
                                <img class="rounded-circle"
                                    src="{{ !empty($users->avatar) ? $users->avatar : 'avatar.png' }}" style="width:30px;">
                            @else
                                <img class="rounded-circle"
                                    @if ($users->avatar) src="{{ $profile }}{{ !empty($users->avatar) ? $users->avatar : 'avatar.png' }}" @else src="{{ $profile . 'avatar.png' }}" @endif
                                                        alt="{{ $users->name }}"style="width:30px;">
                            @endif
                        </span>
                        <span class="hide-mob ms-2">{{ __('Hi') }}, {{ $users->name }}</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">

                        <a href="{{ route('profile') }}" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span>{{ __('Profile') }}</span>
                        </a>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                            class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <div class="ms-auto">
            <ul class="list-unstyled">
            
            </ul>
        </div>
    </div> -->
      
    </header>