<?php
    $settings = \App\Models\Utility::settings();

    $color = !empty($settings['color']) ? $settings['color'] : 'theme-3';
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $company_favicon = Utility::getValByName('company_favicon');

    $footer_text = isset($settings['footer_text']) ? $settings['footer_text'] : '';
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Salesy Saas- Business Sales CRM">
    <meta name="author" content="Rajodiya Infotech">
    <title>
        <?php echo e(Utility::getValByName('title_text') ? Utility::getValByName('title_text') : config('app.name', 'Salesy SaaS')); ?>

        - <?php echo $__env->yieldContent('page-title'); ?></title>

    <!-- Primary Meta Tags -->

    <meta name="title" content="<?php echo e($settings['meta_keywords']); ?>">
    <meta name="description" content="<?php echo e($settings['meta_description']); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e($settings['meta_keywords']); ?>">
    <meta property="og:description" content="<?php echo e($settings['meta_description']); ?>">
    <meta property="og:image" content="<?php echo e(asset('public/uploads/metaevent/' . $settings['meta_image'])); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e($settings['meta_keywords']); ?>">
    <meta property="twitter:description" content="<?php echo e($settings['meta_description']); ?>">
    <meta property="twitter:image" content="<?php echo e(asset('public/uploads/metaevent/' . $settings['meta_image'])); ?>">


    

    <link rel="icon"
        href="<?php echo e($logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png')); ?>"
        type="image/png" sizes="16x16">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/plugins/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/plugins/main.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/fonts/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/fonts/material.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/plugins/bootstrap-switch-button.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/plugins/dragula.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/plugins/style.css')); ?>">

    <!-- Dragulla -->
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/plugins/dragula.min.css')); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
    <!-- vendor css -->
    <?php if($settings['SITE_RTL'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/style-rtl.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('public/css/custom-rtl.css')); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/style.css')); ?>" id="main-style-link">
    <?php endif; ?>
    <?php if(isset($settings['cust_darklayout']) && $settings['cust_darklayout'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/style-dark.css')); ?>" id="main-style-link">
    <?php endif; ?>


    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/plugins/flatpickr.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/plugins/dropzone.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/libs/select2/dist/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/css/customizer.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('public/css/custom.css')); ?>">

    <?php if(isset($settings['cust_darklayout']) && $settings['cust_darklayout'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('public/css/custom-dark.css')); ?>">
    <?php endif; ?>

    <?php if(Auth::user()): ?>
        <meta name="url" content="<?php echo e(url('') . '/' . config('chatify.routes.prefix')); ?>"
            data-user="<?php echo e(Auth::user()->id); ?>">
    <?php endif; ?>


    
    <script src="<?php echo e(asset('public/js/chatify/autosize.js')); ?>"></script>
    
    <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

    
    <link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css' />
    <?php echo $__env->yieldPushContent('css-page'); ?>
    <style>
    #loader img {
        width: 120px;
    }
    #loader {
        display: block;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 35%;
        left: 40%;
        transform: translate(50px, 50px);
        z-index: 99999;
    }
    /* body.loading{
        overflow: hidden;   
    }
    body.loading .overlay{
        display: block;
    } */
</style>
</head>
<?php /**PATH /home/crmcentraverse/public_html/centraglobe/main-file/resources/views/partials/admin/head.blade.php ENDPATH**/ ?>