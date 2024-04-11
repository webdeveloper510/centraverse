
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
<a href="<?php echo e(route('exportuser')); ?>" data-bs-toggle="tooltip" data-title="<?php echo e(__('Export User')); ?>" title="<?php echo e(__('Export')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
    <i class="ti ti-table-export"></i>
</a>
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
                                                <th scope="col" class="sort"><?php echo e(__('Category')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Address')); ?></th>
                                                <!-- <th scope="col" class="sort"><?php echo e(__('Organization')); ?></th> -->
                                                <!-- <th scope="col" class="sort"><?php echo e(__('Actions')); ?></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                
                                                <td>
                                                    <!-- <a href="#" data-size="md" data-url="<?php echo e(route('importcustomerview',$user->id)); ?>"
                                                    data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('User Details')); ?>"  
                                                        title="<?php echo e(__('User Details')); ?>"
                                                        class="action-item text-primary"
                                                        style="color:#1551c9 !important;">
                                                        <b> <?php echo e(ucfirst($user->name)); ?></b>
                                                    </a> -->
                                                    <a href="<?php echo e(route('customer.info',urlencode(encrypt($user->id)))); ?>" data-size="md" title="<?php echo e(__('User Details')); ?>"  class="action-item text-primary" style="color:#1551c9 !important;">
                                               <b> <?php echo e(ucfirst($user->name)); ?></b>
                                                        </a>
                                                </td>
                                                <td><span><?php echo e($user->email); ?></span></td>
                                                <td><span><?php echo e($user->phone); ?></span></td>
                                                <td><span><?php echo e(ucfirst($user->category)); ?></span></td>
                                                <td><span><?php echo e(ucfirst($user->address)); ?></span></td>
                                                <!-- <td>
                                                <?php if($user->status == 0): ?>
                                                    <span
                                                        class="badge bg-success p-2 px-3 rounded"><?php echo e(App\Models\UserImport::$status[$user->status]); ?></span>
                                                <?php else: ?>
                                                    <span
                                                        class="badge bg-danger p-2 px-3 rounded"><?php echo e(App\Models\UserImport::$status[$user->status]); ?></span>
                                                <?php endif; ?>
                                            </td>
                                                <td><span><?php echo e(ucfirst($user->organization)); ?></span></td> -->
                                                <!-- <td>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" data-url="<?php echo e(route('lead.create',['lead',0])); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white " id="<?php echo e($user->id); ?>" onclick="storeIdInLocalStorage(this)" data-bs-toggle="tooltip" title="<?php echo e(__('Convert Lead')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create Lead')); ?>"><i class="fas fa-exchange-alt"></i></a>
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
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<script>
    function storeIdInLocalStorage(link) {
        var id = link.id;
        localStorage.setItem('clickedLinkId', id);
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/customer/new_user.blade.php ENDPATH**/ ?>