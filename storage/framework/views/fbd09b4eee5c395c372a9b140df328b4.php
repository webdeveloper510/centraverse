<?php 
$settings = App\Models\Utility::settings();
$campaign_type = explode(',',$settings['campaign_type'])
?>
<?php echo e(Form::open(array('route'=>['importuser'],'method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="row">
    <div class="col-md-6">
    <div class="form-group">
        <label for="category">Select Category</label>
        <select name="category" id="category" class="form-control" required>
            <option selected disabled>Select Category</option>
            <?php $__currentLoopData = $campaign_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($campaign); ?>" class="form-control"><?php echo e($campaign); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group">
        <label for="users">Upload File</label>
        <input type="file" name="users" id="users" class="form-control"required>
    </div>
    <input type="submit" value="Submit" class="btn btn-primary">
    </div>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/customer/uploaduserinfo.blade.php ENDPATH**/ ?>