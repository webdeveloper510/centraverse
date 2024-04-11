
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Customers')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Customers')); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<a href="#" data-url="<?php echo e(route('uploadusersinfo')); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip"
    data-title="<?php echo e(__('Upload User')); ?>" title="<?php echo e(__('Upload')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
    <i class="ti ti-plus"></i>
</a>
<!-- <a href="<?php echo e(route('exportuser')); ?>" data-bs-toggle="tooltip" data-title="<?php echo e(__('Export User')); ?>" title="<?php echo e(__('Export')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
    <i class="ti ti-table-export"></i>
</a> -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('All Customers')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Email')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Phone')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Address')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Category')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $allcustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <?php if($customers->category == 'event'): ?>
                                                    <a href="<?php echo e(route('meeting.detailview',urlencode(encrypt($customers->ref_id)))); ?>"
                                                        title="<?php echo e(__('User Details')); ?>"
                                                        class="action-item text-primary"
                                                        style="color:#1551c9 !important;">
                                                        <b> <?php echo e(ucfirst($customers->name)); ?></b>
                                                    </a>
                                                    <?php else: ?>
                                                    <a href="<?php echo e(route('lead.info',urlencode(encrypt($customers->ref_id)))); ?>"
                                                        data-size="md" title="<?php echo e(__('Lead Details')); ?>"
                                                        class="action-item text-primary"
                                                        style="color:#1551c9 !important;">
                                                        <b> <?php echo e(ucfirst($customers->name)); ?></b>
                                                    </a>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e(ucfirst($customers->email)); ?></td>
                                                <td><?php echo e(ucfirst($customers->phone)); ?></td>
                                                <td><?php echo e(ucfirst($customers->address)); ?></td>
                                                <td><?php echo e(ucfirst($customers->type)); ?></td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $importedcustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customers): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td> <a href="<?php echo e(route('customer.info',urlencode(encrypt($customers->id)))); ?>"
                                                        data-size="md" title="<?php echo e(__('User Details')); ?>"
                                                        class="action-item text-primary"
                                                        style="color:#1551c9 !important;">
                                                        <b> <?php echo e(ucfirst($customers->name)); ?></b>
                                                    </a>
                                                </td>
                                                <td><?php echo e(ucfirst($customers->email)); ?></td>
                                                <td><?php echo e(ucfirst($customers->phone)); ?></td>
                                                <td><?php echo e(ucfirst($customers->address)); ?></td>
                                                <td><?php echo e(ucfirst($customers->category)); ?></td>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/customer/allcustomers.blade.php ENDPATH**/ ?>