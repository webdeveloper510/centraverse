

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Email Templates')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Email Templates')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Email Templates')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('js/plugins/tinymce/tinymce.min.js')); ?>"></script>
    <script>
        if ($(".pc-tinymce-2").length) {
            tinymce.init({
                selector: '.pc-tinymce-2',
                height: "400",
                content_style: 'body { font-family: "Inter", sans-serif; }'
            });
        }

        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
            });
        });

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">

        <div class="col-12">
            <div class="row">

            </div>
            <div class="card">
                <div class="card-body">

                    <div class="language-wrap">
                        <div class="row">
                            <div class="col-lg-12 col-md-9 col-sm-12 language-form-wrap">
                                <?php echo e(Form::model($currEmailTempLang, ['route' => ['email_template.update', $currEmailTempLang->parent_id], 'method' => 'PUT'])); ?>

                                <div class="row">
                                    <div class="form-group col-12">
                                        <?php echo e(Form::label('subject', __('Subject'), ['class' => 'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('subject', null, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('name', __('Name'), ['class' => 'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('name', $emailTemplate->name, ['class' => 'form-control font-style', 'disabled' => 'disabled'])); ?>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('from', __('From'), ['class' => 'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::text('from', $emailTemplate->from, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

                                    </div>
                                    <div class="form-group col-12">
                                        <?php echo e(Form::label('content', __('Email Message'), ['class' => 'form-control-label text-dark'])); ?>

                                        <?php echo e(Form::textarea('content', $currEmailTempLang->content, ['class' => 'summernote', 'required' => 'required'])); ?>


                                    </div>


                                    <div class="col-md-12 text-end">
                                        <?php echo e(Form::hidden('lang', null)); ?>

                                        <input type="submit" value="<?php echo e(__('Save')); ?>"
                                            class="btn btn-print-invoice  btn-primary">
                                    </div>

                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/email_templates/template.blade.php ENDPATH**/ ?>