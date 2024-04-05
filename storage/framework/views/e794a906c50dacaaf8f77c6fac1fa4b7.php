<div class="row">
    <div class="col-md-12">
        <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- Assuming $folder and $filename are passed to the view -->
        <?php if(Storage::disk('public')->exists($doc->filepath)): ?>
        <?php if(pathinfo($doc->filepath, PATHINFO_EXTENSION) == 'pdf'): ?>
        <img src="<?php echo e(asset('extension_img/pdf.png')); ?>" style="    width: 10%;
    height: auto;">
        <?php else: ?>
        <img src="<?php echo e(asset('extension_img/doc.png')); ?>" style="     width: 10%;
    height: auto;">
        <?php endif; ?>
        <h6><?php echo e($doc->filename); ?></h6>
        <p><a href="<?php echo e(Storage::url('app/public/'.$doc->filepath)); ?>" download>Download File</a></p>

        <?php endif; ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div><?php /**PATH /home/crmcentraverse/public_html/resources/views/lead/viewdocument.blade.php ENDPATH**/ ?>