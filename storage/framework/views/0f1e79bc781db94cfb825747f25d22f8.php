

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Email Templates')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Email Templates')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Email Templates')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('js/plugins/tinymce/tinymce.min.js')); ?>"></script>
    <script>
        if ($(".pc-tinymce-2").length) {
            tinymce.init({
                selector: '.pc-tinymce-2',
                height: "400",
                content_style: 'body { font-family: "Inter", sans-serif; }'
            });
        }

        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
            });
        });

    </script>
<?php $__env->stopPush(); ?>
<?php
  $lang = isset($users->lang) ? $users->lang : 'en';
  if ($lang == null) {
      $lang = 'en';
  }
  $LangName = $currEmailTempLang->language;
?>
<?php $__env->startSection('action-btn'); ?>
    <div class="text-end mb-3">
        <div class="d-flex justify-content-end drp-languages">
            <ul class="list-unstyled mb-0 m-2">
                <li class="dropdown dash-h-item drp-language" style="list-style-type: none;">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="drp-text hide-mob text-primary"><?php echo e(ucFirst($LangName->fullName)); ?></span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('manage.email.language', [$emailTemplate->id, $code])); ?>"
                                class="dropdown-item <?php echo e($currEmailTempLang->lang == $lang ? 'text-primary' : ''); ?>"><?php echo e(ucfirst($lang)); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </li>
            </ul>
            <ul class="list-unstyled mb-0 m-2">
                <li class="dropdown dash-h-item drp-language" style="list-style-type: none;">
                    <a class="dash-head-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="drp-text hide-mob text-primary"><?php echo e(__('Template: ')); ?>

                            <?php echo e($emailTemplate->name); ?></span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                        <?php $__currentLoopData = $EmailTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $EmailTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('manage.email.language', [$EmailTemplate->id, Request::segment(3) ? Request::segment(3) : \Auth::user()->lang])); ?>"
                                class="dropdown-item <?php echo e($emailTemplate->name == $EmailTemplate->name ? 'text-primary' : ''); ?>"><?php echo e($EmailTemplate->name); ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </li>
            </ul>
        </div>
    </div> 
   
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-12">
            <div class="row">

            </div>
            <div class="card">
                <div class="card-body">

                    <div class="language-wrap">
                        <div class="row">
                            <h6><?php echo e(__('Place Holders')); ?></h6>
                            <div class="col-lg-12 col-md-9 col-sm-12 language-form-wrap">

                                <div class="card">
                                    <div class="card-header card-body">
                                        <div class="row text-xs">
                                            <?php if($emailTemplate->slug == 'new_user'): ?>
                                                <div class="row">
                                                    <p class="col-6"><?php echo e(__('App Name')); ?> : <span
                                                            class="pull-end text-primary">{app_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{company_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('App Url')); ?> : <span
                                                            class="pull-right text-primary">{app_url}</span></p>
                                                    <p class="col-6"><?php echo e(__('Email')); ?> : <span
                                                            class="pull-right text-primary">{email}</span></p>
                                                    <p class="col-6"><?php echo e(__('Password')); ?> : <span
                                                            class="pull-right text-primary">{password}</span></p>
                                                </div>
                                            <?php elseif($emailTemplate->slug == 'lead_assigned'): ?>
                                                <div class="row">
                                                    <p class="col-6"><?php echo e(__('App Name')); ?> : <span
                                                            class="pull-end text-primary">{app_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{company_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('App Url')); ?> : <span
                                                            class="pull-right text-primary">{app_url}</span></p>
                                                    <p class="col-6"><?php echo e(__('Lead Name')); ?> : <span
                                                            class="pull-right text-primary">{lead_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Lead Email')); ?> : <span
                                                            class="pull-right text-primary">{lead_email}</span></p>
                                                    <p class="col-6"><?php echo e(__('Lead Assign User')); ?> : <span
                                                            class="pull-right text-primary">{lead_assign_user}</span></p>
                                                    <p class="col-6"><?php echo e(__('Lead Description')); ?> : <span
                                                            class="pull-right text-primary">{lead_description}</span></p>
                                                    <p class="col-6"><?php echo e(__('Lead Source')); ?> : <span
                                                            class="pull-right text-primary">{lead_source}</span></p>
                                                </div>
                                            <?php elseif($emailTemplate->slug == 'task_assigned'): ?>
                                                <div class="row">
                                                    <p class="col-6"><?php echo e(__('App Name')); ?> : <span
                                                            class="pull-end text-primary">{app_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{company_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('App Url')); ?> : <span
                                                            class="pull-right text-primary">{app_url}</span></p>
                                                    <p class="col-6"><?php echo e(__('Task Name')); ?> : <span
                                                            class="pull-right text-primary">{task_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Task Start Date')); ?> : <span
                                                            class="pull-right text-primary">{task_start_date}</span></p>
                                                    <p class="col-6"><?php echo e(__('Task Due Date')); ?> : <span
                                                            class="pull-right text-primary">{task_due_date}</span></p>
                                                    <p class="col-6"><?php echo e(__('Task Stage')); ?> : <span
                                                            class="pull-right text-primary">{task_stage}</span></p>
                                                    <p class="col-6"><?php echo e(__('Task Assign User')); ?> : <span
                                                            class="pull-right text-primary">{task_assign_user}</span></p>
                                                    <p class="col-6"><?php echo e(__('Task Description')); ?> : <span
                                                            class="pull-right text-primary">{task_description}</span></p>
                                                </div>
                                            <?php elseif($emailTemplate->slug == 'quote_created'): ?>
                                                <div class="row">
                                                    <p class="col-6"><?php echo e(__('App Name')); ?> : <span
                                                            class="pull-end text-primary">{app_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{company_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('App Url')); ?> : <span
                                                            class="pull-right text-primary">{app_url}</span></p>
                                                    <p class="col-6"><?php echo e(__('Quote Number')); ?> : <span
                                                            class="pull-right text-primary">{quote_number}</span></p>
                                                    <p class="col-6"><?php echo e(__('Billing Address')); ?> : <span
                                                            class="pull-right text-primary">{billing_address}</span></p>
                                                    <p class="col-6"><?php echo e(__('Shipping Address')); ?> : <span
                                                            class="pull-right text-primary">{shipping_address}</span></p>
                                                    <p class="col-6"><?php echo e(__('Quotation Description')); ?> : <span
                                                            class="pull-right text-primary">{description}</span></p>
                                                    <p class="col-6"><?php echo e(__('Quote Assign User')); ?> : <span
                                                            class="pull-right text-primary">{quote_assign_user}</span></p>
                                                    <p class="col-6"><?php echo e(__('Quoted Date')); ?> : <span
                                                            class="pull-right text-primary">{date_quoted}</span></p>
                                                </div>
                                            <?php elseif($emailTemplate->slug == 'new_sales_order'): ?>
                                                <div class="row">
                                                    <p class="col-6"><?php echo e(__('App Name')); ?> : <span
                                                            class="pull-end text-primary">{app_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{company_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('App Url')); ?> : <span
                                                            class="pull-right text-primary">{app_url}</span></p>
                                                    <p class="col-6"><?php echo e(__('Quote Number')); ?> : <span
                                                            class="pull-right text-primary">{quote_number}</span></p>
                                                    <p class="col-6"><?php echo e(__('Billing Address')); ?> : <span
                                                            class="pull-right text-primary">{billing_address}</span></p>
                                                    <p class="col-6"><?php echo e(__('Shipping Address')); ?> : <span
                                                            class="pull-right text-primary">{shipping_address}</span></p>
                                                    <p class="col-6"><?php echo e(__('Quotation Description')); ?> : <span
                                                            class="pull-right text-primary">{description}</span></p>
                                                    <p class="col-6"><?php echo e(__('Quoted Date')); ?> : <span
                                                            class="pull-right text-primary">{date_quoted}</span></p>
                                                    <p class="col-6"><?php echo e(__('Salesorder Assign User')); ?> : <span
                                                            class="pull-right text-primary">{salesorder_assign_user}</span>
                                                    </p>

                                                </div>
                                            <?php elseif($emailTemplate->slug == 'new_invoice' || $emailTemplate->slug == 'invoice_payment_recored'): ?>
                                                <div class="row">
                                                    <p class="col-6"><?php echo e(__('App Name')); ?> : <span
                                                            class="pull-end text-primary">{app_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{company_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('App Url')); ?> : <span
                                                            class="pull-right text-primary">{app_url}</span></p>
                                                    <p class="col-6"><?php echo e(__('Invoice Number')); ?> : <span
                                                            class="pull-right text-primary">{invoice_id}</span></p>
                                                    <p class="col-6"><?php echo e(__('Invoice Client')); ?> : <span
                                                            class="pull-right text-primary">{invoice_client}</span></p>
                                                    <p class="col-6"><?php echo e(__('Invoice Issue Date')); ?> : <span
                                                            class="pull-right text-primary">{created_at}</span></p>
                                                    <p class="col-6"><?php echo e(__('Invoice Status')); ?> : <span
                                                            class="pull-right text-primary">{invoice_status}</span></p>
                                                    <p class="col-6"><?php echo e(__('Invoice Total')); ?> : <span
                                                            class="pull-right text-primary">{invoice_total}</span></p>
                                                    <p class="col-6"><?php echo e(__('Invoice Sub Total')); ?> : <span
                                                            class="pull-right text-primary">{invoice_sub_total}</span></p>

                                                </div>
                                            <?php elseif($emailTemplate->slug == 'meeting_assigned'): ?>
                                                <div class="row">
                                                    <p class="col-6"><?php echo e(__('App Name')); ?> : <span
                                                            class="pull-end text-primary">{app_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{company_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('App Url')); ?> : <span
                                                            class="pull-right text-primary">{app_url}</span></p>
                                                    <p class="col-6"><?php echo e(__('Attendees User')); ?> : <span
                                                            class="pull-right text-primary">{attendees_user}</span></p>
                                                    <p class="col-6"><?php echo e(__('Attendees Contact')); ?> : <span
                                                            class="pull-right text-primary">{attendees_contact}</span></p>
                                                    <p class="col-6"><?php echo e(__('Meeting Title')); ?> : <span
                                                            class="pull-right text-primary">{meeting_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Meeting Start Date')); ?> : <span
                                                            class="pull-right text-primary">{meeting_start_date}</span></p>
                                                    <p class="col-6"><?php echo e(__('Meeting Due Date')); ?> : <span
                                                            class="pull-right text-primary">{meeting_due_date}</span></p>
                                                    <p class="col-6"><?php echo e(__('Meeting Assign User')); ?> : <span
                                                            class="pull-right text-primary">{meeting_assign_user}</span>
                                                    </p>
                                                    <p class="col-6"><?php echo e(__('Meeting Description')); ?> : <span
                                                            class="pull-right text-primary">{meeting_description}</span>
                                                    </p>
                                                </div>
                                            <?php elseif($emailTemplate->slug == 'campaign_assigned'): ?>
                                                <div class="row">
                                                    <p class="col-6"><?php echo e(__('App Name')); ?> : <span
                                                            class="pull-end text-primary">{app_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{company_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('App Url')); ?> : <span
                                                            class="pull-right text-primary">{app_url}</span></p>
                                                    <p class="col-6"><?php echo e(__('Campaign Title')); ?> : <span
                                                            class="pull-right text-primary">{campaign_title}</span></p>
                                                    <p class="col-6"><?php echo e(__('Campaign Status')); ?> : <span
                                                            class="pull-right text-primary">{campaign_status}</span></p>
                                                    <p class="col-6"><?php echo e(__('Campaign Start Date')); ?> : <span
                                                            class="pull-right text-primary">{campaign_start_date}</span>
                                                    </p>
                                                    <p class="col-6"><?php echo e(__('Campaign Due Date')); ?> : <span
                                                            class="pull-right text-primary">{campaign_due_date}</span></p>
                                                    <p class="col-6"><?php echo e(__('Campaign Assign User')); ?> : <span
                                                            class="pull-right text-primary">{campaign_assign_user}</span>
                                                    </p>
                                                    <p class="col-6"><?php echo e(__('Campaign Description')); ?> : <span
                                                            class="pull-right text-primary">{campaign_description}</span>
                                                    </p>
                                                </div>
                                            <?php elseif($emailTemplate->slug == 'new_contract'): ?>
                                                <div class="row">
                                                    <p class="col-6"><?php echo e(__('App Name')); ?> : <span
                                                            class="pull-end text-primary">{app_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{company_name}</span></p>
                                                    <p class="col-6"><?php echo e(__('App Url')); ?> : <span
                                                            class="pull-right text-primary">{app_url}</span></p>
                                                    <p class="col-6"><?php echo e(__('Contract Client')); ?> : <span
                                                            class="pull-right text-primary">{contract_client}</span></p>
                                                    <p class="col-6"><?php echo e(__('Contract Subject')); ?> : <span
                                                            class="pull-right text-primary">{contract_subject}</span></p>
                                                    <p class="col-6"><?php echo e(__('Contract Start_Date')); ?> : <span
                                                            class="pull-right text-primary">{contract_start_date}</span>
                                                    </p>
                                                    <p class="col-6"><?php echo e(__('Contract End_Date')); ?> : <span
                                                            class="pull-right text-primary">{contract_end_date}</span></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-9 col-sm-12 language-form-wrap">
                                <?php echo e(Form::model($currEmailTempLang, ['route' => ['email_template.update', $currEmailTempLang->parent_id], 'method' => 'PUT'])); ?>

                                <div class="row">
                                    <div class="form-group col-12">
                                        <?php echo e(Form::label('subject', __('Subject'), ['class' => 'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('subject', null, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('name', __('Name'), ['class' => 'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('name', $emailTemplate->name, ['class' => 'form-control font-style', 'disabled' => 'disabled'])); ?>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('from', __('From'), ['class' => 'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('from', $emailTemplate->from, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

                                    </div>
                                    <div class="form-group col-12">
                                        <?php echo e(Form::label('content', __('Email Message'), ['class' => 'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::textarea('content', $currEmailTempLang->content, ['class' => 'summernote', 'required' => 'required'])); ?>


                                    </div>


                                    <div class="col-md-12 text-end">
                                        <?php echo e(Form::hidden('lang', null)); ?>

                                        <input type="submit" value="<?php echo e(__('Save')); ?>"
                                            class="btn btn-print-invoice  btn-primary">
                                    </div>

                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/email_templates/show.blade.php ENDPATH**/ ?>