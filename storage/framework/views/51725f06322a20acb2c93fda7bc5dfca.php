<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <h4 class="m-b-10"><?php echo e(__('Contracts')); ?></h4>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Contracts')); ?></li>
<li class="breadcrumb-item"><?php echo e(__('New Contract')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://pd-js-sdk.s3.amazonaws.com/0.2.20/pandadoc-js-sdk.min.js"></script>
    <link rel="stylesheet" href="https://pd-js-sdk.s3.amazonaws.com/0.2.20/pandadoc-js-sdk.css" />
    <style>
    .pandadoc iframe {
        width: 100%;
        height: 480px;
    }
    </style>
</head>

<body>

    <div id="pandadoc-sdk" class="pandadoc"></div>
    <!-- <script>
 var doclist = new PandaDoc.DocList({mode: PandaDoc.DOC_LIST_MODE.LIST});
doclist.init({
    el: '#pandadoc-sdk',
    data: {
        metadata: {
            YOUR_META_KEY: 'YOUR_META_VALUE'
        }
    },
    cssClass: 'style-me',
    events: {
        onInit: function(){},
        onDocumentCreate: function(){}
    }
});
    </script> -->

    <script>
    var editor = new PandaDoc.DocEditor();
    editor.show({
        el: '#pandadoc-sdk',
        data: {
            metadata: {
                abc: 'asasdad'
            }
        },
        cssClass: 'style-me',
        events: {
            onInit: function() {},
            onDocumentCreated: function() {},
            onDocumentSent: function() {},
            onClose: function() {}
        }
    });
    </script>
</body>

</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmcentraverse/public_html/resources/views/pandadoc.blade.php ENDPATH**/ ?>