
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Campaign')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Campaign')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Campaign')); ?></li>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo e(Form::open(array('route' => 'customer.sendmail','method' =>'post'))); ?>

<div class="main-div">
    <div class="row mt-3">
        <div class="col-sm-10">
            <!-- <div class="form-group" > -->
            <select class="form-select" name="template">
                <option selected disabled>Select Template</option>
                <?php $__currentLoopData = $emailtemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($template->id); ?>"><?php echo e($template->subject); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-sm-2">
            <input type="submit" class="btn btn-primary" value="Send Email">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table id="datatable" class="table align-items-center datatable">

                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th scope="col" class="sort" data-sort="username"><?php echo e(__('Customer Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="email"><?php echo e(__('Email')); ?></th>
                                    <th scope="col" class="sort" data-sort="phone"><?php echo e(__('Phone')); ?></th>
                                    <th scope="col" class="sort" data-sort="address"><?php echo e(__('Address')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="checkall" id="checkall" class="form-check-input">
                                    </td>
                                </tr>
                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input align-middle ischeck" value="<?php echo e($customer->email); ?>" name="customer[]">
                                    </td>
                                    <td>
                                        <span class="budget"><b><?php echo e(ucfirst($customer->name)); ?></b></span>
                                    </td>
                                    <td>
                                        <span class="budget"><?php echo e($customer->email); ?></span>
                                    </td>
                                    <td>.
                                        <span class="budget"><?php echo e($customer->phone); ?></span>
                                    </td>
                                    <td>
                                        <span class="budget"><?php echo e($customer->lead_address); ?></span>
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
<?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<script>
    $(document).ready(function() {
        $("#checkall").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $(".ischeck").click(function() {
            var ischeck = $(this).data('id');
            $('.isscheck_' + ischeck).prop('checked', this.checked);
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/customer/index.blade.php ENDPATH**/ ?>