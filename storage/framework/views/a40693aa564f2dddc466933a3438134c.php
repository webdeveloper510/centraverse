<?php $__env->startSection('page-title'); ?>
<?php echo e(__('External Customers')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('External Customers')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('External Customers')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">

        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12 order-lg-1">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Name')); ?> </small>
                                    </div>
                                    <div class="col-md-5">
                                        <span class=""><?php echo e($users->name); ?></span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Email')); ?></small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class=""><?php echo e($users->email); ?></span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Phone')); ?></small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class=""><?php echo e($users->phone); ?></span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Address')); ?></small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class=""><?php echo e($users->address); ?></span>
                                    </div>
                                    <div class="col-md-4  mt-1">
                                        <small class="h6  mb-3 mb-md-0"><?php echo e(__('Category')); ?></small>
                                    </div>
                                    <div class="col-md-5  mt-1">
                                        <span class=""><?php echo e($users->category); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Upload Documents</h3>
                                <form action="<?php echo e(route('upload-info',urlencode(encrypt($users->id)))); ?>" method="POST"  enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <label for="customerattachment">Attachment</label>
                                    <input type="file" name="customerattachment" id="customerattachment" class="form-control" required>
                                <input type="submit" value="Submit" class="btn btn-primary mt-2">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <h3>Attachments</h3>
                                <?php   
                                                                $files = Storage::files('app/public/External_customer/'.$users->id);

                                ?>
                                <?php if(isset($files) && !empty($files)): ?>
                                
                                <div class="col-md-12">
                                    <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div>
                                        <p><?php echo e(basename($file)); ?></p>
                                        <div>

                                            <?php if(pathinfo($file, PATHINFO_EXTENSION) === 'pdf'): ?>
                                            <img src="<?php echo e(asset('extension_img/pdf.png')); ?>" alt="File"
                                                style="max-width: 100px; max-height: 150px;">
                                            <?php else: ?>
                                            <img src="<?php echo e(asset('extension_img/doc.png')); ?>" alt="File"
                                                style="max-width: 100px; max-height: 150px;">
                                            <?php endif; ?>
                                            <a href="<?php echo e(Storage::url($file)); ?>" download style=" position: absolute;">
                                                <i class="fa fa-download"></i></a>

                                        </div>

                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<style>
.list-group-flush .list-group-item {
    background: none;
}
</style>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmcentraverse/public_html/resources/views/customer/userview.blade.php ENDPATH**/ ?>