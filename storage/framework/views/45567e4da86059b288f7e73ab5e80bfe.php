

<?php $__env->startSection('title', __('Not Found')); ?>
<?php $__env->startSection('code', '404'); ?>
<?php $__env->startSection('message',__($exception->getMessage() ?: 'Not Found')); ?>

<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\0Work\xampp\htdocs\laravel\centraverse\resources\views/errors/404.blade.php ENDPATH**/ ?>