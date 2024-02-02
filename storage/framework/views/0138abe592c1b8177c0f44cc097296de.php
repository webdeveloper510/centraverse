<?php
$logo=\App\Models\Utility::get_file('uploads/logo/');


$company_logo = \App\Models\Utility::GetLogo();

$users = \Auth::user();
$currantLang = $users->currentLanguage();
$emailTemplate = App\Models\EmailTemplate::getemailtemplate();
$defaultView = App\Models\UserDefualtView::select('module','route')->where('user_id', $users->id)->get()->pluck('route', 'module')->toArray();
?>
<?php if((isset($settings['cust_theme_bg']) && $settings['cust_theme_bg'] == 'on')): ?>
    <nav class="dash-sidebar light-sidebar transprent-bg">
<?php else: ?>
    <nav class="dash-sidebar light-sidebar">
<?php endif; ?>
    <div class="navbar-wrapper">
        <div class="m-header main-logo">
            <a href="<?php echo e(route('dashboard')); ?>" class="b-brand">
                
                    
                    <img src="<?php echo e($logo.'logo.png'); ?>"
                    alt="<?php echo e(config('app.name', 'Centraverse')); ?>" class="logo logo-lg nav-sidebar-logo" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="dash-navbar">  
                <li class="dash-item <?php echo e(\Request::route()->getName() == 'dashboard' ? ' active' : ''); ?>">
                    <a href="<?php echo e(route('dashboard')); ?>" class="dash-link">
                        <span class="dash-micon"><i class="ti ti-home-2"></i></span><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span></a>
                </li>
                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage User')): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'user' || \Request::route()->getName() == 'user.edit' ? ' active' : ''); ?>">
                        
                            <a class="dash-link" href="<?php echo e(array_key_exists('user',$defaultView) ? route($defaultView['user']) : route('user.index')); ?>">
                            <span class="dash-micon"><i class="ti ti-user"></i></span><span class="dash-mtext"><?php echo e(__('Staff')); ?></span></a>
                    </li>
                <?php endif; ?> -->
                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Role')): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'role' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('role.index')); ?>" class="dash-link"><span class="dash-micon">
                            <i class="ti ti-license"></i></span><span class="dash-mtext"><?php echo e(__('Role')); ?></span></a>
                    </li>
                <?php endif; ?> -->

               <!--<?php if(\Auth::user()->type != 'super admin'): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'messages' ? ' active' : ''); ?>">
                        <a href="<?php echo e(url('chats')); ?>" class="dash-link <?php echo e(Request::segment(1) == 'messages' ? 'active' : ''); ?>">
                            <span class="dash-micon"><i class="ti ti-brand-messenger"></i></span><span class="dash-mtext"><?php echo e(__('Messenger')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>   -->

                <!-- <?php if(\Auth::user()->type == 'owner'): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'notification_templates' ? 'active' : ''); ?>">
                        <a class="dash-link" href=<?php echo e(url('notification-templates')); ?>>
                            <span class="dash-micon"><i class="ti ti-notification"></i></span><span class="dash-mtext"><?php echo e(__('Notification Template')); ?></span></a>
                    </li>
                <?php endif; ?> -->

                 <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Form Builder')): ?>
                    <li class="dash-item  <?php echo e(\Request::route()->getName() == 'form_builder' || \Request::route()->getName() == 'form_builder.show' || \Request::route()->getName() == 'form.response' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('form_builder.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-align-justified"></i></span><span class="dash-mtext"><?php echo e(__('Form Builder')); ?></span>
                        </a>
                    </li>
                <?php endif; ?> 

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Account')): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'account' || \Request::route()->getName() == 'account.edit' ? ' active' : ''); ?>">
                        
                        <a href="<?php echo e(array_key_exists('account',$defaultView) ? route($defaultView['account']) : route('account.index')); ?>" class="dash-link">
                            <span class="dash-micon"> <i class="ti ti-building"></i></span><span class="dash-mtext"><?php echo e(__('Accounts')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Contact')): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'contact' || \Request::route()->getName() == 'contact.edit' ? ' active' : ''); ?>">
                        
                        <a href="<?php echo e(array_key_exists('contact',$defaultView) ? route($defaultView['contact']) : route('contact.index')); ?>"  class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-file-phone"></i></span><span class="dash-mtext"><?php echo e(__('Contacts')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>  -->

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Lead')): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'lead' || \Request::route()->getName() == 'lead.edit' ? ' active' : ''); ?>">
                        
                        <a href="<?php echo e(array_key_exists('lead',$defaultView) ? route($defaultView['lead']) : route('lead.index')); ?>"   class="dash-link">
                            <span class="dash-micon"><i class="ti ti-filter"></i></span><span class="dash-mtext"><?php echo e(__('Leads')); ?></span>
                        </a>
                <?php endif; ?>
                 <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Opportunities')): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'opportunities' || \Request::route()->getName() == 'opportunities.edit' ? ' active' : ''); ?>">
                        
                        <a href="<?php echo e(array_key_exists('opportunities',$defaultView) ? route($defaultView['opportunities']) : route('opportunities.index')); ?>"
                            class="dash-link">
                            <span class="dash-micon"><i class="ti ti-currency-dollar-singapore"></i></span><span class="dash-mtext"><?php echo e(__('Opportunities')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Product')): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'product' || \Request::route()->getName() == 'product.edit' ? ' active' : ''); ?>">
                        
                        <a href="<?php echo e(array_key_exists('product',$defaultView) ? route($defaultView['product']) : route('product.index')); ?>"
                            class="dash-link">
                            <span class="dash-micon"><i class="ti ti-brand-producthunt"></i></span><span class="dash-mtext"><?php echo e(__('Products')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Quote')): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'quote' || \Request::route()->getName() == 'quote.show' || \Request::route()->getName() == 'quote.edit' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('quote.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-blockquote"></i></span><span class="dash-mtext"><?php echo e(__('Quotes')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>-->
                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage SalesOrder')): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'salesorder' || \Request::route()->getName() == 'salesorder.show' || \Request::route()->getName() == 'salesorder.edit' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('salesorder.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-file-invoice"></i></span><span class="dash-mtext"><?php echo e(__('Sales Orders')); ?></span>
                        </a>
                    </li>
                <?php endif; ?> -->
               <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Invoice')): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'invoice' || \Request::route()->getName() == 'invoice.show' || \Request::route()->getName() == 'invoice.edit' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('invoice.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-receipt"></i></span><span class="dash-mtext"><?php echo e(__('Invoices')); ?></span>
                        </a>
                    </li>
                <?php endif; ?> -->
                <!-- <?php if(\Auth::user()->type != 'super admin'): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Invoice Payment')): ?>
                        <li class="dash-item <?php echo e(\Request::route()->getName() == 'invoices-payments' ? ' active' : ''); ?>">
                            <a class="dash-link " href="<?php echo e(route('invoices.payments')); ?> ">
                                <span class="dash-micon"><i class="ti ti-credit-card"></i></span><span class="dash-mtext"><?php echo e(__('Payment')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>  -->
                <!-- <?php if(\Auth::user()->type != 'owner'): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Invoice Payment')): ?>
                        <li class="dash-item <?php echo e(\Request::route()->getName() == 'invoices-payments' ? ' active' : ''); ?>">
                            <a class="dash-link " href="<?php echo e(route('invoices.payments')); ?> ">
                                <span class="dash-micon"><i class="ti ti-credit-card"></i></span><span class="dash-mtext"><?php echo e(__('Payment')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?> 
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage CommonCase')): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'commoncases' || \Request::route()->getName() == 'commoncases.show' || \Request::route()->getName() == 'commoncases.edit' ? ' active' : ''); ?>">
                        
                        <a href="<?php echo e(array_key_exists('commoncases',$defaultView) ? route($defaultView['commoncases']) : route('commoncases.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-briefcase"></i></span><span class="dash-mtext"><?php echo e(__('Cases')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>  -->
              
                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Task')): ?> 
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'task' || \Request::route()->getName() == 'task.show' || \Request::route()->getName() == 'task.edit' || \Request::route()->getName() == 'task.gantt.chart' ? ' active' : ''); ?>">
                        
                        <a href="<?php echo e(array_key_exists('task',$defaultView) ? route($defaultView['task']) : route('task.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="fas fa-tasks"></i></span><span class="dash-mtext"><?php echo e(__('Task')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>  -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Meeting')): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'meeting' || \Request::route()->getName() == 'meeting.show' || \Request::route()->getName() == 'meeting.edit' ? ' active' : ''); ?>">
                        
                        <a href="<?php echo e(array_key_exists('meeting',$defaultView) ? route($defaultView['meeting']) : route('meeting.index')); ?>"
                            class="dash-link">
                            <span class="dash-micon"><i class="ti ti-calendar"></i></span><span class="dash-mtext"><?php echo e(__('Event')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(\Auth::user()->type!='super admin'): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'calendar' || \Request::route()->getName() == 'calendar.index' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('calendar.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="far fa-calendar-alt"></i></span><span class="dash-mtext"><?php echo e(__('Calendar')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Call')): ?> 
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'call' || \Request::route()->getName() == 'call.show' || \Request::route()->getName() == 'call.edit' ? ' active' : ''); ?>">
                        
                        <a href="<?php echo e(array_key_exists('call',$defaultView) ? route($defaultView['call']) : route('call.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-phone-call"></i></span><span class="dash-mtext"><?php echo e(__('Call')); ?></span>
                        </a>
                    </li>
                <?php endif; ?> -->
                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Contract')): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Contract')): ?>
                        <li class="dash-item  <?php echo e((Request::route()->getName() == 'contract.index' || Request::route()->getName() == 'contract.show') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('contract.index')); ?>" class="dash-link"><span class="dash-micon"><i class="ti ti-device-floppy"></i></span><span class="dash-mtext"><?php echo e(__('Contracts')); ?></span></a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?> -->
                 <!--<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Document')): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'document' || \Request::route()->getName() == 'document.show' || \Request::route()->getName() == 'document.edit' ? ' active' : ''); ?>">
                        
                        <a href="<?php echo e(array_key_exists('document',$defaultView) ? route($defaultView['document']) : route('document.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-file-analytics"></i></span><span class="dash-mtext"><?php echo e(__('Proposal')); ?></span>
                        </a>
                    </li>
                <?php endif; ?> -->
                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Campaign')): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'campaign' || \Request::route()->getName() == 'campaign.show' || \Request::route()->getName() == 'campaign.edit' ? ' active' : ''); ?>">
                        
                        <a href="<?php echo e(array_key_exists('campaign',$defaultView) ? route($defaultView['campaign']) : route('campaign.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-chart-line"></i></span><span class="dash-mtext"><?php echo e(__('Campaigns')); ?></span>
                        </a>
                    </li>
                <?php endif; ?> -->
                <!--<?php if(\Auth::user()->type != 'super admin'): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'stream' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('stream.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-rss"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Stream')); ?></span>
                        </a>
                    </li>
                <?php endif; ?> 
                <?php if(\Auth::user()->type == 'super admin' || \Auth::user()->type == 'owner'): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'plan' || \Request::route()->getName() == 'plan.show' || \Request::route()->getName() == 'plan.payment' || \Request::route()->getName() == 'plan.edit' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('plan.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-award"></i></span><span class="dash-mtext"><?php echo e(__('Plan')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(\Auth::user()->type == 'super admin'): ?>
                    <li class="dash-item  <?php echo e(\Request::route()->getName() == 'plan_request' || \Request::route()->getName() == 'plan_request.show' || \Request::route()->getName() == 'plan_request.edit' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('plan_request.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-brand-telegram"></i></span><span class="dash-mtext"><?php echo e(__('Plan Request')); ?></span>
                        </a>
                    </li>
                <?php endif; ?> 
                <?php if(\Auth::user()->type == 'super admin'): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'coupon' || \Request::route()->getName() == 'coupon.show' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('coupon.index')); ?>" class="dash-link">
                            <span class="dash-micon"> <i class="ti ti-briefcase"></i></span><span class="dash-mtext"><?php echo e(__('Coupon')); ?></span></a>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(\Auth::user()->type == 'super admin' || \Auth::user()->type == 'owner'): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'order' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('order.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-shopping-cart-plus"></i></span><span
                                class="dash-mtext"><?php echo e(__('Order')); ?></span>
                        </a>
                    </li>
                <?php endif; ?> -->

                <!-- <?php if(\Auth::user()->type == 'owner'): ?> 
                     <li class="dash-item <?php echo e((Request::route()->getName() == 'email_template.index' || Request::segment(1) == 'email_template_lang' || Request::route()->getName() == 'manageemail.lang') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('manage.email.language',[$emailTemplate ->id,\Auth::user()->lang])); ?>" class="dash-link"><span
                        class="dash-micon"><i class="ti ti-template"></i></span><span
                        class="dash-mtext"><?php echo e(__('Email Template')); ?></span></a>
                    </li>
                <?php endif; ?>  -->
                <?php if(\Auth::user()->type == 'owner'): ?> 
                     <li class="dash-item">
                        <a href="<?php echo e(route('email.template.view')); ?>" class="dash-link"><span
                        class="dash-micon"><i class="ti ti-template"></i></span><span
                        class="dash-mtext"><?php echo e(__('Email Template')); ?></span></a>
                    </li>
                <?php endif; ?> 
                <?php if(\Auth::user()->type == 'owner'): ?> 
                     <li class="dash-item">
                        <a href="<?php echo e(route('customer.index')); ?>" class="dash-link"><span
                        class="dash-micon"><i class="ti ti-template"></i></span><span
                        class="dash-mtext"><?php echo e(__('Campaign')); ?></span></a>
                    </li>
                <?php endif; ?> 
                 <!-- <?php if(Gate::check('Manage Report')): ?>
                    <li class="dash-item dash-hasmenu  <?php echo e(\Request::route()->getName() == 'report.index' || \Request::route()->getName() == 'report.show' || \Request::route()->getName() == 'report.edit' ? ' active dash-trigger' : ''); ?>">
                        <a class="dash-link collapsed">
                            <span class="dash-micon"><i class="ti ti-trending-up"></i></span><?php echo e(__('Reports')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>

                        <ul class="dash-submenu">
                            <li class="dash-item <?php echo e(\Request::route()->getName() == 'report.index' || \Request::route()->getName() == 'report.show' || \Request::route()->getName() == 'report.edit' ? ' active ' : ''); ?>">
                                <a href="<?php echo e(route('report.index')); ?>" class="dash-link">
                                    <?php echo e(__('Custom Report')); ?></a>
                            </li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Report')): ?>
                                <li class="dash-item <?php echo e(\Request::route()->getName() == 'report.leadsanalytic' ? ' active ' : ''); ?>">
                                    <a href="<?php echo e(route('report.leadsanalytic')); ?>" class="dash-link">
                                        <?php echo e(__('Leads Analytics')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Report')): ?>
                                <li class="dash-item <?php echo e(\Request::route()->getName() == 'leadsanalytic' ? ' active ' : ''); ?>">
                                    <a href="<?php echo e(route('report.invoiceanalytic')); ?>" class="dash-link">
                                        <?php echo e(__('Invoice Analytics')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Report')): ?>
                                <li class="dash-item <?php echo e(\Request::route()->getName() == 'salesorderanalytic' ? ' active ' : ''); ?>">
                                    <a href="<?php echo e(route('report.salesorderanalytic')); ?>" class="dash-link">
                                        <?php echo e(__('Sales Order Analytics')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Report')): ?>
                                <li class="dash-item  <?php echo e(\Request::route()->getName() == 'quoteanalytic' ? ' active ' : ''); ?>">
                                    <a href="<?php echo e(route('report.quoteanalytic')); ?>" class="dash-link">
                                        <?php echo e(__('Quote Analytics')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>   -->
                 <!-- <?php if(Gate::check('Manage AccountType') || Gate::check('Manage AccountIndustry') || Gate::check('Manage LeadSource') || Gate::check('Manage OpportunitiesStage') || Gate::check('Manage CaseType') || Gate::check('Manage DocumentType') || Gate::check('Manage DocumentFolder') || Gate::check('Manage TargetList') || Gate::check('Manage CampaignType') || Gate::check('Manage ProductCategory') || Gate::check('Manage ProductBrand') || Gate::check('Manage ProductTax') || Gate::check('Manage ShippingProvider') || Gate::check('Manage TaskStage') || Gate::check('Manage Contract Types') || Gate::check('Manage Tax')): ?>
                    <li class="dash-item dash-hasmenu">
                        <a class="dash-link collapsed <?php echo e(\Request::route()->getName() == 'account_type' || \Request::route()->getName() == 'account_industry' || Request::segment(1) == 'lead_source' || Request::segment(1) == 'opportunities_stage' || \Request::route()->getName() == 'case_type' || Request::route()->getName() == 'document_folder' || Request::route()->getName() == 'document_type' || Request::route()->getName() == 'target_list' || Request::route()->getName() == 'campaign_type' || Request::route()->getName() == 'product_category' || Request::segment(1) == 'product_brand' || Request::segment(1) == 'product_tax' || Request::route()->getName() == 'shipping_provider' || Request::route()->getName() == 'task_stage' || Request::route()->getName() == 'contract_type' || Request::route()->getName() == 'taxes' || Request::route()->getName() == 'payments' ? 'true' : 'false'); ?>">
                            <span class="dash-micon"><i class="ti ti-circle-square"></i></span><span class="dash-mtext"><?php echo e(__('Constant')); ?></span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            <?php if(Gate::check('Manage AccountType') || Gate::check('Manage AccountIndustry')): ?>
                                <li class="dash-item dash-hasmenu">
                                    <a class="dash-link"><?php echo e(__('Account')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage AccountType')): ?>
                                            <li class="dash-item">
                                                <a class="dash-link <?php echo e(Request::route()->getName() == 'account_type' ? 'active open' : ''); ?>"
                                                    href="<?php echo e(route('account_type.index')); ?>"><?php echo e(__('Type')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage AccountIndustry')): ?>
                                            <li class="dash-item">
                                                <a class="dash-link <?php echo e(Request::route()->getName() == 'account_industry' ? 'active open' : ''); ?>"
                                                    href="<?php echo e(route('account_industry.index')); ?>"><?php echo e(__('Industry')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <?php if(Gate::check('Manage DocumentType') || Gate::check('Manage DocumentFolder')): ?>
                                <li class="dash-item dash-hasmenu">
                                    <a href="#!" class="dash-link"><?php echo e(__('Document')); ?><span
                                            class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage DocumentFolder')): ?>
                                            <li class="dash-item">
                                                <a class="dash-link <?php echo e(Request::route()->getName() == 'document_folder' ? 'active open' : ''); ?>"
                                                    href="<?php echo e(route('document_folder.index')); ?>"><?php echo e(__('Folder')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage DocumentType')): ?>
                                            <li class="dash-item">
                                                <a class="dash-link <?php echo e(Request::route()->getName() == 'document_type' ? 'active open' : ''); ?>"
                                                    href="<?php echo e(route('document_type.index')); ?>"><?php echo e(__('Type')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <?php if(Gate::check('Manage TargetList') || Gate::check('Manage CampaignType')): ?>
                                <li class="dash-item dash-hasmenu">
                                    <a href="#!" class="dash-link"><?php echo e(__('Campaign')); ?><span
                                            class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage TargetList')): ?>
                                            <li class="dash-item">
                                                <a class="dash-link <?php echo e(Request::route()->getName() == 'target_list' ? 'active open' : ''); ?>"
                                                    href="<?php echo e(route('target_list.index')); ?>"><?php echo e(__('Target Lists')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage CampaignType')): ?>
                                            <li class="dash-item">
                                                <a class="dash-link <?php echo e(Request::route()->getName() == 'campaign_type' ? 'active open' : ''); ?>"
                                                    href="<?php echo e(route('campaign_type.index')); ?>"><?php echo e(__('Type')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <?php if(Gate::check('Manage ProductCategory') || Gate::check('Manage ProductBrand') || Gate::check('Manage ProductTax')): ?>
                                <li class="dash-item dash-hasmenu">
                                    <a href="#!" class="dash-link"><?php echo e(__('Product')); ?><span
                                            class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage ProductCategory')): ?>
                                            <li class="dash-item">
                                                <a class="dash-link <?php echo e(Request::route()->getName() == 'product_category' ? 'active open' : ''); ?>"
                                                    href="<?php echo e(route('product_category.index')); ?>"><?php echo e(__('Category')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage ProductBrand')): ?>
                                            <li class="dash-item">
                                                <a class="dash-link <?php echo e(Request::route()->getName() == 'product_brand' ? 'active open' : ''); ?>"
                                                    href="<?php echo e(route('product_brand.index')); ?>"><?php echo e(__('Brand')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage ProductTax')): ?>
                                            <li class="dash-item">
                                                <a class="dash-link <?php echo e(Request::route()->getName() == 'product_tax' ? 'active open' : ''); ?>"
                                                    href="<?php echo e(route('product_tax.index')); ?>"><?php echo e(__('Tax')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>



                            <?php if(\Auth::user()->type == 'owner' || \Auth::user()->type == 'Manager'): ?>
                                <?php if(Gate::check('Manage ContractType')): ?>
                                    <li class="dash-item">
                                        <a class="dash-link <?php echo e(Request::route()->getName() == 'contract_type' ? 'active open' : ''); ?>"
                                            href="<?php echo e(route('contract_type.index')); ?>"><?php echo e(__('Contract Type')); ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>



                            <?php if(Gate::check('Manage LeadSource')): ?>
                                <li class="dash-item">
                                    <a class="dash-link <?php echo e(Request::route()->getName() == 'lead_source' ? 'active open' : ''); ?>"
                                        href="<?php echo e(route('lead_source.index')); ?>"><?php echo e(__('Lead Source')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(Gate::check('Manage OpportunitiesStage')): ?>
                                <li class="dash-item">
                                    <a class="dash-link <?php echo e(Request::route()->getName() == 'opportunities_stage' ? 'active open' : ''); ?>"
                                        href="<?php echo e(route('opportunities_stage.index')); ?>"><?php echo e(__('Opportunity Stage')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(Gate::check('Manage CaseType')): ?>
                                <li class="dash-item">
                                    <a class="dash-link <?php echo e(Request::route()->getName() == 'case_type' ? 'active open' : ''); ?>"
                                        href="<?php echo e(route('case_type.index')); ?>"><?php echo e(__('Case Type')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(Gate::check('Manage ShippingProvider')): ?>
                                <li class="dash-item">
                                    <a class="dash-link <?php echo e(Request::route()->getName() == 'shipping_provider' ? 'active open' : ''); ?>"
                                        href="<?php echo e(route('shipping_provider.index')); ?>"><?php echo e(__('Shipping Provider')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if(Gate::check('Manage TaskStage')): ?>
                                <li class="dash-item">
                                    <a class="dash-link <?php echo e(Request::route()->getName() == 'task_stage' ? 'active open' : ''); ?>"
                                        href="<?php echo e(route('task_stage.index')); ?>"><?php echo e(__('Task Stage')); ?></a>
                                </li>
                            <?php endif; ?>


                        </ul>
                    </li>
                <?php endif; ?>  -->
                <?php if(\Auth::user()->type =='owner'): ?>
                    <li class="dash-item <?php echo e(\Request::route()->getName() == 'billing' || \Request::route()->getName() == 'billing.index' ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('billing.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="far fa-calendar-alt"></i></span><span class="dash-mtext"><?php echo e(__('Billing')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <!-- <?php if(\Auth::user()->type == 'owner'): ?>
                <?php echo $__env->make('landingpage::menu.landingpage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?> -->
                 <?php if(\Auth::user()->type == 'super admin' || \Auth::user()->type == 'owner'): ?>
                    <li class="dash-item  <?php echo e(Request::route()->getName() == 'settings' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('settings')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-settings"></i></span><span class="dash-mtext"><?php echo e(__('Settings')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<style>
    .main-logo{
    position: relative !important;
    min-width: 150px !important;
    min-height: 150px !important;
    }
</style><?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/partials/admin/menu.blade.php ENDPATH**/ ?>