<?php
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

?>

 <?php if(isset($settings['cust_theme_bg']) && $settings['cust_theme_bg'] == 'on'): ?>
 <div class="outer-layout">
    <header class="dash-header transprent-bg">
    <?php else: ?>
    <header class="dash-header">
<?php endif; ?>
<div class="new_header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li class="active">
                                        <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2" style=" background: #dbdbdb;"> <span class="navbar-toggler-icon"></span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <ul class="dash-navbar">  
                        <li class="dash-item <?php echo e(\Request::route()->getName() == 'dashboard' ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('dashboard')); ?>" class="dash-link"><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span></a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Lead')): ?>
                        <li class="dash-item <?php echo e(\Request::route()->getName() == 'lead' || \Request::route()->getName() == 'lead.edit' ? ' active' : ''); ?>">
                            <a href="<?php echo e(array_key_exists('lead',$defaultView) ? route($defaultView['lead']) : route('lead.index')); ?>"   class="dash-link">
                                <span class="dash-mtext"><?php echo e(__('Leads')); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Meeting')): ?>
                        <li class="dash-item <?php echo e(\Request::route()->getName() == 'meeting' || \Request::route()->getName() == 'meeting.show' || \Request::route()->getName() == 'meeting.edit' ? ' active' : ''); ?>">
                            <a href="<?php echo e(array_key_exists('meeting',$defaultView) ? route($defaultView['meeting']) : route('meeting.index')); ?>"
                                class="dash-link">
                                <span class="dash-mtext"><?php echo e(__('Events')); ?></span>
                            </a>
                        </li>
                        <?php endif; ?>
                       
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Campaign')): ?>
                            <li class="dash-item">
                                <a href="<?php echo e(route('customer.index')); ?>" class="dash-link">
                                    <span
                                class="dash-mtext"><?php echo e(__('Campaigns')); ?></span></a>
                            </li>
                            <?php endif; ?>
                            <?php if(Gate::check('Manage Lead') || Gate::check('Manage Meeting') || Gate::check('Manage User')): ?>
                            <li class="dash-item <?php echo e(\Request::route()->getName() == 'customer-list' ? ' active' : ''); ?>">
                                <a href="<?php echo e(route('userlist')); ?>" class="dash-link">
                                    <span class="dash-mtext"><?php echo e(__('Customers')); ?></span>
                                </a>
                            </li>
                            
                            <?php endif; ?>
                            <?php if(\Auth::user()->type!='super admin'): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'calendar-new' || \Request::route()->getName() == 'calendernew.index' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('calendernew.index')); ?>" class="dash-link">
                           <span class="dash-mtext"><?php echo e(__('Calendar')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payment')): ?>
                            <li class="dash-item <?php echo e(\Request::route()->getName() == 'billing' || \Request::route()->getName() == 'billing.index' ? ' active' : ''); ?>">
                                <a href="<?php echo e(route('billing.index')); ?>" class="dash-link">
                                    <span class="dash-mtext"><?php echo e(__('Invoice')); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>
                          
                            <li class="dash-item  <?php echo e(Request::route()->getName() == 'settings' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('settings')); ?>" class="dash-link">
                                    <!-- <span class="dash-micon"><i class="ti ti-settings"></i></span> -->
                                    <span class="dash-mtext"><?php echo e(__('Settings')); ?></span>
                                </a>
                            </li>
                    </ul>
                </div>
                <div class="navbar-nav ms-auto">
                    <li class="dropdown dash-h-item drp-company">
                        <a class="dash-head-link dropdown-toggle arrow-none me-0" data-target="#sidenav-main"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="theme-avtar">
                                <?php
                                    $profile = \App\Models\Utility::get_file('upload/profile/');
                                ?>
                                <?php if(\Request::route()->getName() == 'chats'): ?>
                                    <img class="rounded-circle"
                                        src="<?php echo e(!empty($users->avatar) ? $users->avatar : 'avatar.png'); ?>" style="width:30px;">
                                <?php else: ?>
                                    <img class="rounded-circle"
                                        <?php if($users->avatar): ?> src="<?php echo e($profile); ?><?php echo e(!empty($users->avatar) ? $users->avatar : 'avatar.png'); ?>" <?php else: ?> src="<?php echo e($profile . 'avatar.png'); ?>" <?php endif; ?>
                                                            alt="<?php echo e($users->name); ?>"style="width:30px;">
                                <?php endif; ?>
                            </span>
                            <span class="hide-mob ms-2"><?php echo e(__('Hi')); ?>, <?php echo e($users->name); ?></span>
                            <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                        </a>
                        <div class="dropdown-menu dash-h-dropdown">

                            <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
                                <i class="ti ti-user"></i>
                                <span><?php echo e(__('Profile')); ?></span>
                            </a>
                            <a href="<?php echo e(route('logout')); ?>"
                                onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                                class="dropdown-item">
                                <i class="ti ti-power"></i>
                                <span><?php echo e(__('Logout')); ?></span>
                            </a>
                            <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </div>
                    </li>
                    <!-- <a href="#" class="nav-item nav-link">Login</a> -->
                </div>
            </div>
        </div>
    </nav>
</div>

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
                            <?php
                                $profile = \App\Models\Utility::get_file('upload/profile/');
                            ?>
                            <?php if(\Request::route()->getName() == 'chats'): ?>
                                <img class="rounded-circle"
                                    src="<?php echo e(!empty($users->avatar) ? $users->avatar : 'avatar.png'); ?>" style="width:30px;">
                            <?php else: ?>
                                <img class="rounded-circle"
                                    <?php if($users->avatar): ?> src="<?php echo e($profile); ?><?php echo e(!empty($users->avatar) ? $users->avatar : 'avatar.png'); ?>" <?php else: ?> src="<?php echo e($profile . 'avatar.png'); ?>" <?php endif; ?>
                                                        alt="<?php echo e($users->name); ?>"style="width:30px;">
                            <?php endif; ?>
                        </span>
                        <span class="hide-mob ms-2"><?php echo e(__('Hi')); ?>, <?php echo e($users->name); ?></span>
                        <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown">

                        <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span><?php echo e(__('Profile')); ?></span>
                        </a>
                        <a href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                            class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <span><?php echo e(__('Logout')); ?></span>
                        </a>
                        <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo e(csrf_field()); ?>

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

    <?php echo $__env->make('partials.admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   
</div><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/partials/admin/header.blade.php ENDPATH**/ ?>