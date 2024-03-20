<div id="sidebar-wrapper">
    <div class="card">
        <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
            <div class="navbar-brand-box">
                <a href="#" class="navbar-brand">
                    <img src="<?php echo e($logo.'logo.svg'); ?>" alt="<?php echo e(config('app.name', 'Centraverse')); ?>" class="logo logo-lg nav-sidebar-logo" height="50" />
                </a>
            </div>

            <div class="scrollbar">
                <?php if(\Request::route()->getName() == 'lead.review'): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action border-0"><?php echo e(__('Review Lead')); ?>

                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                </a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'dashboard'): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Dashboard')); ?> </span></a>
                </a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'settings'): ?>
                <?php if(\Auth::user()->type == 'owner'): ?>
                <a href="#company-email-setting" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Email Settings')); ?> </span></a>
                </a>
                <a href="#twilio-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Twilio Settings')); ?></span>
                </a>
                <?php endif; ?>
                <?php if(\Auth::user()->type == 'super admin'): ?>
                <a href="#recaptcha-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Recaptcha Settings')); ?></span>
                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage User')): ?>
                <a href="#user-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Staff Settings')); ?></span>
                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Role')): ?>
                <a href="#role-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Role Settings')); ?></span>
                </a>
                <?php endif; ?>
                <?php if(Gate::check('Manage Lead') || Gate::check('Manage Meeting')): ?>
                <a href="#eventtype-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Event-Type Settings')); ?></span>
                </a>

                <a href="#venue-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Venue Settings')); ?></span>
                </a>
                <a href="#function-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Function Settings')); ?></span>
                </a>
                <a href="#bar-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Bar Settings')); ?></span>
                </a>
                <a href="#floor-plan-setting" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Setup Settings')); ?></span>
                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Billing')): ?>
                <a href="#billing-setting" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Billing Settings')); ?></span>
                </a>
                <?php endif; ?>
                <?php if(\Auth::user()->type == 'owner'): ?>
                <a href="#buffer-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Buffer Settings')); ?></span>
                </a>
                <a href="#add-signature" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Authorised Signature')); ?></span>
                </a>
                <a href="#campaign-type" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Campaign Type')); ?></span>
                </a>
                <a href="#additional-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Additional Settings')); ?></span>
                </a>
                <?php endif; ?>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'billing.index'): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Billing')); ?> </span></a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'billing.create'): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Create Billing')); ?> </span></a>

                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'userlist'): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Campaign')); ?> </span></a>
                <a href="<?php echo e(route('campaign-list')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('View Campaigns')); ?> </span></a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'campaign-list' ): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('View Campaigns')); ?> </span></a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'meeting.index'): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Event')); ?> </span></a>

                </a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'meeting.create' ||\Request::route()->getName() == 'meeting.edit' ): ?>

                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Event')); ?> </span></a>
                <a href="#event-details" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Event Details')); ?> </span></a>
                <a href="#special_req" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Special Requirements')); ?> </span></a>
                <a href="#other_info" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Other Information')); ?> </span></a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'meeting.review' ): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Review Event')); ?> </span></a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'lead.index' ): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Lead')); ?> </span></a>
                </a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'lead.edit' ): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Edit Lead')); ?> </span></a>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/partials/admin/sidebar.blade.php ENDPATH**/ ?>