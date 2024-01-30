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
?>

<?php if(isset($settings['cust_theme_bg']) && $settings['cust_theme_bg'] == 'on'): ?>
    <header class="dash-header transprent-bg">
    <?php else: ?>
        <header class="dash-header">
<?php endif; ?>
<div class="header-wrapper">
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
            <!-- <?php if(\Auth::user()->type != 'super admin'): ?>
                <li class="dash-h-item">
                    <a href="<?php echo e(url('chats')); ?>" class="dash-head-link me-0">
                        <i class="ti ti-message-circle " style="font-size: 21px"></i>
                        <span
                            class="bg-danger dash-h-badge message-counter custom_messanger_counter"><?php echo e($unseenCounter); ?><span
                                class="sr-only"></span>
                        </span>
                    </a>
                </li>
            <?php endif; ?> -->
            <!-- <li class="dropdown dash-h-item drp-language">
                <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="ti ti-world nocolor"></i>
                    <span
                        class="drp-text hide-mob"><?php echo e(ucFirst(isset($LangName->fullName) ? $LangName->fullName : 'en')); ?></span>
                    <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                </a>
                <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                   <?php $__currentLoopData = App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('change.language', $code)); ?>"
                            class="dropdown-item <?php echo e($currantLang == $code ? 'text-primary' : ''); ?>">
                            <span><?php echo e(ucFirst($lang)); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(Auth::user()->type == 'super admin'): ?>
                        <a href="#" data-url="<?php echo e(route('create.language')); ?>"
                            class="dropdown-item border-top py-1 text-primary" data-bs-toggle="tooltip"
                            data-ajax-popup="true" data-title="<?php echo e(__('Create New Language')); ?>">
                            <span class="small"><?php echo e(__('Create Languages')); ?></span>
                        </a>
                        <a href="<?php echo e(route('manage.language', [$currantLang])); ?>"
                            class="dropdown-item border-top py-1 text-primary">
                            <span class="small"><?php echo e(__('Manage Languages')); ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </li> -->
        </ul>
    </div>
</div>
</header><?php /**PATH C:\xampp\htdocs\centraglobe\main-file\resources\views/partials/admin/header.blade.php ENDPATH**/ ?>