<?php $__env->startSection('breadcrumb'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Home')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz" id="useradd-1">
                <div class="row">
                    <?php if(\Auth::user()->type == 'owner'||\Auth::user()->type == 'Admin'): ?>
                    <div class="col-lg-4 col-sm-12 totallead" style="padding: 15px;">
                        <div class="card">
                            <div class="card-body newcard_body" onclick="leads();">
                                <div class="theme-avtar bg-info">
                                    <i class="fas fa-address-card"></i>
                                </div>
                                <div class="right_side">
                                    <h6 class="mb-3"><?php echo e(__('Active Leads')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($data['totalLead']); ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12" id="toggleDiv" style="padding: 15px;">
                        <div class="card">
                            <div class="card-body newcard_body">
                                <div class="theme-avtar bg-warning">
                                    <i class="fa fa-tasks"></i>
                                </div>
                                <div class="right_side">
                                    <h6 class="mb-3"><?php echo e(__('Active/Upcoming Events')); ?></h6>
                                    <h3 class="mb-0"><?php echo e(@$totalevent); ?> </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-12" style="padding: 15px;">
                        <div class="card">
                            <div class="card-body newcard_body">
                                <div class="theme-avtar bg-success">
                                    <i class="fa fa-dollar-sign"></i>
                                </div>
                                <div class="right_side">
                                    <h6 class="mb-3"><?php echo e(__('Amount(E)')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($events_revenue != 0 ? '$'.number_format($events_revenue) : '--'); ?></h3>

                                    <!-- </div>
                                    <div class="right_side" style="    width: 35% !important;"> -->
                                    <h6 class="mb-3"><?php echo e(__('Amount Recieved(E)')); ?></h6>
                                    <h3 class="mb-0">
                                        <?php echo e($events_revenue_generated != 0 ? '$'.number_format($events_revenue_generated) : '--'); ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endif; ?>
                    <?php
                    $setting = App\Models\Utility::settings();
                    ?>
                </div>

                <div class="row">
                    <div class="col-sm">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Active Leads</h5>
                            <?php $__currentLoopData = $activeLeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card">
                                <div class="card-body new_bottomcard">
                                    <h5 class="card-text"><?php echo e($lead['leadname']); ?>

                                        <span>(<?php echo e($lead['type']); ?>)</span>
                                    </h5>
                                    <?php if($lead['start_date'] == $lead['end_date']): ?>
                                    <p><?php echo e(Carbon\Carbon::parse($lead['start_date'])->format('M d')); ?></p>
                                    <?php else: ?>
                                    <p><?php echo e(Carbon\Carbon::parse($lead['start_date'])->format('M d')); ?> -
                                        <?php echo e(\Auth::user()->dateFormat($lead['end_date'])); ?>

                                    </p>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                    <div class="action-btn bg-warning ms-2">
                                        <a href="javascript:void(0);" data-size="md"
                                            data-url="<?php echo e(route('lead.show',$lead['id'])); ?>" data-bs-toggle="tooltip"
                                            title="<?php echo e(__('Quick View')); ?>" data-ajax-popup="true"
                                            data-title="<?php echo e(__('Lead Details')); ?>"
                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Lead')): ?>
                            <div class="col-12 text-end mt-3">
                                <a href="javascript:void(0);" data-url="<?php echo e(route('lead.create',['lead',0])); ?>"
                                    data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip"
                                    data-title="<?php echo e(__('Create New Lead')); ?>" title="<?php echo e(__('Create Lead')); ?>"
                                    class="btn btn-sm btn-primary btn-icon m-1">
                                    <i class="ti ti-plus"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="col-sm">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Active/Upcoming Events</h5>
                            <?php $__currentLoopData = $activeEvent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-text"><?php echo e($event['name']); ?>

                                        <span>(<?php echo e($event['type']); ?>)</span>
                                    </h5>
                                    <?php if($event['start_date'] == $event['end_date']): ?>
                                    <p><?php echo e(Carbon\Carbon::parse($event['start_date'])->format('M d')); ?></p>
                                    <?php else: ?>
                                    <p><?php echo e(Carbon\Carbon::parse($event['start_date'])->format('M d')); ?> -
                                        <?php echo e(\Auth::user()->dateFormat($event['end_date'])); ?>

                                    </p>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Meeting')): ?>
                                    <div class="action-btn bg-warning ms-2">
                                        <a href="javascript:void(0);" data-size="md"
                                            data-url="<?php echo e(route('meeting.show', $event['id'])); ?>" data-ajax-popup="true"
                                            data-bs-toggle="tooltip" data-title="<?php echo e(__('Event Details')); ?>"
                                            title="<?php echo e(__('Quick View')); ?>"
                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Meeting')): ?>
                            <div class="col-12 text-end mt-3">
                                <a href="<?php echo e(route('meeting.create',['meeting',0])); ?>">
                                    <button data-bs-toggle="tooltip" title="<?php echo e(__('Create Event')); ?>"
                                        class="btn btn-sm btn-primary btn-icon m-1">
                                        <i class="ti ti-plus"></i></button>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="col-sm">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Finance</h5>
                            <div class="card">
                                <div class="card-body">
                                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php 
                                            $pay = App\Models\PaymentLogs::where('event_id',$event['id'])->get();
                                            $total = 0;
                                            foreach($pay as $p){
                                            $total += $p->amount;
                                            }
                                        ?>
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-text"><?php echo e($event['name']); ?>

                                                <span>(<?php echo e($event['type']); ?>)</span>
                                            </h5>

                                            <?php if($event['start_date'] == $event['end_date']): ?>
                                            <p><?php echo e(Carbon\Carbon::parse($event['start_date'])->format('M d, Y')); ?></p>
                                            <?php else: ?>
                                            <p><?php echo e(Carbon\Carbon::parse($event['start_date'])->format('M d, Y')); ?> -
                                                <?php echo e(\Auth::user()->dateFormat($event['end_date'])); ?>

                                            </p>
                                            <?php endif; ?>
                                            <div style="    color: #a99595;">
                                            Billing Amount: $<?php echo e(number_format($event['total'])); ?><br>
                                            Pending Amount: $<?php echo e(number_format($event['total']- $total)); ?>

                                            </div>
                                           
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<style>
h5.card-text {
    font-size: 16px;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmcentraverse/public_html/resources/views/home.blade.php ENDPATH**/ ?>