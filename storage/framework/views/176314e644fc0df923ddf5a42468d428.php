
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Payment')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
        <div class="page-header-title">
            <h4 class="m-b-10"><?php echo e(__('Payment')); ?></h4>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
            <li class="breadcrumb-item " aria-current="page"><?php echo e(__('Payment')); ?></li>
        </ul>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable" id="datatable">
                        <thead>
                            <tr>
                                <th> <?php echo e(__('Transaction ID')); ?></th>
                                    <th> <?php echo e(__('Invoice')); ?></th>
                                    <th> <?php echo e(__('Payment Date')); ?></th>
                                    
                                    <th> <?php echo e(__('Payment Type')); ?></th>
                                    <th> <?php echo e(__('Note')); ?></th>
                                    <th> <?php echo e(__('Amount')); ?></th>
                                    <?php if(Gate::check('Show Invoice')): ?>
                                        <th><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(sprintf("%05d", $payment->transaction_id)); ?></td>
                                <td><?php echo e(\Auth::user()->invoiceNumberFormat($payment->invoice->invoice_id)); ?></td>
                                <td><?php echo e(Auth::user()->dateFormat($payment->date)); ?></td>
                                
                                <td><?php echo e($payment->payment_type); ?></td>
                                <td><?php echo e(!empty($payment->notes) ? $payment->notes : '-'); ?></td>
                                <td><?php echo e(Auth::user()->priceFormat($payment->amount)); ?></td>
                                <?php if(Gate::check('Show Invoice')): ?>

                                    <td class="Action">
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="<?php echo e(route('invoice.show',$payment->invoice->id)); ?>"
                                                data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"
                                                class="mx-3 btn btn-sm align-items-center text-white "
                                                data-title="<?php echo e(__('Invoice Details')); ?>">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                <?php endif; ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/invoice/all-payments.blade.php ENDPATH**/ ?>