<?php echo e(Form::open(array('route'=>['importuser'],'method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="row">
    <div class="col-md-12">
    <div class="form-group">
        <label for="users">Upload File</label>
    <input type="file" name="users" id="users" class="form-control">
    </div>
    <input type="submit" value="Submit" class="btn btn-primary">
    </div>
</div>
<?php echo e(Form::close()); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/customer/uploaduserinfo.blade.php ENDPATH**/ ?>