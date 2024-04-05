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
                <a href="#company-email-setting" class="list-group-item list-group-item-action">
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
                <?php if(\Request::route()->getName() == 'userlist'): ?>
                <a href="<?php echo e(route('siteusers')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-users"></i></span>
                    <span class="dash-mtext"><?php echo e(__('All Customers')); ?> </span></a>
                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('External ')); ?> </span></a>

                <a href="<?php echo e(route('event_customers')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Event ')); ?> </span></a>
                <a href="<?php echo e(route('lead_customers')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Leads')); ?> </span></a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'event_customers'): ?>
                <a href="<?php echo e(route('siteusers')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-users"></i></span>
                    <span class="dash-mtext"><?php echo e(__('All Customers')); ?> </span></a>
                <a href="<?php echo e(route('userlist')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('External ')); ?> </span></a>

                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Event ')); ?> </span></a>
                <a href="<?php echo e(route('lead_customers')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Leads ')); ?> </span></a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'siteusers'): ?>

                <a href="#useradd-1" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-users"></i></span>
                    <span class="dash-mtext"><?php echo e(__('All Customers')); ?> </span></a>
                <a href="<?php echo e(route('userlist')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('External')); ?> </span></a>

                <a href="<?php echo e(route('event_customers')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Event ')); ?> </span></a>
                <a href="<?php echo e(route('lead_customers')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Leads')); ?> </span></a>
                <?php endif; ?>
                <?php if(\Request::route()->getName() == 'lead_customers'): ?>
                <a href="<?php echo e(route('siteusers')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"><i class="ti ti-users"></i></span>
                    <span class="dash-mtext"><?php echo e(__('All Customers')); ?> </span></a>
                <a href="<?php echo e(route('userlist')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('External ')); ?> </span></a>

                <a href="<?php echo e(route('event_customers')); ?>" class="list-group-item list-group-item-action">
                    <span class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Event ')); ?> </span></a>
                <a href="#useradd-1" class="list-group-item list-group-item-action">
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
                        class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Event')); ?> </span></a>

                </a>
                <?php endif; ?>
                <?php if( \Request::route()->getName() == 'report.index' || \Request::route()->getName() == 'report.show' ||
                \Request::route()->getName() == 'report.edit' ? ' active ' : ''): ?>
                <!-- <a href="<?php echo e(route('report.index')); ?>" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"><i class="ti ti-trending-up"></i></span>
                    <span class="dash-mtext"><?php echo e(__('Custom Report')); ?> </span></a>

                </a> -->
                <a href="<?php echo e(route('report.leadsanalytic')); ?>" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Leads Analytics')); ?> </span></a>

                </a>
                <!-- <a href="<?php echo e(route('report.invoiceanalytic')); ?>" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Invoice Analytics')); ?> </span></a>

                </a>
                <a href="<?php echo e(route('report.salesorderanalytic')); ?>" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Sales Order Analytics')); ?> </span></a>

                </a>
                <a href="<?php echo e(route('report.quoteanalytic')); ?>" class="list-group-item list-group-item-action"><span
                        class="fa-stack fa-lg pull-left"></span>
                    <span class="dash-mtext"><?php echo e(__('Quote Analytics')); ?> </span></a>
                </a> -->
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

            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/partials/admin/sidebar.blade.php ENDPATH**/ ?>