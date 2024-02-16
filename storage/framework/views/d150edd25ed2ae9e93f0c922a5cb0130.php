
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('HTML Mail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('HTML mail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('HTML Mail')); ?></li>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://editor.unlayer.com/embed.css">
<script src="https://editor.unlayer.com/embed.js"></script>
<div class="container-field">
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
                    <a href="#useradd-1" class="list-group-item list-group-item-action">
                        <span class="fa-stack fa-lg pull-left"><i class="ti ti-mail"></i></span>
                        <span class="dash-mtext"><?php echo e(__('HTML Mail')); ?> </span></a>
                </div>
            </div>
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="editor" style="height: 500px;"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<script>
    $(document).ready(function() {
        var unlayer = $('#editor-container').unlayer({
            apiKey: '1JIEPtRKTHWUcY5uMLY4TWFs2JHUbYjAcZIyd6ubblfukgU6XfAQkceYXUzI1DpR',
        });
    });
    unlayer.init({
        appearance: {
            panels: {
            tools: {
                dock: 'left'
            }
            }
        },
        id: 'editor',
        projectId: 119381,
    })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/customer/editor.blade.php ENDPATH**/ ?>