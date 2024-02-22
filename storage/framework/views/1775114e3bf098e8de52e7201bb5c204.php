
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Campaign')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="page-header-title">
        <?php echo e(__('Campaign')); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('View Campaigns')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
                    
                        <a href="<?php echo e(route('campaign-list')); ?>" class="list-group-item list-group-item-action">
                        <span class="fa-stack fa-lg pull-left"><i class="ti ti-eye"></i></span>
                        <span class="dash-mtext"><?php echo e(__('View Campaigns')); ?> </span></a>
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
                                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Title')); ?></th>
                                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Type')); ?></th>
                                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Created At')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Due date')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Action')); ?></th>                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $campaignlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <span class="budget"><b><?php echo e(ucfirst($campaign->title)); ?></b></span>
                                                </td>
                                                <td>
                                                <span class="budget"><b><?php echo e(ucfirst($campaign->type)); ?></b></span>
                                                </td>
                                                <td>
                                                    <span class="budget"><?php echo e(ucfirst($campaign->created_at)); ?></span>
                                                </td>
                                                <td><span class="col-sm-12"><span class="text-sm"></span></span></td>
                                                <td></td>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/customer/campaignlist.blade.php ENDPATH**/ ?>