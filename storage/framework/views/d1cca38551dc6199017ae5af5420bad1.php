<div id="sidebar-wrapper">
    <div class="card">
        <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
            <div class="navbar-brand-box">
                <a href="#" class="navbar-brand">
                    <img src="<?php echo e($logo.'3_logo-light.png'); ?>" alt="<?php echo e(config('app.name', 'Centraverse')); ?>"
                        class="logo logo-lg nav-sidebar-logo" height="50" />
                </a>
            </div>
            <div class="scrollbar">
                <?php if(\Request::route()->getName() == 'lead.review'): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action border-0"><?php echo e(__('Review Lead')); ?>

                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                </a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'dashboard'): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Dashboard')); ?> </span></a>
                </a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'settings'): ?>
                <?php if(\Auth::user()->type == 'owner'): ?>
                <a href="javascript:void(0);" class="list-group-item list-group-item-action" data-id="collapse16"
                    onclick="toggleCollapse(this.getAttribute('data-id'))">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-envelope  "></i></span>
                    <span class="dash-mtext"><?php echo e(__('Email')); ?> </span></a>
                </a>
                <a href="#twilio-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-sms"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Twilio')); ?></span>
                </a>
                <?php endif; ?>
                <?php if(\Auth::user()->type == 'super admin'): ?>
                <a href="#recaptcha-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-cog"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Recaptcha')); ?></span>
                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage User')): ?>
                <a href="#user-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-user"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Staff')); ?></span>
                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Role')): ?>
                <a href="#role-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="<?php echo e(asset('icons/user.png')); ?>" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext"><?php echo e(__('Role')); ?></span>
                </a>
                <?php endif; ?>
                <?php if(Gate::check('Manage Lead') || Gate::check('Manage Meeting')): ?>
                <a href="#eventtype-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Event-Type')); ?></span>
                </a>

                <a href="#venue-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="<?php echo e(asset('icons/location.png')); ?>" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext"><?php echo e(__('Venue')); ?></span>
                </a>
                <a href="#function-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="<?php echo e(asset('icons/restaurant.png')); ?>" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext"><?php echo e(__('Function')); ?></span>
                </a>
                <a href="#bar-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fas fa-cocktail"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Bar')); ?></span>
                </a>
                <a href="#floor-plan-setting" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="<?php echo e(asset('icons/roadmap.png')); ?>" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext"><?php echo e(__('Setup')); ?></span>
                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payment')): ?>
                <a href="#billing-setting" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><i class="fas fa-file-invoice"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Invoice')); ?></span>
                </a>
                <?php endif; ?>
                <?php if(\Auth::user()->type == 'owner'): ?>
                <a href="#buffer-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="<?php echo e(asset('icons/loading.png')); ?>" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext"><?php echo e(__('Buffer')); ?></span>
                </a>
                <a href="#add-signature" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="<?php echo e(asset('icons/signature.png')); ?>" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext"><?php echo e(__('Authorised Signature')); ?></span>
                </a>
                <a href="#campaign-type" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="<?php echo e(asset('icons/marketing.png')); ?>" alt=""
                            style="    width: 22px;"></span>
                    <span class="dash-mtext"><?php echo e(__('Campaign Type')); ?></span>
                </a>
                <a href="#additional-settings" class="list-group-item list-group-item-action border-0">
                    <span class="fa-stack fa-lg pull-left"><img src="<?php echo e(asset('icons/addition-thick-symbol.png')); ?>"
                            alt="" style="    width: 22px;"></span>
                    <span class="dash-mtext"><?php echo e(__('Additional')); ?></span>
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
                <?php if(\Request::route()->getName() == 'customer.index'): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Campaign')); ?> </span></a>
                <a href="<?php echo e(route('campaign-list')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('View Campaigns')); ?> </span></a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'userlist' || \Request::route()->getName() == 'customer.info' ||
                \Request::route()->getName() == 'event_customers'||\Request::route()->getName() == 'siteusers' ||
                \Request::route()->getName() == 'lead_customers' || \Request::route()->getName() ==
                'lead.userinfo'||\Request::route()->getName() == 'event.userinfo'): ?>
                <a href="<?php echo e(route('siteusers')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-users"></i></span>
                    <span class="dash-mtext"><?php echo e(__('All Customers')); ?> </span></a>
                <a href="<?php echo e(route('userlist')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('External ')); ?> </span></a>
                <a href="<?php echo e(route('event_customers')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Events ')); ?> </span></a>
                <a href="<?php echo e(route('lead_customers')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Leads')); ?> </span></a>
                <?php endif; ?>

                <?php if(\Request::route()->getName() == 'campaign-list' ): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('View Campaigns')); ?> </span></a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'meeting.index'): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"><i class="fa fa-tasks"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Events')); ?> </span></a>

                </a>
                <?php endif; ?>
                <?php if( \Request::route()->getName() == 'report.index' || \Request::route()->getName() == 'report.show' ||
                \Request::route()->getName() == 'report.edit' || \Request::route()->getName() == 'report.leadsanalytic'
                ||
                \Request::route()->getName() == 'report.eventanalytic' || \Request::route()->getName() ==
                'report.customersanalytic' || \Request::route()->getName() == 'report.billinganalytic' ? ' active ' :
                ''): ?>

                <a href="<?php echo e(route('report.leadsanalytic')); ?>" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Leads')); ?> </span></a>

                </a>

                <a href="<?php echo e(route('report.eventanalytic')); ?>" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Events')); ?> </span></a>

                </a>
                <a href="<?php echo e(route('report.customersanalytic')); ?>" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Customers')); ?> </span></a>

                </a>
                <a href="<?php echo e(route('report.billinganalytic')); ?>" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Financial')); ?> </span></a>

                </a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'meeting.create' ||\Request::route()->getName() == 'meeting.edit' ): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks"></i></span>
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
                    <span class="fa-stack fa-lg pull-left"><i class="fa fa-tasks"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Review Event')); ?> </span></a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'lead.index' ): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Leads')); ?> </span></a>
                </a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'lead.edit' ): ?>
                <a href="#useradd-1" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Edit Lead')); ?> </span></a>
                </a>
                <?php endif; ?>
                <!-- <li
                    class="dash-item <?php echo e(\Request::route()->getName() == 'calendar' || \Request::route()->getName() == 'calendar.index' ? ' active' : ''); ?>">
                    <a href="<?php echo e(route('calendar.index')); ?>" class="dash-link">
                        <span class="dash-micon"><i class="far fa-calendar-alt"></i></span><span
                            class="dash-mtext"><?php echo e(__('Calendar')); ?></span>
                    </a>
                </li> -->
            </div>
        </div>
    </div>
</div><?php /**PATH /home/crmcentraverse/public_html/resources/views/partials/admin/sidebar.blade.php ENDPATH**/ ?>