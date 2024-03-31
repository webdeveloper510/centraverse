<?php
$files = Storage::files('app/public/UserInfo/'.$user->id);
?>

<div class="row">
    <div class="col-md-12">
        <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <!-- Display file name -->
                <p><?php echo e(basename($file)); ?></p>
                <div>

                <!-- Display preview if it's a PDF -->
                <?php if(pathinfo($file, PATHINFO_EXTENSION) === 'pdf'): ?>
                    <iframe src="<?php echo e(Storage::url($file)); ?>" width="50%" height="300px"></iframe>
                <?php else: ?>
                <img src="<?php echo e(asset('extension_img/images.png')); ?>" alt="File" style="max-width: 100px; max-height: 150px;">
                    <!-- Placeholder icon for non-PDF files -->
                    <a href="<?php echo e(Storage::url($file)); ?>" download style=" position: absolute;"> <i class="fa fa-download"></i></a>

                <?php endif; ?>
                <form action="<?php echo e(route('user.docs.delete', ['id' => $user->id, 'filename' => basename($file)])); ?>" method="POST" style="display: inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" style="background: none; border: none; color: red; cursor: pointer;"><i class="fa fa-trash"></i></button>
                    </form>
                <!-- Download link -->
                </div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\centraverse\resources\views/user/view_doc.blade.php ENDPATH**/ ?>