
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Emails')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Email Communication')); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('email.index')); ?>"><?php echo e(__('Emails')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Communication')); ?></li>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>

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
                                    <div id="email-conversations" style=" padding: 25px;">
                                        <?php $__currentLoopData = $emailCommunications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $communication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="conversation mb-3 border p-3 rounded" style="cursor: pointer;">
                                            <strong><?php echo e(ucfirst($communication->subject)); ?></strong>
                                            <span style="float:right;"><b>Sent at:</b>
                                                <?php echo e($communication->created_at->format('M d, Y H:i A')); ?>

                                            </span>
                                        </div>
                                        <div class="email-details" style="display: none;">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <p class="card-text"><strong>To:</strong>
                                                        <?php echo e($communication->email); ?></p>
                                                    <p class="card-text"><strong>Message:</strong>
                                                      <?php echo e($communication->content); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Get all conversation elements
var conversationThreads = document.querySelectorAll('.conversation');

// Attach click event listener to each conversation thread
conversationThreads.forEach(function(thread) {
    thread.addEventListener('click', function() {
        // Toggle visibility of the email details
        var emailDetails = this.nextElementSibling;
        emailDetails.style.display = (emailDetails.style.display === 'none') ? 'block' : 'none';
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/email_integration/conversation.blade.php ENDPATH**/ ?>