<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Billing')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Billing')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Billing')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Meeting')): ?>
        <div class="col-12 text-end mt-3">
            <a href="<?php echo e(route('billing.create')); ?>"> 
                <button  data-bs-toggle="tooltip"title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
                <i class="ti ti-plus"></i></button>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table id="datatable" class="table datatable align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="status"><?php echo e(__('Event')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Date Start')); ?></th>
                                    <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Payment Status')); ?></th>
                                    <!-- <th scope="col" class="text-end"><?php echo e(__('Action')); ?></th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $billing; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="" data-size="md"
                                                data-title="<?php echo e(__('Billing Details')); ?>" class="action-item text-primary">
                                                <?php echo e(ucfirst(App\Models\Meeting::where('id',$bill->event_id)->pluck('name')->first())); ?>

                                            </a>
                                        </td>
                                        <td>
                                            <span class="budget"><?php echo e(App\Models\Meeting::where('id',$bill->event_id)->pluck('type')->first()); ?></span>
                                        </td>
                                        <td>
                                            <span class="budget"><?php echo e(App\Models\Meeting::where('id',$bill->event_id)->pluck('start_date')->first()); ?></span>
                                        </td>
                                        <td>
                                        <?php if($bill->status == 0): ?>
                                            <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\Billingdetail::$status[$bill->status])); ?></span>
                                        <?php elseif($bill->status == 1): ?>
                                        <span class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Billingdetail::$status[$bill->status])); ?></span>
                                        <?php elseif($bill->status == 2): ?>
                                        <span class="badge bg-success p-2 px-3 rounded"><?php echo e(__(\App\Models\Billingdetail::$status[$bill->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                        <!-- <td class="text-end">
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['billing.destroy', $bill->id]]); ?>

                                                <a href="#!"
                                                    class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
                                                    data-bs-toggle="tooltip" title='Delete'>
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                                <?php echo Form::close(); ?>

                                            </div>
                                        </td> -->
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/billing/index.blade.php ENDPATH**/ ?>