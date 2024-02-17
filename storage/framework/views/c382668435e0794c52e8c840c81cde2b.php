<div class="row">
    <div class="col-md-4">
        <h6>List</h6>
        <div class="form-group">
            <input type="text" name="search" id="search"class="form-control"placeholder ="Search By List a">
            <ul class="list-group">
                <?php $__currentLoopData = $leadsuser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item"><?php echo e(ucfirst($user->name)); ?><input type="checkbox" name="" value="<?php echo e($user->id); ?>" style="  float: right;"><span class="dash-arrow"><i data-feather="chevron-right"></i></span></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>    
    </div>
    <div class="col-md-4">
        <h6>Selected Users</h6>
        <div class="form-group">
            <input type="text" name="search" id="search"class="form-control">
            <!-- <ul class="list-group">
                <?php $__currentLoopData = $leadsuser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item"><?php echo e(ucfirst($user->name)); ?><input type="checkbox" name="" value="<?php echo e($user->id); ?>" style="    float: right;"></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul> -->
        </div>    
    </div>
</div><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/customer/existingleads.blade.php ENDPATH**/ ?>