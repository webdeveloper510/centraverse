<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Customer')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Customer')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Customer')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<a href="#" data-url="<?php echo e(route('uploadusersinfo')); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('Upload User')); ?>" title="<?php echo e(__('Upload')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
    <i class="ti ti-plus"></i>
</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
                    <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="ti ti-users"></i></span>
                        <span class="dash-mtext"><?php echo e(__('Customer List')); ?> </span></a>

                    </a>
                </div>
            </div>
        </div>
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
                                                <th scope="col" class="sort"><?php echo e(__('Organization')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><span><?php echo e(ucfirst($user->name)); ?></span></td>
                                                <td><span><?php echo e(ucfirst($user->email)); ?></span></td>
                                                <td><span><?php echo e(ucfirst($user->phone)); ?></span></td>
                                                <td><span><?php echo e(ucfirst($user->address)); ?></span></td>
                                                <td><span><?php echo e(ucfirst($user->organization)); ?></span></td>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/customer/new_user.blade.php ENDPATH**/ ?>