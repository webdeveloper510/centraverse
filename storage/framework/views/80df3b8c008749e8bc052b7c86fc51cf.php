<?php
$plansettings = App\Models\Utility::plansettings();
$users= App\Models\MasterCustomer::all();

?>
<?php echo e(Form::open(['route' => 'contracts.store', 'method' => 'post', 'enctype' => 'multipart/form-data','id'=>'formdata'] )); ?>



<div class="row">

    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Contract Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('subject', __('Subject'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('subject', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('client_name', __('Staff Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('client_name', $client,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
    </div>
    <!-- <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('client_name', __('Recipients'),['class'=>'form-label'])); ?>

            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="user[]" value="<?php echo e($user->id); ?>"
                    id="user_<?php echo e($user->id); ?>">
                <label class="form-check-label" for="user_<?php echo e($user->id); ?>">
                    <?php echo e($user->name); ?>

                </label>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           
        </div>
    </div> -->

    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('atttachment',__('Upload File'),['class'=>'form-label'])); ?>

            <input type="file" name="atttachment" id="atttachment" class="form-control">

        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <button type="submit" class="btn  btn-primary"><?php echo e(__('Create')); ?></button>

</div>
<?php echo e(Form::close()); ?>



<script>
document.querySelector("#pc-daterangepicker-2").flatpickr({
    mode: "range"
});
</script><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/contract/create.blade.php ENDPATH**/ ?>