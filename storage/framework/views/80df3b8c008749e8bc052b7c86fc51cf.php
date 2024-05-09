<?php
$plansettings = App\Models\Utility::plansettings();
?>

<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Contracts')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Contracts')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item "><a href="<?php echo e(route('contracts.index')); ?>"><?php echo e(__('Contracts')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('New Contract')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<!-- <a href="<?php echo e(route('contact.grid')); ?>" class="btn btn-sm btn-primary btn-icon m-1"
            data-bs-toggle="tooltip"title="<?php echo e(__('Grid View')); ?>">
            <i class="ti ti-layout-grid text-white"></i>
    </a> -->
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Contact')): ?>
<a href="#" data-url="<?php echo e(route('contracts.newtemplate')); ?>" data-size="lg" data-ajax-popup="true"
    data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Template')); ?>" title="<?php echo e(__('Create')); ?>"
    class="btn btn-sm btn-primary btn-icon m-1">
    Create New Template
</a>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">
    <div id="page-content-wrapper">
    <div class="container-fluid xyz p0">
        <div class="row">
            <div class="col-lg-12">
                <div id="useradd-1" class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <ul class="list-group" >   <li class="list-group-item list-group-header" style=" background: #dbe1e6;"><b> Use Templates</b></li></ul>
                            <ul class="list-group" style="display: grid; grid-template-columns: repeat(3, 1fr);">
                                <!-- <li class="list-group-item list-group-header" style=" background: #dbe1e6;"><b> Use Templates</b></li>
                                <li class="list-group-item list-group-header" style=" background: #dbe1e6;"></li>
                                <li class="list-group-item list-group-header" style=" background: #dbe1e6;"></li> -->
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list-group-item list-item-style">
                                            <a href="<?php echo e(route('contracts.detail',$res['id'])); ?>" target="_blank" data-size="md"
                                                class="action-item text-primary" style="color:#1551c9 !important;">
                                                <b><?php echo e(ucfirst(str_replace('[DEV] ', '', $res['name']))); ?></b>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
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

<script>
document.querySelector("#pc-daterangepicker-2").flatpickr({
    mode: "range"
});
</script>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/contract/create.blade.php ENDPATH**/ ?>