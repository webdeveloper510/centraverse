
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Emails')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Emails')); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Emails')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>

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
                                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Type')); ?></th>

                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(ucfirst($lead->name)); ?></td>
                                                <td><?php echo e(ucfirst($lead->type)); ?></td>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/email_integration/index.blade.php ENDPATH**/ ?>