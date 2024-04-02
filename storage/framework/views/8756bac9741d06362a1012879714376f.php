
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Invoice')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Invoice')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Invoice')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <div class="table-responsive overflow_hidden">
                                    <table id="datatable" class="table datatable align-items-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Event')); ?></th>
                                                <th scope="col" class="sort" data-sort="completion">
                                                    <?php echo e(__('Event Date')); ?></th>
                                                <th scope="col" class="sort" data-sort="completion">
                                                    <?php echo e(__('Payment Status')); ?></th>
                                                <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <a href="" data-size="md" data-title="<?php echo e(__('Invoice Details')); ?>"
                                                        class="action-item text-primary">
                                                        <?php echo e(ucfirst($event->name)); ?>

                                                    </a>
                                                </td>
                                                <td>
                                                    <span class="budget"><?php echo e(ucfirst($event->type)); ?></span>
                                                </td>
                                                <td>
                                                    <?php if($event->start_date == $event->end_date): ?>
                                                    <span
                                                        class="budget"><?php echo e(\Auth::user()->dateFormat($event->start_date)); ?></span>
                                                    <?php elseif($event->start_date != $event->end_date): ?>
                                                    <span
                                                        class="budget"><?php echo e(Carbon\Carbon::parse($event->start_date)->format('M d')); ?>

                                                        - <?php echo e(\Auth::user()->dateFormat($event->end_date)); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if(\App\Models\Billing::where('event_id',$event->id)->exists()): ?>
                                                    <?php $bill = \App\Models\Billing::where('event_id', $event->id)->pluck('status')->first() ?>
                                                    <?php if($bill == 1): ?>
                                                    <span
                                                        class=" text-info"><?php echo e(__(\App\Models\Billing::$status[$bill])); ?></span>
                                                    <?php elseif($bill == 2): ?>
                                                    <span
                                                        class=" text-warning "><?php echo e(__(\App\Models\Billing::$status[$bill])); ?></span>
                                                    <?php else: ?>
                                                    <span
                                                        class=" text-success"><?php echo e(__(\App\Models\Billing::$status[$bill])); ?></span>
                                                    <?php endif; ?>
                                                    <?php else: ?>
                                                    <span
                                                        class=" text-danger "><?php echo e(__(\App\Models\Billing::$status[0])); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-end">
                                                    <?php if(!(\App\Models\Billing::where('event_id',$event->id)->exists())): ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Payment')): ?>
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" data-size="md"
                                                            data-url="<?php echo e(route('billing.create',['billing',$event->id])); ?>"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                                                            data-ajax-popup="true"
                                                            data-title="<?php echo e(__('Invoice Details')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-plus"></i>
                                                        </a>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if(\App\Models\Billing::where('event_id',$event->id)->exists()): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payment')): ?>
                                                    <?php if(App\Models\Billing::where('event_id',$event->id)->where('status','!=',4)->exists()): ?>
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" data-size="md"
                                                            data-url="<?php echo e(route('billing.paylink',$event->id)); ?>"
                                                            data-bs-toggle="tooltip"
                                                            title="<?php echo e(__('Share Payment Link')); ?>" data-ajax-popup="true"
                                                            data-title="<?php echo e(__('Payment Link')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-share"></i>
                                                        </a>
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" data-size="md"
                                                            data-url="<?php echo e(route('billing.paymentinfo',urlencode(encrypt($event->id)))); ?>"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Payment Details')); ?>"
                                                            data-ajax-popup="true"
                                                            data-title="<?php echo e(__('Payment Information')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class=" fa fa-credit-card "></i>
                                                        </a>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payment')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="#" data-size="md"
                                                            data-url="<?php echo e(route('billing.show',$event->id)); ?>"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>"
                                                            data-ajax-popup="true"
                                                            data-title="<?php echo e(__('Invoice Details')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Payment')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' =>
                                                        ['billing.destroy', $event->id]]); ?>


                                                        <a href="#!"
                                                            class="mx-3 btn btn-sm  align-items-center text-white show_confirm"
                                                            data-bs-toggle="tooltip" title='Delete'>
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                                    <?php endif; ?>
                                                    <?php endif; ?>

                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/billing/index.blade.php ENDPATH**/ ?>