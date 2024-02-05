
<?php
$settings = App\Models\Utility::settings();

// $logo = asset(Storage::url('uploads/logo/'));
$logo = \App\Models\Utility::get_file('uploads/logo/');
$color = isset($settings['color']) ? $settings['color'] : 'theme-4';
// $company_logo = \App\Models\Utility::getValByName('company_logo');
// $company_small_logo = \App\Models\Utility::getValByName('company_small_logo');
$company_favicon = \App\Models\Utility::getValByName('company_favicon');
$dark_logo = Utility::getValByName('company_logo_dark');
$light_logo = Utility::getValByName('company_logo_light');
$company_logo = \App\Models\Utility::GetLogo();
$lang = \App\Models\Utility::getValByName('default_language');
$EmailTemplates = App\Models\EmailTemplate::all();
$venue = explode(',',$settings['venue']);
$function = explode(',',$settings['function']);
$file_type = config('files_types');

$local_storage_validation = $settings['local_storage_validation'];
$local_storage_validations = explode(',', $local_storage_validation);

$s3_storage_validation = $settings['s3_storage_validation'];
$s3_storage_validations = explode(',', $s3_storage_validation);

$wasabi_storage_validation = $settings['wasabi_storage_validation'];
$wasabi_storage_validations = explode(',', $wasabi_storage_validation);

$SITE_RTL = env('SITE_RTL');
if ($SITE_RTL == '') {
$SITE_RTL == 'off';
}
if(isset($settings['event_type']) && !empty($settings['event_type'])){
$eventtypes = explode(',',$settings['event_type']);
}
if(isset($settings['venue']) && !empty($settings['venue'])){
$venue = explode(',',$settings['venue']);
}
$meta_image = \App\Models\Utility::get_file('uploads/metaevent/');
$imagePath = public_path('upload/signature/autorised_signature.png');
$imageData = base64_encode(file_get_contents($imagePath));
$base64Image = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;
?>

<?php $__env->startPush('css-page'); ?>
<?php if($color == 'theme-1'): ?>
<style>
    .btn-check:checked+.btn-outline-success,
    .btn-check:active+.btn-outline-success,
    .btn-outline-success:active,
    .btn-outline-success.active,
    .btn-outline-success.dropdown-toggle.show {
        color: #ffffff;
        background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459d !important;
        border-color: #51459d !important;

    }

    .btn-outline-success:hover {
        color: #ffffff;
        background: linear-gradient(141.55deg, rgba(81, 69, 157, 0) 3.46%, rgba(255, 58, 110, 0.6) 99.86%), #51459d !important;
        border-color: #51459d !important;
    }

    .btn.btn-outline-success {
        color: #51459d;
        border-color: #51459d !important;
    }
</style>
<?php endif; ?>
<?php if($color == 'theme-2'): ?>
<style>
    .btn-check:checked+.btn-outline-success,
    .btn-check:active+.btn-outline-success,
    .btn-outline-success:active,
    .btn-outline-success.active,
    .btn-outline-success.dropdown-toggle.show {
        color: #ffffff;
        background: linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #4ebbd3 99.86%)#1f3996 !important;
        border-color: #1F3996 !important;

    }

    .btn-outline-success:hover {
        color: #ffffff;
        background: linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #4ebbd3 99.86%)#1f3996 !important;
        border-color: #1F3996 !important;
    }

    .btn.btn-outline-success {
        color: #1F3996;
        border-color: #1F3996 !important;
    }
</style>
<?php endif; ?>

<?php if($color == 'theme-4'): ?>
<style>
    .btn-check:checked+.btn-outline-success,
    .btn-check:active+.btn-outline-success,
    .btn-outline-success:active,
    .btn-outline-success.active,
    .btn-outline-success.dropdown-toggle.show {
        color: #ffffff;
        background-color: #584ed2 !important;
        border-color: #584ed2 !important;

    }

    .btn-outline-success:hover {
        color: #ffffff;
        background-color: #584ed2 !important;
        border-color: #584ed2 !important;
    }

    .btn.btn-outline-success {
        color: #584ed2;
        border-color: #584ed2 !important;
    }
</style>
<?php endif; ?>

<?php if($color == 'theme-3'): ?>
<style>
    .btn-check:checked+.btn-outline-success,
    .btn-check:active+.btn-outline-success,
    .btn-outline-success:active,
    .btn-outline-success.active,
    .btn-outline-success.dropdown-toggle.show {
        color: #ffffff;
        background-color: #6fd943 !important;
        border-color: #6fd943 !important;

    }

    .btn-outline-success:hover {
        color: #ffffff;
        background-color: #6fd943 !important;
        border-color: #6fd943 !important;
    }

    .btn.btn-outline-success {
        color: #6fd943;
        border-color: #6fd943 !important;
    }
</style>
<?php endif; ?>
<style>
    input[type="radio"] {
        display: none;
    }

    .floorimages {
        height: 160px;
        width: 200px;
        margin: 26px;
    }

    canvas#signatureCanvas {
        border: 1px solid black;
        width: 100%;
        height: 167px;
        border-radius: 8px;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script type="text/javascript">
    // $(document).on("click", ".email-template-checkbox", function() {
    //     var chbox = $(this);
    //     $.ajax({
    //         url: chbox.attr('data-url'),
    //         data: {
    //             _token: $('meta[name="csrf-token"]').attr('content'),
    //             status: chbox.val()
    //         },
    //         type: 'post',
    //         success: function(response) {
    //             if (response.is_success) {
    //                 toastr('Success', response.success, 'success');
    //                 if (chbox.val() == 1) {
    //                     $('#' + chbox.attr('id')).val(0);
    //                 } else {
    //                     $('#' + chbox.attr('id')).val(1);
    //                 }
    //             } else {
    //                 toastr('Error', response.error, 'error');
    //             }
    //         },
    //         error: function(response) {
    //             response = response.responseJSON;
    //             if (response.is_success) {
    //                 toastr('Error', response.error, 'error');
    //             } else {
    //                 toastr('Error', response, 'error');
    //             }
    //         }
    //     })
    // });
</script>
<script>
    function check_theme(color_val) {
        $('#theme_color').prop('checked', false);
        $('input[value="' + color_val + '"]').prop('checked', true);
    }
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })
</script>
<script>
    $(document).ready(function() {
        $('.list-group-item').on('click', function() {
            var href = $(this).attr('data-href');
            $('.tabs-card').addClass('d-none');
            $(href).removeClass('d-none');
            $('#tabs .list-group-item').removeClass('text-primary');
            // $(this).addClass('text-primary');
        });
    });

    function check_theme(color_val) {
        $('#theme_color').prop('checked', false);
        $('input[value="' + color_val + '"]').prop('checked', true);
    }
</script>
<script>
    $(document).on("change", "select[name='quote_template'], input[name='quote_color']", function() {
        var template = $("select[name='quote_template']").val();
        var color = $("input[name='quote_color']:checked").val();
        $('#quote_frame').attr('src', '<?php echo e(url("/quote/preview")); ?>' + template + '/' + color);
    });
    $(document).on("change", "select[name='invoice_template'], input[name='invoice_color']", function() {
        var template = $("select[name='invoice_template']").val();
        var color = $("input[name='invoice_color']:checked").val();
        $('#invoice_frame').attr('src', '<?php echo e(url("/invoice/preview")); ?>' + template + '/' + color);
    });
    $(document).on("change", "select[name='salesorder_template'], input[name='salesorder_color']", function() {
        var template = $("select[name='salesorder_template']").val();
        var color = $("input[name='salesorder_color']:checked").val();
        $('#salesorder_frame').attr('src', '<?php echo e(url("/salesorder/preview")); ?>' + template + '/' + color);
    });
</script>

<script>
    $(document).on("click", '.send_email', function(e) {
        e.preventDefault();
        var title = $(this).attr('data-title');

        var size = 'md';
        var url = $(this).attr('data-url');
        if (typeof url != 'undefined') {
            $("#commonModal .modal-title").html(title);
            $("#commonModal .modal-dialog").addClass('modal-' + size);
            $("#commonModal").modal('show');

            $.post(url, {
                _token: '<?php echo e(csrf_token()); ?>',
                mail_driver: $("#mail_driver").val(),
                mail_host: $("#mail_host").val(),
                mail_port: $("#mail_port").val(),
                mail_username: $("#mail_username").val(),
                mail_password: $("#mail_password").val(),
                mail_encryption: $("#mail_encryption").val(),
                mail_from_address: $("#mail_from_address").val(),
                mail_from_name: $("#mail_from_name").val(),

            }, function(data) {
                $('#commonModal .modal-body').html(data);
            });
        }
    });


    $(document).on('submit', '#test_email', function(e) {

        e.preventDefault();
        $("#email_sending").show();
        var post = $(this).serialize();
        var url = $(this).attr('action');
        $.ajax({
            type: "post",
            url: url,
            data: post,
            cache: false,

            success: function(data) {


                if (data.is_success) {
                    show_toastr('Success', data.message, 'success');
                } else {
                    show_toastr('Error', data.message, 'error');
                }
                $("#email_sending").hide();
                $('#commonModal').modal('hide');
            },
            complete: function() {
                $('#test_email .btn-create').removeAttr('disabled');
            },
        });
    });
</script>

<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300,
    })
    $(".list-group-item").click(function() {
        $('.list-group-item').filter(function() {
            return this.href == id;
        }).parent().removeClass('text-primary');
    });

    function check_theme(color_val) {
        $('#theme_color').prop('checked', false);
        $('input[value="' + color_val + '"]').prop('checked', true);
    }

    $(document).on('change', '[name=storage_setting]', function() {
        if ($(this).val() == 's3') {
            $('.s3-setting').removeClass('d-none');
            $('.wasabi-setting').addClass('d-none');
            $('.local-setting').addClass('d-none');
        } else if ($(this).val() == 'wasabi') {
            $('.s3-setting').addClass('d-none');
            $('.wasabi-setting').removeClass('d-none');
            $('.local-setting').addClass('d-none');
        } else {
            $('.s3-setting').addClass('d-none');
            $('.wasabi-setting').addClass('d-none');
            $('.local-setting').removeClass('d-none');
        }
    });
</script>
<script type="text/javascript">
    function enablecookie() {
        const element = $('#enable_cookie').is(':checked');
        $('.cookieDiv').addClass('disabledCookie');
        if (element == true) {
            $('.cookieDiv').removeClass('disabledCookie');
            $("#cookie_logging").attr('checked', true);
        } else {
            $('.cookieDiv').addClass('disabledCookie');
            $("#cookie_logging").attr('checked', false);
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Settings')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
        <div class="row">
            <div class="col-xl-3">
                <div class="card sticky-top" style="top:30px">
                    <div class="list-group list-group-flush" id="useradd-sidenav">

                        <!-- <?php if(\Auth::user()->type == 'super admin'): ?>
                                <a href="#brand-settings"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Brand Settings')); ?> <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <?php endif; ?>
                            <?php if(\Auth::user()->type == 'super admin'): ?>
                                <a href="#email-settings"
                                    class="list-group-item list-group-item-action dash-link border-0"><?php echo e(__('Email Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>
                            <?php if(\Auth::user()->type == 'super admin'): ?>
                                <a href="#pusher-settings"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Pusher Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>-->

                            <!-- <?php if(\Auth::user()->type == 'owner'): ?>
                                <a href="#site-settings"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Site Settings')); ?> <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <?php endif; ?>  -->
                        
                            <!-- <?php if(\Auth::user()->type == 'owner'): ?>
                                <a href="#company-settings"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Company Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?> -->

                        <?php if(\Auth::user()->type == 'owner'): ?>
                        <a href="#company-email-setting" class="list-group-item list-group-item-action border-0"><?php echo e(__('Email Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <?php endif; ?> 
                        <!-- <?php if(\Auth::user()->type == 'owner'): ?>
                                <a href="#system-settings"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('System Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>

                            <?php if(\Auth::user()->type == 'owner'): ?>
                                <a href="#quote-settings"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Quote Settings')); ?> <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <?php endif; ?>

                            <?php if(\Auth::user()->type == 'owner'): ?>
                                <a href="#invoice-settings"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Invoice Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>

                            <?php if(\Auth::user()->type == 'owner'): ?>
                                <a href="#sales-order-settings"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Sales Order Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?> -->

                        <!-- <?php if(\Auth::user()->type == 'owner' || \Auth::user()->type == 'super admin'): ?>
                                <a href="#payment-settings"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Payment Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                        <?php endif; ?> -->

                        <?php if(\Auth::user()->type == 'owner'): ?>
                        <a href="#twilio-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Twilio Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <?php endif; ?>

                        <?php if(\Auth::user()->type == 'super admin'): ?>
                        <a href="#recaptcha-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Recaptcha Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <?php endif; ?>

                        <!-- <?php if(\Auth::user()->type == 'owner'): ?>
                                <a href="#email-notification-settings"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Email Notification Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                        <?php endif; ?> -->
                        <?php if(\Auth::user()->type == 'owner'): ?>
                        <a href="#user-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Staff Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <a href="#role-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Role Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>

                        <a href="#eventtype-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Event-Type Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>

                        <a href="#venue-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Venue Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <a href="#function-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Function Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <a href="#floor-plan-setting" class="list-group-item list-group-item-action border-0"><?php echo e(__('Floor Plan Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <a href="#billing-setting" class="list-group-item list-group-item-action border-0"><?php echo e(__('Billing Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <a href="#buffer-settings" class="list-group-item list-group-item-action border-0"><?php echo e(__('Buffer Settings')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <a href="#add-signature" class="list-group-item list-group-item-action border-0"><?php echo e(__('Add Authorised Signature')); ?>

                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <?php endif; ?>
                        <!-- <?php if(\Auth::user()->type == 'super admin'): ?>
                                <a href="#storage-settings"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Storage Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>
                            <?php if(\Auth::user()->type == 'owner'): ?>
                                <a href="#google-calender"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Google Calendar Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>
                            <?php if(\Auth::user()->type == 'owner'): ?>
                                <a href="#webhook-settings"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Webhook Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>
                            <?php if(\Auth::user()->type == 'super admin'): ?>
                                <a href="#SEO"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('SEO Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>
                            <?php if(\Auth::user()->type == 'super admin'): ?>
                                <a href="#cache"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Cache Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?>
                            <?php if(\Auth::user()->type == 'super admin'): ?>
                                <a href="#cookie"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Cookie Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?> -->
                        <!-- <?php if(\Auth::user()->type == 'super admin'): ?>
                                <a href="#pills-chatgpt-settings"
                                    class="list-group-item list-group-item-action border-0"><?php echo e(__('Chat GPT Key Settings')); ?>

                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            <?php endif; ?> -->
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <?php if(\Auth::user()->type == 'super admin'): ?>
                 <!-- <div id="brand-settings" class="card">
                    <div class="card-header">
                        <h5><?php echo e(__('Brand Settings')); ?></h5>
                        <small class="text-muted"><?php echo e(__('Edit your brand details')); ?></small>
                    </div>
                    <?php echo e(Form::model($settings, ['route' => 'business.setting', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="small-title"><?php echo e(__('Dark Logo')); ?></h5>
                                    </div>
                                    <div class="card-body setting-card setting-logo-box p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="logo-content logo-set-bg py-2" style="height:65px">
                                                    
                                                    <a href="<?php echo e($logo . 'logo-dark.png' . '?' . time()); ?>"
                                                        target="_blank" style="height: 50px; width:150px;">
                                                        <img id="blah4" alt="your image"
                                                            src="<?php echo e($logo . 'logo-dark.png' . '?' . time()); ?>"
                                                            style="height: 50px; width:150px;" class="big-logo">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-12">

                                                <div class="choose-files mt-5">
                                                    <label for="logo_dark">
                                                        <div class=" bg-primary"> <i
                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                        </div>
                                                        <input type="file"name="logo_dark" id="logo_dark"
                                                            class="form-control file"
                                                            data-filename="company_logo_update"
                                                            onchange="document.getElementById('blah4').src = window.URL.createObjectURL(this.files[0])">

                                                        
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="small-title"><?php echo e(__('Light Logo')); ?></h5>
                                    </div>
                                    <div class="card-body setting-card setting-logo-box p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="logo-content logo-set-bg py-2" style="height:65px">
                                                    
                                                    <a href="<?php echo e($logo . 'logo-light.png' . '?' . time()); ?>"
                                                        target="_blank" style="height: 50px; width:150px;">
                                                        <img id="blah5" alt="your image"
                                                            src="<?php echo e($logo . 'logo-light.png' . '?' . time()); ?>"
                                                            style="height: 50px; width:150px;" class="img_setting">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-12">

                                                <div class="choose-files mt-5">
                                                    <label for="logo_light">
                                                        <div class=" bg-primary"> <i
                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                        </div>
                                                        <input type="file"name="logo_light" id="logo_light"
                                                            class="form-control file"
                                                            data-filename="company_logo_update"
                                                            onchange="document.getElementById('blah5').src = window.URL.createObjectURL(this.files[0])">

                                                        
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="small-title"><?php echo e(__('Favicon')); ?></h5>
                                    </div>
                                    <div class="card-body setting-card setting-logo-box p-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="logo-content logo-set-bg py-2" style="height:65px">
                                                    
                                                    <a href="<?php echo e($logo . 'favicon.png' . '?' . time()); ?>"
                                                        target="_blank">
                                                        <img id="blah6" alt="your image"
                                                            src="<?php echo e($logo . 'favicon.png' . '?' . time()); ?>"
                                                            width="50px" class="img_setting">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="choose-files mt-5">
                                                    <label for="favicon">
                                                        <div class=" bg-primary"> <i
                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                        </div>
                                                        <input type="file"name="favicon" id="favicon"
                                                            class="form-control file"
                                                            data-filename="company_logo_update"
                                                            onchange="document.getElementById('blah6').src = window.URL.createObjectURL(this.files[0])">
                                                        
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('title_text', __('Title Text'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('title_text', null, ['class' => 'form-control', 'placeholder' => __('Title Text')])); ?>

                                    <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-title_text" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <?php if(\Auth::user()->type == 'super admin'): ?>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('footer_text', __('Footer Text'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('footer_text', null, ['class' => 'form-control', 'placeholder' => __('Footer Text')])); ?>

                                        <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-footer_text" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('default_language', __('Default Language'), ['class' => 'form-label'])); ?>

                                        <div class="changeLanguage">
                                            <select name="default_language" id="default_language"
                                                class="form-control custom-select">
                                                <?php $__currentLoopData = \App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($lang == $code): ?> selected <?php endif; ?>
                                                        value="<?php echo e($code); ?>"><?php echo e(ucfirst($language)); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="col switch-width">
                                            <div class="form-group ml-2 mr-3">
                                                <label
                                                    class="form-label mb-1"><?php echo e(__('Enable Landing Page')); ?></label>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-toggle="switchbutton"
                                                        data-onstyle="primary" class=""
                                                        name="display_landing_page" id="display_landing_page"
                                                        <?php echo e($settings['display_landing_page'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label mb-1"
                                                        for="display_landing_page"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="col switch-width">
                                            <div class="form-group ml-2 mr-3 ">

                                                <?php echo e(Form::label('verified_button', __('Email Verification'), ['class' => 'form-label'])); ?>

                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-toggle="switchbutton"
                                                        data-onstyle="primary" class=""
                                                        name="verified_button" id="verified_button"
                                                        <?php echo e(Utility::getValByName('verified_button') == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label"
                                                        for="verified_button"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="col switch-width">
                                            <div class="form-group ml-2 mr-3 ">
                                                <?php echo e(Form::label('SITE_RTL', __('Enable RTL'), ['class' => 'form-label'])); ?>

                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-toggle="switchbutton"
                                                        data-onstyle="primary" class="" name="SITE_RTL"
                                                        id="SITE_RTL"<?php echo e($settings['SITE_RTL'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label" for="SITE_RTL"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-4">
                                        <div class="col switch-width">
                                            <div class="form-group ml-2 mr-3 ">
                                                <?php echo e(Form::label('signup_button', __('Enable Sign-Up Page'), ['class' => 'form-label'])); ?>

                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" data-toggle="switchbutton"
                                                        data-onstyle="primary" class=""
                                                        name="signup_button" id="signup_button"
                                                        <?php echo e(Utility::getValByName('signup_button') == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label"
                                                        for="signup_button"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                                <h4 class="small-title"><?php echo e(__('Theme Customizer')); ?></h4>
                                <div class="setting-card setting-logo-box p-3">
                                    <div class="row">
                                        <div class="pct-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-xl-4 col-md-4">
                                                    <h6>
                                                        <i data-feather="credit-card"
                                                            class="me-2"></i><?php echo e(__('Primary color settings')); ?>

                                                    </h6>
                                                    <hr class="my-2" />
                                                    <div class="theme-color themes-color">
                                                        <a href="#!"
                                                            class="<?php echo e($settings['color'] == 'theme-1' ? 'active_color' : ''); ?>"
                                                            data-value="theme-1"
                                                            onclick="check_theme('theme-1')"></a>
                                                        <input type="radio" class="theme_color" name="color"
                                                            value="theme-1" style="display: none;">
                                                        <a href="#!"
                                                            class="<?php echo e($settings['color'] == 'theme-2' ? 'active_color' : ''); ?> "
                                                            data-value="theme-2"
                                                            onclick="check_theme('theme-2')"></a>
                                                        <input type="radio" class="theme_color" name="color"
                                                            value="theme-2" style="display: none;">
                                                        <a href="#!"
                                                            class="<?php echo e($settings['color'] == 'theme-3' ? 'active_color' : ''); ?>"
                                                            data-value="theme-3"
                                                            onclick="check_theme('theme-3')"></a>
                                                        <input type="radio" class="theme_color" name="color"
                                                            value="theme-3" style="display: none;">
                                                        <a href="#!"
                                                            class="<?php echo e($settings['color'] == 'theme-4' ? 'active_color' : ''); ?>"
                                                            data-value="theme-4"
                                                            onclick="check_theme('theme-4')"></a>
                                                        <input type="radio" class="theme_color" name="color"
                                                            value="theme-4" style="display: none;">
                                                        <a href="#!"
                                                            class="<?php echo e($settings['color'] == 'theme-5' ? 'active_color' : ''); ?>"
                                                            data-value="theme-5"
                                                            onclick="check_theme('theme-5')"></a>
                                                        <input type="radio" class="theme_color" name="color"
                                                            value="theme-5" style="display: none;">
                                                        <br>
                                                        <a href="#!"
                                                            class="<?php echo e($settings['color'] == 'theme-6' ? 'active_color' : ''); ?>"
                                                            data-value="theme-6"
                                                            onclick="check_theme('theme-6')"></a>
                                                        <input type="radio" class="theme_color" name="color"
                                                            value="theme-6" style="display: none;">
                                                        <a href="#!"
                                                            class="<?php echo e($settings['color'] == 'theme-7' ? 'active_color' : ''); ?>"
                                                            data-value="theme-7"
                                                            onclick="check_theme('theme-7')"></a>
                                                        <input type="radio" class="theme_color" name="color"
                                                            value="theme-7" style="display: none;">
                                                        <a href="#!"
                                                            class="<?php echo e($settings['color'] == 'theme-8' ? 'active_color' : ''); ?>"
                                                            data-value="theme-8"
                                                            onclick="check_theme('theme-8')"></a>
                                                        <input type="radio" class="theme_color" name="color"
                                                            value="theme-8" style="display: none;">
                                                        <a href="#!"
                                                            class="<?php echo e($settings['color'] == 'theme-9' ? 'active_color' : ''); ?>"
                                                            data-value="theme-9"
                                                            onclick="check_theme('theme-9')"></a>
                                                        <input type="radio" class="theme_color" name="color"
                                                            value="theme-9" style="display: none;">
                                                        <a href="#!"
                                                            class="<?php echo e($settings['color'] == 'theme-10' ? 'active_color' : ''); ?>"
                                                            data-value="theme-10"
                                                            onclick="check_theme('theme-10')"></a>
                                                        <input type="radio" class="theme_color" name="color"
                                                            value="theme-10" style="display: none;">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <h6>
                                                        <i data-feather="layout"
                                                            class="me-2"></i><?php echo e(__('Sidebar Settings')); ?>

                                                    </h6>
                                                    <hr class="my-2" />
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="cust-theme-bg" name="cust_theme_bg"
                                                            <?php echo e(Utility::getValByName('cust_theme_bg') == 'on' ? 'checked' : ''); ?> />
                                                        <label class="form-check-label f-w-600 pl-1"
                                                            for="cust-theme-bg"><?php echo e(__('Transparent layout')); ?></label>

                                                        
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <h6>
                                                        <i data-feather="sun"
                                                            class=""></i><?php echo e(__('Layout settings')); ?>

                                                    </h6>
                                                    <hr class=" my-2" />
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="cust-darklayout" name="cust_darklayout"
                                                            <?php echo e(Utility::getValByName('cust_darklayout') == 'on' ? 'checked' : ''); ?> />
                                                        <label class="form-check-label f-w-600 pl-1"
                                                            for="cust-darklayout"><?php echo e(__('Dark Layout')); ?></label>

                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn-submit btn btn-primary'])); ?>

                    </div>
                    <?php echo e(Form::close()); ?>

                </div>  -->

                <!-- <div id="email-settings" class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Email Settings')); ?></h5>
                                <small class="text-muted"><?php echo e(__('Edit your email details')); ?></small>
                            </div>
                            <?php echo e(Form::open(['route' => 'email.setting', 'method' => 'post'])); ?>

                            <div class="card-body">
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_driver"
                                                class="col-form-label text-dark"><?php echo e(__('Mail Driver')); ?></label>
                                            <input type="text" name="mail_driver" id="mail_driver"
                                                class="form-control <?php echo e($errors->has('mail_driver') ? 'is-invalid' : ''); ?>"
                                                value="<?php echo e(!isset($settings['mail_driver']) || is_null($settings['mail_driver']) ? '' : $settings['mail_driver']); ?>"
                                                placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_placeholder')); ?>" />
                                            <?php if($errors->has('mail_driver')): ?>
                                                <span class="invalid-feedback text-danger text-xs">
                                                    <?php echo e($errors->first('mail_driver')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_host"
                                                class="col-form-label text-dark"><?php echo e(__('Mail Host')); ?></label>
                                            <input type="text" name="mail_host" id="mail_host"
                                                class="form-control <?php echo e($errors->has('mail_host') ? 'is-invalid' : ''); ?>"
                                                value="<?php echo e(!isset($settings['mail_host']) || is_null($settings['mail_host']) ? '' : $settings['mail_host']); ?>"
                                                placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder')); ?>" />
                                            <?php if($errors->has('mail_host')): ?>
                                                <span class="invalid-feedback text-danger text-xs">
                                                    <?php echo e($errors->first('mail_host')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_port"
                                                class="col-form-label text-dark"><?php echo e(__('Mail Port')); ?></label>
                                            <input type="number" name="mail_port" id="mail_port"
                                                class="form-control <?php echo e($errors->has('mail_port') ? 'is-invalid' : ''); ?>"
                                                value="<?php echo e(!isset($settings['mail_port']) || is_null($settings['mail_port']) ? '' : $settings['mail_port']); ?>"
                                                placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_port_placeholder')); ?>" />
                                            <?php if($errors->has('mail_port')): ?>
                                                <span class="invalid-feedback text-danger text-xs">
                                                    <?php echo e($errors->first('mail_port')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_username"
                                                class="col-form-label text-dark"><?php echo e(__('Mail Username')); ?></label>
                                            <input type="text" name="mail_username" id="mail_username"
                                                class="form-control <?php echo e($errors->has('mail_username') ? 'is-invalid' : ''); ?>"
                                                value="<?php echo e(!isset($settings['mail_username']) || is_null($settings['mail_username']) ? '' : $settings['mail_username']); ?>"
                                                placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder')); ?>" />
                                            <?php if($errors->has('mail_username')): ?>
                                                <span class="invalid-feedback text-danger text-xs">
                                                    <?php echo e($errors->first('mail_username')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_password"
                                                class="col-form-label text-dark"><?php echo e(__('Mail Password')); ?></label>
                                            <input type="text" name="mail_password" id="mail_password"
                                                class="form-control <?php echo e($errors->has('mail_password') ? 'is-invalid' : ''); ?>"
                                                value="<?php echo e(!isset($settings['mail_password']) || is_null($settings['mail_password']) ? '' : $settings['mail_password']); ?>"
                                                placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder')); ?>" />
                                            <?php if($errors->has('mail_password')): ?>
                                                <span class="invalid-feedback text-danger text-xs">
                                                    <?php echo e($errors->first('mail_password')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_encryption"
                                                class="col-form-label text-dark"><?php echo e(__('Mail Encryption')); ?></label>
                                            <input type="text" name="mail_encryption" id="mail_encryption"
                                                class="form-control <?php echo e($errors->has('mail_encryption') ? 'is-invalid' : ''); ?>"
                                                value="<?php echo e(!isset($settings['mail_encryption']) || is_null($settings['mail_encryption']) ? '' : $settings['mail_encryption']); ?>"
                                                placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder')); ?>" />
                                            <?php if($errors->has('mail_encryption')): ?>
                                                <span class="invalid-feedback text-danger text-xs">
                                                    <?php echo e($errors->first('mail_encryption')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_from_address"
                                                class="col-form-label text-dark"><?php echo e(__('Mail From Address')); ?></label>
                                            <input type="text" name="mail_from_address" id="mail_from_address"
                                                class="form-control <?php echo e($errors->has('mail_from_address') ? 'is-invalid' : ''); ?>"
                                                value="<?php echo e(!isset($settings['mail_from_address']) || is_null($settings['mail_from_address']) ? '' : $settings['mail_from_address']); ?>"
                                                placeholder="<?php echo e(__('Enter Mail From Address')); ?>" />
                                            <?php if($errors->has('mail_from_address')): ?>
                                                <span class="invalid-feedback text-danger text-xs">
                                                    <?php echo e($errors->first('mail_from_address')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_from_name"
                                                class="col-form-label text-dark"><?php echo e(__('Mail From Name')); ?></label>
                                            <input type="text" name="mail_from_name" id="mail_from_name"
                                                class="form-control <?php echo e($errors->has('mail_from_name') ? 'is-invalid' : ''); ?>"
                                                value="<?php echo e(!isset($settings['mail_from_name']) || is_null($settings['mail_from_name']) ? '' : $settings['mail_from_name']); ?>"
                                                placeholder="<?php echo e(__('Enter Mail From Name')); ?>" />
                                            <?php if($errors->has('mail_from_name')): ?>
                                                <span class="invalid-feedback text-danger text-xs">
                                                    <?php echo e($errors->first('mail_from_name')); ?>

                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="footer-row justify-content-end felx-wrap d-flex">
                                        <a href="#"
                                            class="btn btn-print-invoice  btn-primary m-r-10 send_email mb-2"
                                            data-ajax-popup="true" data-title="<?php echo e(__('Send Test Mail')); ?>"
                                            data-url="<?php echo e(route('test.mail')); ?>">
                                            <?php echo e(__('Send Test Mail')); ?>

                                        </a>
                                        <input type="submit" value="<?php echo e(__('Save Changes')); ?>"
                                            class="btn btn-print-invoice  btn-primary m-r-10 mb-2">
                                    </div>
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div> -->

                <!-- <div id="pusher-settings" class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Pusher Settings')); ?></h5>
                                <small class="text-muted"><?php echo e(__('Edit your pusher details')); ?></small>
                            </div>
                            <div class="card-body">
                                <?php echo e(Form::model($settings, ['route' => 'pusher.setting', 'method' => 'post'])); ?>

                                <div class="row mt-3">
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('pusher_app_id', __('Pusher App Id *'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('pusher_app_id', isset($settings['pusher_app_id']) ? $settings['pusher_app_id'] : '', ['class' => 'form-control font-style', 'placeholder' => 'Pusher App Id', 'required' => 'required'])); ?>

                                        <?php $__errorArgs = ['pusher_app_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-pusher_app_id" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('pusher_app_key', __('Pusher App Key *'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('pusher_app_key', isset($settings['pusher_app_key']) ? $settings['pusher_app_key'] : '', ['class' => 'form-control font-style', 'placeholder' => 'Pusher App Key', 'required' => 'required'])); ?>

                                        <?php $__errorArgs = ['pusher_app_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-pusher_app_key" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('pusher_app_secret', __('Pusher App Secret *'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('pusher_app_secret', isset($settings['pusher_app_secret']) ? $settings['pusher_app_secret'] : '', ['class' => 'form-control font-style', 'placeholder' => 'Pusher App Key', 'required' => 'required'])); ?>

                                        <?php $__errorArgs = ['pusher_app_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-pusher_app_secret" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('pusher_app_cluster', __('Pusher App Cluster *'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('pusher_app_cluster', isset($settings['pusher_app_cluster']) ? $settings['pusher_app_cluster'] : '' , ['class' => 'form-control font-style', 'placeholder' => 'Pusher App Cluster', 'required' => 'required'])); ?>

                                        <?php $__errorArgs = ['pusher_app_cluster'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-pusher_app_cluster" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="text-end">
                                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn-submit btn btn-primary'])); ?>

                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div> -->

                <div id="payment-settings" class="card">
                    <div class="card-header">
                        <h5><?php echo e(__('Payment Settings')); ?></h5>
                        <small class="text-muted"><?php echo e(__('These details will be used to collect subscription plan payments.Each subscription plan will have a payment button based on the below configuration')); ?></small>
                    </div>
                    <?php echo e(Form::model($settings, ['route' => 'payment.setting', 'method' => 'POST'])); ?>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <label class="col-form-label"><?php echo e(__('Currency')); ?> *</label>
                                        <input type="text" name="currency" class="form-control" id="currency" value="<?php echo e(!isset($payment['currency']) || is_null($payment['currency']) ? '' : $payment['currency']); ?>" placeholder="USD" required>
                                        <small class="text-xs">
                                            <?php echo e(__('Note: Add currency code as per three-letter ISO code.')); ?>.
                                            <a href="https://stripe.com/docs/currencies" target="_blank"><?php echo e(__('You can find out how to do that here.')); ?></a>
                                        </small>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                                        <label for="currency_symbol" class="col-form-label"><?php echo e(__('Currency Symbol')); ?></label>
                                        <input type="text" name="currency_symbol" class="form-control" id="currency_symbol" value="<?php echo e(!isset($payment['currency_symbol']) || is_null($payment['currency_symbol']) ? '' : $payment['currency_symbol']); ?>" placeholder="$" required>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="faq justify-content-center">
                            <div class="col-sm-12 col-md-10 col-xxl-12">
                                <div class="accordion accordion-flush setting setting-accordion1" id="accordionExample">

                                    
                                    <div class="accordion-item card">
                                        <h2 class="accordion-header" id="heading-2-15">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
                                                <span class="d-flex align-items-center">
                                                    
                                                    <?php echo e(__('Manually')); ?>

                                                </span>
                                                <?php echo e(__('Enable:')); ?>

                                                <div class="form-check form-switch custom-switch-v1">
                                                    <input type="hidden" name="is_manually_enabled" value="off">
                                                    <input type="checkbox" class="form-check-input input-primary" name="is_manually_enabled" id="is_manually_enabled" <?php echo e(isset($payment['is_manually_enabled']) && $payment['is_manually_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-label" for="customswitchv1-1"></label>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse15" class="accordion-collapse collapse" aria-labelledby="heading-2-15" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                        <div class="row pt-2">
                                                            <label class="pb-2" for="is_manually_enabled"><?php echo e(__('Requesting manual payment for the planned amount for the subscriptions paln.')); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="accordion-item card">
                                        <h2 class="accordion-header" id="heading-2-16">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
                                                <span class="d-flex align-items-center">
                                                    
                                                    <?php echo e(__('Bank Transfer')); ?>

                                                </span>
                                                <?php echo e(__('Enable:')); ?>

                                                <div class="form-check form-switch custom-switch-v1">
                                                    <input type="hidden" name="is_bank_enabled" value="off">
                                                    <input type="checkbox" class="form-check-input input-primary" name="is_bank_enabled" id="is_bank_enabled" <?php echo e(isset($payment['is_bank_enabled']) && $payment['is_bank_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-label" for="customswitchv1-1"></label>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse16" class="accordion-collapse collapse" aria-labelledby="heading-2-16" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row gy-4">
                                                    <div class="col-md-12 mt-3">
                                                        <div class="form-group">
                                                            <?php echo e(Form::label('bank_details', __('Bank Details'), ['class' => 'col-form-label'])); ?>

                                                            <?php echo e(Form::textarea('bank_details', isset($payment['bank_details']) ? $payment['bank_details'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Your Bank Details'), 'rows' => 4])); ?>

                                                            <small class="text-xs">
                                                                <?php echo e(__('Example : Bank : bank name </br> Account Number : 0000 0000 </br>')); ?>

                                                            </small>
                                                            <?php if($errors->has('bank_details')): ?>
                                                            <span class="invalid-feedback d-block">
                                                                <?php echo e($errors->first('bank_details')); ?>

                                                            </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Stripe -->
                                    <div class="accordion-item card">
                                        <h2 class="accordion-header" id="heading-2-2">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                                <span class="d-flex align-items-center">
                                                    
                                                    <?php echo e(__('Stripe')); ?>

                                                </span>
                                                <?php echo e(__('Enable:')); ?>

                                                <div class="form-check form-switch custom-switch-v1">
                                                    <input type="hidden" name="is_stripe_enabled" value="off">
                                                    <input type="checkbox" class="form-check-input input-primary" name="is_stripe_enabled" id="is_stripe_enabled" <?php echo e(isset($payment['is_stripe_enabled']) && $payment['is_stripe_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-label" for="customswitchv1-1"></label>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading-2-2" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row gy-4">
                                                    <div class="col-md-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="stripe_key" class="form-label"><?php echo e(__('Stripe Key')); ?></label>
                                                            <input class="form-control" placeholder="<?php echo e(__('Stripe Key')); ?>" name="stripe_key" type="text" value="<?php echo e(!isset($payment['stripe_key']) || is_null($payment['stripe_key']) ? '' : $payment['stripe_key']); ?>" id="stripe_key">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="stripe_secret" class="form-label"><?php echo e(__('Stripe Secret')); ?></label>
                                                            <input class="form-control " placeholder="<?php echo e(__('Stripe Secret')); ?>" name="stripe_secret" type="text" value="<?php echo e(!isset($payment['stripe_secret']) || is_null($payment['stripe_secret']) ? '' : $payment['stripe_secret']); ?>" id="stripe_secret">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Paypal -->
                                    <div class="accordion-item card">
                                        <h2 class="accordion-header" id="heading-2-3">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                                <span class="d-flex align-items-center">
                                                    
                                                    <?php echo e(__('Paypal')); ?>

                                                </span>
                                                <?php echo e(__('Enable:')); ?>

                                                <div class="form-check form-switch custom-switch-v1">
                                                    <input type="hidden" name="is_paypal_enabled" value="off">
                                                    <input type="checkbox" class="form-check-input input-primary" id="customswitchv1-2" name="is_paypal_enabled" id="is_paypal_enabled" <?php echo e(isset($payment['is_paypal_enabled']) && $payment['is_paypal_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-label" for="customswitchv1-2"></label>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading-2-3" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                        <div class="row pt-2">
                                                            <label class="pb-2" for="paypal_mode"><?php echo e(__('Paypal Mode')); ?></label>
                                                            <div class="col-lg-3">
                                                                <div class="border card p-3">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input input-primary " name="paypal_mode" value="sandbox" <?php echo e(!isset($payment['paypal_mode']) || $payment['paypal_mode'] == '' || $payment['paypal_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="form-check-label d-block" for="">
                                                                            <span>
                                                                                <span class="h5 d-block"><strong class="float-end"></strong><?php echo e(__('Sandbox')); ?></span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="border card p-3">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input input-primary " name="paypal_mode" value="live" <?php echo e(isset($payment['paypal_mode']) && $payment['paypal_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="form-check-label d-block" for="">
                                                                            <span>
                                                                                <span class="h5 d-block"><strong class="float-end"></strong><?php echo e(__('Live')); ?></span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="paypal_client_id" class="form-label"><?php echo e(__('Client ID')); ?></label>
                                                            <input type="text" name="paypal_client_id" id="paypal_client_id" class="form-control" value="<?php echo e(!isset($payment['paypal_client_id']) || is_null($payment['paypal_client_id']) ? '' : $payment['paypal_client_id']); ?>" placeholder="<?php echo e(__('Client ID')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="paypal_secret_key" class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                            <input type="text" name="paypal_secret_key" id="paypal_secret_key" class="form-control" value="<?php echo e(!isset($payment['paypal_secret_key']) || is_null($payment['paypal_secret_key']) ? '' : $payment['paypal_secret_key']); ?>" placeholder="<?php echo e(__('Secret Key')); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Paystack -->
                                    <div class="accordion-item card">
                                        <h2 class="accordion-header" id="heading-2-4">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                <span class="d-flex align-items-center">
                                                    
                                                    <?php echo e(__('Paystack')); ?>

                                                </span>
                                                <?php echo e(__('Enable:')); ?>

                                                <div class="form-check form-switch custom-switch-v1">
                                                    <input type="hidden" name="is_paystack_enabled" value="off">
                                                    <input type="checkbox" class="form-check-input input-primary" id="customswitchv1-2" name="is_paystack_enabled" id="is_paystack_enabled" <?php echo e(isset($payment['is_paystack_enabled']) && $payment['is_paystack_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-label" for="customswitchv1-2"></label>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading-2-4" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="paypal_client_id" class="form-label"><?php echo e(__(' Key')); ?></label>
                                                            <input type="text" name="paystack_public_key" id="paystack_public_key" class="form-control" value="<?php echo e(!isset($payment['paystack_public_key']) || is_null($payment['paystack_public_key']) ? '' : $payment['paystack_public_key']); ?>" placeholder="<?php echo e(__(' Key')); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="paystack_secret_key" class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                            <input type="text" name="paystack_secret_key" id="paystack_secret_key" class="form-control" value="<?php echo e(!isset($payment['paystack_secret_key']) || is_null($payment['paystack_secret_key']) ? '' : $payment['paystack_secret_key']); ?>" placeholder="<?php echo e(__('Secret Key')); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- FLUTTERWAVE -->
                                    <div class="accordion-item card">
                                        <h2 class="accordion-header" id="heading-2-5">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                <span class="d-flex align-items-center">
                                                    
                                                    <?php echo e(__('Flutterwave')); ?>

                                                </span>
                                                <?php echo e(__('Enable:')); ?>

                                                <div class="form-check form-switch custom-switch-v1">
                                                    <input type="hidden" name="is_flutterwave_enabled" value="off">
                                                    <input type="checkbox" class="form-check-input input-primary" id="customswitchv1-2" name="is_flutterwave_enabled" id="is_flutterwave_enabled" <?php echo e(isset($payment['is_flutterwave_enabled']) && $payment['is_flutterwave_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-label" for="customswitchv1-2"></label>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading-2-5" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="paypal_client_id" class="form-label"><?php echo e(__(' Key')); ?></label>
                                                            <input type="text" name="flutterwave_public_key" id="flutterwave_public_key" class="form-control" value="<?php echo e(!isset($payment['flutterwave_public_key']) || is_null($payment['flutterwave_public_key']) ? '' : $payment['flutterwave_public_key']); ?>" placeholder="Public Key">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="paystack_secret_key" class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                            <input type="text" name="flutterwave_secret_key" id="flutterwave_secret_key" class="form-control" value="<?php echo e(!isset($payment['flutterwave_secret_key']) || is_null($payment['flutterwave_secret_key']) ? '' : $payment['flutterwave_secret_key']); ?>" placeholder="Secret Key">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Razorpay -->
                                    <div class="accordion-item card">
                                        <h2 class="accordion-header" id="heading-2-6">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                                <span class="d-flex align-items-center">
                                                    
                                                    <?php echo e(__('Razorpay')); ?>

                                                </span>
                                                <?php echo e(__('Enable:')); ?>

                                                <div class="form-check form-switch custom-switch-v1">
                                                    <input type="hidden" name="is_razorpay_enabled" value="off">
                                                    <input type="checkbox" class="form-check-input input-primary" id="customswitchv1-2" name="is_razorpay_enabled" id="is_razorpay_enabled" <?php echo e(isset($payment['is_razorpay_enabled']) && $payment['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-label" for="customswitchv1-2"></label>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading-2-6" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-md-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="paypal_client_id" class="form-label"><?php echo e(__(' Key')); ?></label>

                                                            <input type="text" name="razorpay_public_key" id="razorpay_public_key" class="form-control" value="<?php echo e(!isset($payment['razorpay_public_key']) || is_null($payment['razorpay_public_key']) ? '' : $payment['razorpay_public_key']); ?>" placeholder="Public Key">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="paystack_secret_key" class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                            <input type="text" name="razorpay_secret_key" id="razorpay_secret_key" class="form-control" value="<?php echo e(!isset($payment['razorpay_secret_key']) || is_null($payment['razorpay_secret_key']) ? '' : $payment['razorpay_secret_key']); ?>" placeholder="Secret Key">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Paytm -->
                                    <div class="accordion-item card">
                                        <h2 class="accordion-header" id="heading-2-7">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                                <span class="d-flex align-items-center">
                                                    
                                                    <?php echo e(__('Paytm')); ?>

                                                </span>
                                                <?php echo e(__('Enable:')); ?>

                                                <div class="form-check form-switch custom-switch-v1">
                                                    <input type="hidden" name="is_paytm_enabled" value="off">
                                                    <input type="checkbox" class="form-check-input input-primary" name="is_paytm_enabled" id="is_paytm_enabled" <?php echo e(isset($payment['is_paytm_enabled']) && $payment['is_paytm_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="form-check-label" for="customswitchv1-2"></label>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading-2-7" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                        <div class="row pt-2">
                                                            <label class="pb-2" for="paypal_mode"><?php echo e(__('Paytm Environment')); ?></label>
                                                            <div class="col-lg-3">
                                                                <div class="border card p-3">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input input-primary " name="paytm_mode" value="local" <?php echo e(!isset($payment['paytm_mode']) || $payment['paytm_mode'] == '' || $payment['paytm_mode'] == 'local' ? 'checked="checked"' : ''); ?>>


                                                                        <label class="form-check-label d-block" for="">
                                                                            <span>
                                                                                <span class="h5 d-block"><strong class="float-end"></strong><?php echo e(__('Local')); ?></span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="border card p-3">
                                                                    <div class="form-check">
                                                                        <input type="radio" class="form-check-input input-primary" name="paytm_mode" value="production" <?php echo e(isset($payment['paytm_mode']) && $payment['paytm_mode'] == 'production' ? 'checked="checked"' : ''); ?>>
                                                                        <label class="form-check-label d-block" for="">
                                                                            <span>
                                                                                <span class="h5 d-block"><strong class="float-end"></strong><?php echo e(__('Production')); ?></span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="paytm_public_key" class="form-label"><?php echo e(__('Merchant ID')); ?></label>
                                                    <input type="text" name="paytm_merchant_id" id="paytm_merchant_id" class="form-control" value="<?php echo e(!isset($payment['paytm_merchant_id']) || is_null($payment['paytm_merchant_id']) ? '' : $payment['paytm_merchant_id']); ?>" placeholder="Merchant ID">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="paytm_secret_key" class="form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                    <input type="text" name="paytm_merchant_key" id="paytm_merchant_key" class="form-control" value="<?php echo e(!isset($payment['paytm_merchant_key']) || is_null($payment['paytm_merchant_key']) ? '' : $payment['paytm_merchant_key']); ?>" placeholder="Merchant Key">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="paytm_industry_type" class="form-label"><?php echo e(__('Industry Type')); ?></label>
                                                    <input type="text" name="paytm_industry_type" id="paytm_industry_type" class="form-control" value="<?php echo e(!isset($payment['paytm_industry_type']) || is_null($payment['paytm_industry_type']) ? '' : $payment['paytm_industry_type']); ?>" placeholder="Industry Type">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mercado Pago-->
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-8">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                                        <span class="d-flex align-items-center">
                                            
                                            <?php echo e(__('MercadoPago')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_mercado_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_mercado_enabled" id="is_mercado_enabled" <?php echo e(isset($payment['is_mercado_enabled']) && $payment['is_mercado_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="form-check-label" for="customswitchv1-2"></label>
                                        </div>

                                    </button>
                                </h2>
                                <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading-2-8" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">

                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                <div class="row pt-2">
                                                    <label class="pb-2" for="paypal_mode"><?php echo e(__('Mercado Mode')); ?></label>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input input-primary " name="mercado_mode" value="sandbox" <?php echo e((isset($payment['mercado_mode']) && $payment['mercado_mode'] == '') || (isset($payment['mercado_mode']) && $payment['mercado_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>


                                                                <label class="form-check-label d-block" for="">
                                                                    <span>
                                                                        <span class="h5 d-block"><strong class="float-end"></strong><?php echo e(__('Sandbox')); ?></span>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input input-primary " name="mercado_mode" value="live" <?php echo e(isset($payment['mercado_mode']) && $payment['mercado_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                <label class="form-check-label d-block" for="">
                                                                    <span>
                                                                        <span class="h5 d-block"><strong class="float-end"></strong><?php echo e(__('Live')); ?></span>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="mercado_access_token" class="form-label"><?php echo e(__('Access Token')); ?></label>
                                                    <input type="text" name="mercado_access_token" id="mercado_access_token" class="form-control" value="<?php echo e(isset($payment['mercado_access_token']) ? $payment['mercado_access_token'] : ''); ?>" />
                                                    <?php if($errors->has('mercado_secret_key')): ?>
                                                    <span class="invalid-feedback d-block">
                                                        <?php echo e($errors->first('mercado_access_token')); ?>

                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mollie -->
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-9">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
                                        <span class="d-flex align-items-center">
                                            
                                            <?php echo e(__('Mollie')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_mollie_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_mollie_enabled" id="is_mollie_enabled" <?php echo e(isset($payment['is_mollie_enabled']) && $payment['is_mollie_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="form-check-label" for="customswitchv1-2"></label>
                                        </div>

                                    </button>
                                </h2>
                                <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading-2-9" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">

                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mollie_api_key" class="form-label"><?php echo e(__('Mollie Api Key')); ?></label>
                                                        <input type="text" name="mollie_api_key" id="mollie_api_key" class="form-control" value="<?php echo e(!isset($payment['mollie_api_key']) || is_null($payment['mollie_api_key']) ? '' : $payment['mollie_api_key']); ?>" placeholder="Mollie Api Key">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mollie_profile_id" class="form-label"><?php echo e(__('Mollie Profile Id')); ?></label>
                                                        <input type="text" name="mollie_profile_id" id="mollie_profile_id" class="form-control" value="<?php echo e(!isset($payment['mollie_profile_id']) || is_null($payment['mollie_profile_id']) ? '' : $payment['mollie_profile_id']); ?>" placeholder="Mollie Profile Id">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mollie_partner_id" class="form-label"><?php echo e(__('Mollie Partner Id')); ?></label>
                                                        <input type="text" name="mollie_partner_id" id="mollie_partner_id" class="form-control" value="<?php echo e(!isset($payment['mollie_partner_id']) || is_null($payment['mollie_partner_id']) ? '' : $payment['mollie_partner_id']); ?>" placeholder="Mollie Partner Id">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Skrill -->
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-10">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
                                        <span class="d-flex align-items-center">
                                            
                                            <?php echo e(__('Skrill')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_skrill_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_skrill_enabled" id="is_skrill_enabled" <?php echo e(isset($payment['is_skrill_enabled']) && $payment['is_skrill_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="form-check-label" for="customswitchv1-2"></label>
                                        </div>

                                    </button>
                                </h2>
                                <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading-2-10" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">

                                            <div class="col-md-6 mt-3">
                                                <div class="form-group">
                                                    <label for="mollie_api_key" class="form-label"><?php echo e(__('Skrill Email')); ?></label>
                                                    <input type="text" name="skrill_email" id="skrill_email" class="form-control" value="<?php echo e(!isset($payment['skrill_email']) || is_null($payment['skrill_email']) ? '' : $payment['skrill_email']); ?>" placeholder="Enter Skrill Email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CoinGate -->
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-11">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                        <span class="d-flex align-items-center">
                                            
                                            <?php echo e(__('CoinGate')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_coingate_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_coingate_enabled" id="is_coingate_enabled" <?php echo e(isset($payment['is_coingate_enabled']) && $payment['is_coingate_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="form-check-label" for="customswitchv1-2"></label>
                                        </div>

                                    </button>
                                </h2>
                                <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading-2-11" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">

                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                                <div class="row pt-2">
                                                    <label class="pb-2" for="paypal_mode"><?php echo e(__('CoinGate Mode')); ?></label>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input input-primary" name="coingate_mode" value="sandbox" <?php echo e(!isset($payment['coingate_mode']) || $payment['coingate_mode'] == '' || $payment['coingate_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>


                                                                <label class="form-check-label d-block" for="">
                                                                    <span>
                                                                        <span class="h5 d-block"><strong class="float-end"></strong><?php echo e(__('Sandbox')); ?></span>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="border card p-3">
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input input-primary" name="coingate_mode" value="live" <?php echo e(isset($payment['coingate_mode']) && $payment['coingate_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                                <label class="form-check-label d-block" for="">
                                                                    <span>
                                                                        <span class="h5 d-block"><strong class="float-end"></strong><?php echo e(__('Live')); ?></span>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="coingate_auth_token" class="form-label"><?php echo e(__('CoinGate Auth Token')); ?></label>
                                                    <input type="text" name="coingate_auth_token" id="coingate_auth_token" class="form-control" value="<?php echo e(!isset($payment['coingate_auth_token']) || is_null($payment['coingate_auth_token']) ? '' : $payment['coingate_auth_token']); ?>" placeholder="CoinGate Auth Token">
                                                </div>
                                                <?php if($errors->has('coingate_auth_token')): ?>
                                                <span class="invalid-feedback d-block">
                                                    <?php echo e($errors->first('coingate_auth_token')); ?>

                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- PaymentWall -->
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-12">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="true" aria-controls="collapse11">
                                        <span class="d-flex align-items-center">
                                            
                                            <?php echo e(__('PaymentWall')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_paymentwall_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_paymentwall_enabled" id="is_paymentwall_enabled" <?php echo e(isset($payment['is_paymentwall_enabled']) && $payment['is_paymentwall_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="form-check-label" for="customswitchv1-2"></label>
                                        </div>

                                    </button>
                                </h2>
                                <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading-2-12" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paymentwall_public_key" class="form-label"><?php echo e(__(' Key')); ?></label>
                                                    <input type="text" name="paymentwall_public_key" id="paymentwall_public_key" class="form-control" value="<?php echo e(!isset($payment['paymentwall_public_key']) || is_null($payment['paymentwall_public_key']) ? '' : $payment['paymentwall_public_key']); ?>" placeholder="<?php echo e(__(' Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paymentwall_private_key" class="form-label"><?php echo e(__('Private Key')); ?></label>
                                                    <input type="text" name="paymentwall_private_key" id="paymentwall_private_key" class="form-control" value="<?php echo e(!isset($payment['paymentwall_private_key']) || is_null($payment['paymentwall_private_key']) ? '' : $payment['paymentwall_private_key']); ?>" placeholder="<?php echo e(__('Private Key')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-13">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="true" aria-controls="collapse12">
                                        <span class="d-flex align-items-center">
                                            
                                            <?php echo e(__('Toyyibpay')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_toyyibpay_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_toyyibpay_enabled" id="is_toyyibpay_enabled" <?php echo e(isset($payment['is_toyyibpay_enabled']) && $payment['is_toyyibpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label for="customswitch1-2" class="form-check-label"></label>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading-2-13" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="toyyibpay_secret_key" class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="toyyibpay_secret_key" id="toyyibpay_secret_key" class="form-control" value="<?php echo e(!isset($payment['toyyibpay_secret_key']) || is_null($payment['toyyibpay_secret_key']) ? '' : $payment['toyyibpay_secret_key']); ?>" placeholder="<?php echo e(__('Secret Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="category_code" class="form-label"><?php echo e(__('Category Code')); ?></label>
                                                    <input type="text" name="category_code" id="category_code" class="form-control" value="<?php echo e(!isset($payment['category_code']) || is_null($payment['category_code']) ? '' : $payment['category_code']); ?>" placeholder="<?php echo e(__('Category Code')); ?>">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-14">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse14" aria-expanded="true" aria-controls="collapse14">
                                        <span class="d-flex align-items-center">
                                            
                                            <?php echo e(__('Payfast')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_payfast_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_payfast_enabled" id="is_payfast_enabled" <?php echo e(isset($payment['is_payfast_enabled']) && $payment['is_payfast_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="form-check-label" for="customswitchv1-2"></label>
                                        </div>
                                    </button>
                                </h2>

                                <div id="collapse14" class="accordion-collapse collapse" aria-labelledby="heading-2-14" data-bs-parent="#accordionExample">

                                    <div class="accordion-body">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                            <div class="row pt-2">
                                                <label class="pb-2" for="payfast_mode"><?php echo e(__('Payfast Mode')); ?></label>
                                                <div class="col-lg-3">
                                                    <div class="border card p-3">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input input-primary " name="payfast_mode" value="sandbox" <?php echo e(!isset($payment['payfast_mode']) || $payment['payfast_mode'] == '' || $payment['payfast_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                            <label class="form-check-label d-block" for="">
                                                                <span>
                                                                    <span class="h5 d-block"><strong class="float-end"></strong><?php echo e(__('Sandbox')); ?></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="border card p-3">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input input-primary " name="payfast_mode" value="live" <?php echo e(isset($payment['payfast_mode']) && $payment['payfast_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                            <label class="form-check-label d-block" for="">
                                                                <span>
                                                                    <span class="h5 d-block"><strong class="float-end"></strong><?php echo e(__('Live')); ?></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="payfast_merchant_id" class="form-label"><?php echo e(__('Merchant Id')); ?></label>
                                                    <input type="text" name="payfast_merchant_id" id="payfast_merchant_id" class="form-control" value="<?php echo e(!isset($payment['payfast_merchant_id']) || is_null($payment['payfast_merchant_id']) ? '' : $payment['payfast_merchant_id']); ?>" placeholder="<?php echo e(__('Merchant Id')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="payfast_merchant_key" class="form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                    <input type="text" name="payfast_merchant_key" id="payfast_merchant_key" class="form-control" value="<?php echo e(!isset($payment['payfast_merchant_key']) || is_null($payment['payfast_merchant_key']) ? '' : $payment['payfast_merchant_key']); ?>" placeholder="<?php echo e(__('Merchant Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="payfast_signature" class="form-label"><?php echo e(__('Salt Passphrase')); ?></label>
                                                    <input type="text" name="payfast_signature" id="payfast_signature" class="form-control" value="<?php echo e(!isset($payment['payfast_signature']) || is_null($payment['payfast_signature']) ? '' : $payment['payfast_signature']); ?>" placeholder="<?php echo e(__('Salt Passphrase')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-15">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse15" aria-expanded="true" aria-controls="collapse15">
                                        <span class="d-flex align-items-center">
                                            
                                            <?php echo e(__('IyziPay')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_iyzipay_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_iyzipay_enabled" id="is_iyzipay_enabled" <?php echo e(isset($payment['is_iyzipay_enabled']) && $payment['is_iyzipay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="form-check-label" for="customswitchv1-2"></label>
                                        </div>
                                    </button>
                                </h2>

                                <div id="collapse15" class="accordion-collapse collapse" aria-labelledby="heading-2-14" data-bs-parent="#accordionExample">

                                    <div class="accordion-body">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                                            <div class="row pt-2">
                                                <label class="pb-2" for="iyzipay_mode"><?php echo e(__('IyziPay Mode')); ?></label>
                                                <div class="col-lg-3">
                                                    <div class="border card p-3">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input input-primary " name="iyzipay_mode" value="sandbox" <?php echo e(!isset($payment['iyzipay_mode']) || $payment['iyzipay_mode'] == '' || $payment['iyzipay_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                                            <label class="form-check-label d-block" for="">
                                                                <span>
                                                                    <span class="h5 d-block"><strong class="float-end"></strong><?php echo e(__('Sandbox')); ?></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="border card p-3">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input input-primary " name="iyzipay_mode" value="live" <?php echo e(isset($payment['iyzipay_mode']) && $payment['iyzipay_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                                            <label class="form-check-label d-block" for="">
                                                                <span>
                                                                    <span class="h5 d-block"><strong class="float-end"></strong><?php echo e(__('Live')); ?></span>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="iyzipay_key" class="form-label"><?php echo e(__('IyziPay Key')); ?></label>
                                                    <input type="text" name="iyzipay_key" id="iyzipay_key" class="form-control" value="<?php echo e(!isset($payment['iyzipay_key']) || is_null($payment['iyzipay_key']) ? '' : $payment['iyzipay_key']); ?>" placeholder="<?php echo e(__('IyziPay Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="iyzipay_secret" class="form-label"><?php echo e(__('IyziPay Secret')); ?></label>
                                                    <input type="text" name="iyzipay_secret" id="iyzipay_secret" class="form-control" value="<?php echo e(!isset($payment['iyzipay_secret']) || is_null($payment['iyzipay_secret']) ? '' : $payment['iyzipay_secret']); ?>" placeholder="<?php echo e(__('IyziPay Secret')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-16">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse16" aria-expanded="true" aria-controls="collapse16">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('SSPay')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_sspay_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_sspay_enabled" id="is_sspay_enabled" <?php echo e(isset($payment['is_sspay_enabled']) && $payment['is_sspay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label for="customswitch1-2" class="form-check-label"></label>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse16" class="accordion-collapse collapse" aria-labelledby="heading-2-16" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sspay_secret_key" class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="sspay_secret_key" id="sspay_secret_key" class="form-control" value="<?php echo e(!isset($payment['sspay_secret_key']) || is_null($payment['sspay_secret_key']) ? '' : $payment['sspay_secret_key']); ?>" placeholder="<?php echo e(__('Secret Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sspay_category_code" class="form-label"><?php echo e(__('Category Code')); ?></label>
                                                    <input type="text" name="sspay_category_code" id="sspay_category_code" class="form-control" value="<?php echo e(!isset($payment['sspay_category_code']) || is_null($payment['sspay_category_code']) ? '' : $payment['sspay_category_code']); ?>" placeholder="<?php echo e(__('Category Code')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-17">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse17" aria-expanded="true" aria-controls="collapse17">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('PayTab')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_paytab_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_paytab_enabled" id="is_paytab_enabled" <?php echo e(isset($payment['is_paytab_enabled']) && $payment['is_paytab_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label for="customswitch1-2" class="form-check-label"></label>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse17" class="accordion-collapse collapse" aria-labelledby="heading-2-17" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paytab_profile_id" class="form-label"><?php echo e(__('Profile Id')); ?></label>
                                                    <input type="text" name="paytab_profile_id" id="paytab_profile_id" class="form-control" value="<?php echo e(!isset($payment['paytab_profile_id']) || is_null($payment['paytab_profile_id']) ? '' : $payment['paytab_profile_id']); ?>" placeholder="<?php echo e(__('Profile Id')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paytab_server_key" class="form-label"><?php echo e(__('Server Key')); ?></label>
                                                    <input type="text" name="paytab_server_key" id="paytab_server_key" class="form-control" value="<?php echo e(!isset($payment['paytab_server_key']) || is_null($payment['paytab_server_key']) ? '' : $payment['paytab_server_key']); ?>" placeholder="<?php echo e(__('Server Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paytab_region" class="form-label"><?php echo e(__('Paytab Region')); ?></label>
                                                    <input type="text" name="paytab_region" id="paytab_region" class="form-control" value="<?php echo e(!isset($payment['paytab_region']) || is_null($payment['paytab_region']) ? '' : $payment['paytab_region']); ?>" placeholder="<?php echo e(__('Paytab Region')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-18">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse18" aria-expanded="true" aria-controls="collapse18">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Benefit')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_benefit_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_benefit_enabled" id="is_benefit_enabled" <?php echo e(isset($payment['is_benefit_enabled']) && $payment['is_benefit_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label for="customswitch1-2" class="form-check-label"></label>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse18" class="accordion-collapse collapse" aria-labelledby="heading-2-18" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="benefit_api_key" class="form-label"><?php echo e(__('Benefit Key')); ?></label>
                                                    <input type="text" name="benefit_api_key" id="benefit_api_key" class="form-control" value="<?php echo e(!isset($payment['benefit_api_key']) || is_null($payment['benefit_api_key']) ? '' : $payment['benefit_api_key']); ?>" placeholder="<?php echo e(__('Enter Benefit Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="benefit_secret_key" class="form-label"><?php echo e(__('Benefit Secret Key')); ?></label>
                                                    <input type="text" name="benefit_secret_key" id="benefit_secret_key" class="form-control" value="<?php echo e(!isset($payment['benefit_secret_key']) || is_null($payment['benefit_secret_key']) ? '' : $payment['benefit_secret_key']); ?>" placeholder="<?php echo e(__('Enter Benefit Secret key')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-19">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse19" aria-expanded="true" aria-controls="collapse19">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Cashfree')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_cashfree_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_cashfree_enabled" id="is_cashfree_enabled" <?php echo e(isset($payment['is_cashfree_enabled']) && $payment['is_cashfree_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label for="customswitch1-2" class="form-check-label"></label>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse19" class="accordion-collapse collapse" aria-labelledby="heading-2-19" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cashfree_api_key" class="form-label"><?php echo e(__(' Cashfree Key')); ?></label>
                                                    <input type="text" name="cashfree_api_key" id="cashfree_api_key" class="form-control" value="<?php echo e(!isset($payment['cashfree_api_key']) || is_null($payment['cashfree_api_key']) ? '' : $payment['cashfree_api_key']); ?>" placeholder="<?php echo e(__('Enter Cashfree Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cashfree_secret_key" class="form-label"><?php echo e(__('Cashfree Secret Key')); ?></label>
                                                    <input type="text" name="cashfree_secret_key" id="cashfree_secret_key" class="form-control" value="<?php echo e(!isset($payment['cashfree_secret_key']) || is_null($payment['cashfree_secret_key']) ? '' : $payment['cashfree_secret_key']); ?>" placeholder="<?php echo e(__('Enter Cashfree Secret Key')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-20">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse20" aria-expanded="true" aria-controls="collapse20">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Aamarpay')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_aamarpay_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_aamarpay_enabled" id="is_aamarpay_enabled" <?php echo e(isset($payment['is_aamarpay_enabled']) && $payment['is_aamarpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label for="customswitch1-2" class="form-check-label"></label>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse20" class="accordion-collapse collapse" aria-labelledby="heading-2-20" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="aamarpay_store_id" class="form-label"><?php echo e(__(' Store Id')); ?></label>
                                                    <input type="text" name="aamarpay_store_id" id="aamarpay_store_id" class="form-control" value="<?php echo e(!isset($payment['aamarpay_store_id']) || is_null($payment['aamarpay_store_id']) ? '' : $payment['aamarpay_store_id']); ?>" placeholder="<?php echo e(__('Enter Store Id')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="aamarpay_signature_key" class="form-label"><?php echo e(__('Signature Key')); ?></label>
                                                    <input type="text" name="aamarpay_signature_key" id="aamarpay_signature_key" class="form-control" value="<?php echo e(!isset($payment['aamarpay_signature_key']) || is_null($payment['aamarpay_signature_key']) ? '' : $payment['aamarpay_signature_key']); ?>" placeholder="<?php echo e(__('Enter Signature Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="aamarpay_description" class="form-label"><?php echo e(__('Description')); ?></label>
                                                    <input type="text" name="aamarpay_description" id="aamarpay_description" class="form-control" value="<?php echo e(!isset($payment['aamarpay_description']) || is_null($payment['aamarpay_description']) ? '' : $payment['aamarpay_description']); ?>" placeholder="<?php echo e(__('Enter Signature Key')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-21">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse21" aria-expanded="true" aria-controls="collapse21">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Pay TR')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_paytr_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_paytr_enabled" id="is_paytr_enabled" <?php echo e(isset($payment['is_paytr_enabled']) && $payment['is_paytr_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="form-check-label" for="customswitchv1-2"></label>
                                        </div>
                                    </button>
                                </h2>

                                <div id="collapse21" class="accordion-collapse collapse" aria-labelledby="heading-2-21" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paytr_merchant_id" class="form-label"><?php echo e(__('Merchant Id')); ?></label>
                                                    <input type="text" name="paytr_merchant_id" id="paytr_merchant_id" class="form-control" value="<?php echo e(!isset($payment['paytr_merchant_id']) || is_null($payment['paytr_merchant_id']) ? '' : $payment['paytr_merchant_id']); ?>" placeholder="<?php echo e(__('Merchant Id')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paytr_merchant_key" class="form-label"><?php echo e(__('Merchant Key')); ?></label>
                                                    <input type="text" name="paytr_merchant_key" id="paytr_merchant_key" class="form-control" value="<?php echo e(!isset($payment['paytr_merchant_key']) || is_null($payment['paytr_merchant_key']) ? '' : $payment['paytr_merchant_key']); ?>" placeholder="<?php echo e(__('Merchant Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paytr_merchant_salt" class="form-label"><?php echo e(__('Salt Passphrase')); ?></label>
                                                    <input type="text" name="paytr_merchant_salt" id="paytr_merchant_salt" class="form-control" value="<?php echo e(!isset($payment['paytr_merchant_salt']) || is_null($payment['paytr_merchant_salt']) ? '' : $payment['paytr_merchant_salt']); ?>" placeholder="<?php echo e(__('Salt Passphrase')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-22">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse22" aria-expanded="true" aria-controls="collapse22">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Yookassa')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_yookassa_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_yookassa_enabled" id="is_yookassa_enabled" <?php echo e(isset($payment['is_yookassa_enabled']) && $payment['is_yookassa_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="form-check-label" for="customswitchv1-2"></label>
                                        </div>
                                    </button>
                                </h2>

                                <div id="collapse22" class="accordion-collapse collapse" aria-labelledby="heading-2-22" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="yookassa_shop_id" class="form-label"><?php echo e(__('Shop ID Key')); ?></label>
                                                    <input type="text" name="yookassa_shop_id" id="yookassa_shop_id" class="form-control" value="<?php echo e(!isset($payment['yookassa_shop_id']) || is_null($payment['yookassa_shop_id']) ? '' : $payment['yookassa_shop_id']); ?>" placeholder="<?php echo e(__('Enter Shop ID Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="yookassa_secret" class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="yookassa_secret" id="yookassa_secret" class="form-control" value="<?php echo e(!isset($payment['yookassa_secret']) || is_null($payment['yookassa_secret']) ? '' : $payment['yookassa_secret']); ?>" placeholder="<?php echo e(__('Enter Secret Key')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-23">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse23" aria-expanded="true" aria-controls="collapse23">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Midtrans')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_midtrans_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_midtrans_enabled" id="is_midtrans_enabled" <?php echo e(isset($payment['is_midtrans_enabled']) && $payment['is_midtrans_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="form-check-label" for="customswitchv1-2"></label>
                                        </div>
                                    </button>
                                </h2>

                                <div id="collapse23" class="accordion-collapse collapse" aria-labelledby="heading-2-23" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="midtrans_secret" class="form-label"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="midtrans_secret" id="midtrans_secret" class="form-control" value="<?php echo e(!isset($payment['midtrans_secret']) || is_null($payment['midtrans_secret']) ? '' : $payment['midtrans_secret']); ?>" placeholder="<?php echo e(__('Enter Secret Key')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="accordion-item card">
                                <h2 class="accordion-header" id="heading-2-24">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse24" aria-expanded="true" aria-controls="collapse24">
                                        <span class="d-flex align-items-center">
                                            <?php echo e(__('Xendit')); ?>

                                        </span>
                                        <?php echo e(__('Enable:')); ?>

                                        <div class="form-check form-switch custom-switch-v1">
                                            <input type="hidden" name="is_xendit_enabled" value="off">
                                            <input type="checkbox" class="form-check-input input-primary" name="is_xendit_enabled" id="is_xendit_enabled" <?php echo e(isset($payment['is_xendit_enabled']) && $payment['is_xendit_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                                            <label class="form-check-label" for="customswitchv1-2"></label>
                                        </div>
                                    </button>
                                </h2>

                                <div id="collapse24" class="accordion-collapse collapse" aria-labelledby="heading-2-24" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="xendit_api" class="form-label"><?php echo e(__('API Key')); ?></label>
                                                    <input type="text" name="xendit_api" id="xendit_api" class="form-control" value="<?php echo e(!isset($payment['xendit_api']) || is_null($payment['xendit_api']) ? '' : $payment['xendit_api']); ?>" placeholder="<?php echo e(__('Enter API Key')); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="xendit_token" class="form-label"><?php echo e(__('Token')); ?></label>
                                                    <input type="text" name="xendit_token" id="xendit_token" class="form-control" value="<?php echo e(!isset($payment['xendit_token']) || is_null($payment['xendit_token']) ? '' : $payment['xendit_token']); ?>" placeholder="<?php echo e(__('Enter Token')); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn-submit btn btn-primary'])); ?>

                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
        
        <div id="recaptcha-settings" class="card">
            <form method="POST" action="<?php echo e(route('recaptcha.settings.store')); ?>" accept-charset="UTF-8">
                <?php echo csrf_field(); ?>
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5><?php echo e(__('ReCaptcha settings')); ?></h5>
                            <a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/" target="_blank" class="text-blue">
                                <small>(<?php echo e(__('How to Get Google reCaptcha Site and Secret key')); ?>)</small>
                            </a>
                        </div>
                        <div class="col-6 text-end">
                            <div class="col switch-width">
                                <div class="form-group ml-2 mb-0">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" data-onstyle="primary" data-toggle="switchbutton" name="recaptcha_module" id="recaptcha_module" value="yes" <?php echo e($settings['recaptcha_module'] == 'yes' ? ' checked ' : ''); ?>>
                                        <label class="custom-control-label form-control-label px-2" for="recaptcha_module"></label><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-0">
                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                            <label for="google_recaptcha_key" class="form-label"><?php echo e(__('Google Recaptcha Key')); ?></label>
                            <input class="form-control" placeholder="<?php echo e(__('Enter Google Recaptcha Key')); ?>" name="google_recaptcha_key" type="text" value=" <?php echo e(!isset($settings['google_recaptcha_key']) || is_null($settings['google_recaptcha_key']) ? '' : $settings['google_recaptcha_key']); ?>" id="google_recaptcha_key">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                            <label for="google_recaptcha_secret" class="form-label"><?php echo e(__('Google Recaptcha Secret')); ?></label>
                            <input class="form-control " placeholder="<?php echo e(__('Enter Google Recaptcha Secret')); ?>" name="google_recaptcha_secret" type="text" value=" <?php echo e(!isset($settings['google_recaptcha_secret']) || is_null($settings['google_recaptcha_secret']) ? '' : $settings['google_recaptcha_secret']); ?>" id="google_recaptcha_secret">
                        </div>
                        <div class="text-end">
                            <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn-submit btn btn-primary'])); ?>

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--storage Setting-->
        <div id="storage-settings" class="card mb-3">
            <?php echo e(Form::open(['route' => 'storage.setting.store', 'enctype' => 'multipart/form-data'])); ?>

            <div class="card-header">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10">
                        <h5 class=""><?php echo e(__('Storage Settings')); ?></h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <div class="pe-2">
                        <input type="radio" class="btn-check" name="storage_setting" id="local-outlined" autocomplete="off" <?php echo e($settings['storage_setting'] == 'local' ? 'checked' : ''); ?> value="local" checked>
                        <label class="btn btn-outline-primary" for="local-outlined"><?php echo e(__('Local')); ?></label>
                    </div>
                    <div class="pe-2">
                        <input type="radio" class="btn-check" name="storage_setting" id="s3-outlined" autocomplete="off" <?php echo e($settings['storage_setting'] == 's3' ? 'checked' : ''); ?> value="s3">
                        <label class="btn btn-outline-primary" for="s3-outlined">
                            <?php echo e(__('AWS S3')); ?></label>
                    </div>

                    <div class="pe-2">
                        <input type="radio" class="btn-check" name="storage_setting" id="wasabi-outlined" autocomplete="off" <?php echo e($settings['storage_setting'] == 'wasabi' ? 'checked' : ''); ?> value="wasabi">
                        <label class="btn btn-outline-primary" for="wasabi-outlined"><?php echo e(__('Wasabi')); ?></label>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="local-setting row">
                        <div class="col-lg-7">
                            
                            <div class="form-group col-12 switch-width">
                                <?php echo e(Form::label('local_storage_validation', __('Only Upload Files'), ['class' => ' form-label'])); ?>

                                <select name="local_storage_validation[]" class="select2" id="local_storage_validation" multiple>
                                    <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if(in_array($f, $local_storage_validations)): ?> selected <?php endif; ?>>
                                        <?php echo e($f); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="local_storage_max_upload_size"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                <input type="number" name="local_storage_max_upload_size" class="form-control" value="<?php echo e(!isset($settings['local_storage_max_upload_size']) || is_null($settings['local_storage_max_upload_size']) ? '' : $settings['local_storage_max_upload_size']); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="s3-setting row <?php echo e($settings['storage_setting'] == 's3' ? ' ' : 'd-none'); ?>">

                        <div class=" row ">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="s3_key"><?php echo e(__('S3 Key')); ?></label>
                                    <input type="text" name="s3_key" class="form-control" value="<?php echo e(!isset($settings['s3_key']) || is_null($settings['s3_key']) ? '' : $settings['s3_key']); ?>" placeholder="<?php echo e(__('S3 Key')); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="s3_secret"><?php echo e(__('S3 Secret')); ?></label>
                                    <input type="text" name="s3_secret" class="form-control" value="<?php echo e(!isset($settings['s3_secret']) || is_null($settings['s3_secret']) ? '' : $settings['s3_secret']); ?>" placeholder="<?php echo e(__('S3 Secret')); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="s3_region"><?php echo e(__('S3 Region')); ?></label>
                                    <input type="text" name="s3_region" class="form-control" value="<?php echo e(!isset($settings['s3_region']) || is_null($settings['s3_region']) ? '' : $settings['s3_region']); ?>" placeholder="<?php echo e(__('S3 Region')); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="s3_bucket"><?php echo e(__('S3 Bucket')); ?></label>
                                    <input type="text" name="s3_bucket" class="form-control" value="<?php echo e(!isset($settings['s3_bucket']) || is_null($settings['s3_bucket']) ? '' : $settings['s3_bucket']); ?>" placeholder="<?php echo e(__('S3 Bucket')); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="s3_url"><?php echo e(__('S3 URL')); ?></label>
                                    <input type="text" name="s3_url" class="form-control" value="<?php echo e(!isset($settings['s3_url']) || is_null($settings['s3_url']) ? '' : $settings['s3_url']); ?>" placeholder="<?php echo e(__('S3 URL')); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="s3_endpoint"><?php echo e(__('S3 Endpoint')); ?></label>
                                    <input type="text" name="s3_endpoint" class="form-control" value="<?php echo e(!isset($settings['s3_endpoint']) || is_null($settings['s3_endpoint']) ? '' : $settings['s3_endpoint']); ?>" placeholder="<?php echo e(__('S3 Endpoint')); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group col-12 switch-width">
                                    <?php echo e(Form::label('s3_storage_validation', __('Only Upload Files'), ['class' => ' form-label'])); ?>

                                    <select name="s3_storage_validation[]" class="select2" id="s3_storage_validation" multiple>
                                        <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if(in_array($f, $s3_storage_validations)): ?> selected <?php endif; ?>>
                                            <?php echo e($f); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="s3_max_upload_size"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                    <input type="number" name="s3_max_upload_size" class="form-control" value="<?php echo e(!isset($settings['s3_max_upload_size']) || is_null($settings['s3_max_upload_size']) ? '' : $settings['s3_max_upload_size']); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="wasabi-setting row <?php echo e($settings['storage_setting'] == 'wasabi' ? ' ' : 'd-none'); ?>">
                        <div class=" row ">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="s3_key"><?php echo e(__('Wasabi Key')); ?></label>
                                    <input type="text" name="wasabi_key" class="form-control" value="<?php echo e(!isset($settings['wasabi_key']) || is_null($settings['wasabi_key']) ? '' : $settings['wasabi_key']); ?>" placeholder="<?php echo e(__('Wasabi Key')); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="s3_secret"><?php echo e(__('Wasabi Secret')); ?></label>
                                    <input type="text" name="wasabi_secret" class="form-control" value="<?php echo e(!isset($settings['wasabi_secret']) || is_null($settings['wasabi_secret']) ? '' : $settings['wasabi_secret']); ?>" placeholder="<?php echo e(__('Wasabi Secret')); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="s3_region"><?php echo e(__('Wasabi Region')); ?></label>
                                    <input type="text" name="wasabi_region" class="form-control" value="<?php echo e(!isset($settings['wasabi_region']) || is_null($settings['wasabi_region']) ? '' : $settings['wasabi_region']); ?>" placeholder="<?php echo e(__('Wasabi Region')); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="wasabi_bucket"><?php echo e(__('Wasabi Bucket')); ?></label>
                                    <input type="text" name="wasabi_bucket" class="form-control" value="<?php echo e(!isset($settings['wasabi_bucket']) || is_null($settings['wasabi_bucket']) ? '' : $settings['wasabi_bucket']); ?>" placeholder="<?php echo e(__('Wasabi Bucket')); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="wasabi_url"><?php echo e(__('Wasabi URL')); ?></label>
                                    <input type="text" name="wasabi_url" class="form-control" value="<?php echo e(!isset($settings['wasabi_url']) || is_null($settings['wasabi_url']) ? '' : $settings['wasabi_url']); ?>" placeholder="<?php echo e(__('Wasabi URL')); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="wasabi_root"><?php echo e(__('Wasabi Root')); ?></label>
                                    <input type="text" name="wasabi_root" class="form-control" value="<?php echo e(!isset($settings['wasabi_root']) || is_null($settings['wasabi_root']) ? '' : $settings['wasabi_root']); ?>" placeholder="<?php echo e(__('Wasabi Root')); ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="form-group col-12 switch-width">
                                    <?php echo e(Form::label('wasabi_storage_validation', __('Only Upload Files'), ['class' => 'form-label'])); ?>


                                    <select name="wasabi_storage_validation[]" class="select2" id="wasabi_storage_validation" multiple>
                                        <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if(in_array($f, $wasabi_storage_validations)): ?> selected <?php endif; ?>>
                                            <?php echo e($f); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="wasabi_root"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                    <input type="number" name="wasabi_max_upload_size" class="form-control" value="<?php echo e(!isset($settings['wasabi_max_upload_size']) || is_null($settings['wasabi_max_upload_size']) ? '' : $settings['wasabi_max_upload_size']); ?>" placeholder="<?php echo e(__('Max upload size')); ?>">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
        
        <div class="card" id="SEO">
            <?php echo e(Form::open(['url' => route('seo.settings'), 'enctype' => 'multipart/form-data'])); ?>

            <div class="card-header">

                <h5><?php echo e(__('SEO Settings')); ?></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if(!empty($settings['chatgpt_key'])): ?>
                    <div class="text-end">
                        <a href="#" data-size="md" class="btn btn-sm btn-primary " data-ajax-popup-over="true" data-size="md" data-title="<?php echo e(__('Generate content with AI')); ?>" data-url="<?php echo e(route('generate', ['seo'])); ?>" data-toggle="tooltip" title="<?php echo e(__('Generate')); ?>">
                            <i class="fas fa-robot"></span><span class="robot"><?php echo e(__('Generate With AI')); ?></span></i>
                        </a>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('meta_keywords', __('Meta Keywords'), ['class' => 'col-form-label'])); ?>

                            <?php echo e(Form::text('meta_keywords', Utility::getValByName('meta_keywords'), ['class' => 'form-control ', 'placeholder' => 'Meta Keywords'])); ?>

                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('meta_description', __('Meta Description'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::textarea('meta_description', Utility::getValByName('meta_description'), ['class' => 'form-control ', 'rows' => '5', 'placeholder' => 'Enter Meta Description'])); ?>

                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('Meta Image', __('Meta Image'), ['class' => 'col-form-label'])); ?>

                            <div class="">
                                

                                <a href="<?php echo e($meta_image . '/' . (isset($settings['meta_image']) && !empty($settings['meta_image']) ? $settings['meta_image'] : 'meta_image.png')); ?>" target="_blank"> <img id="meta" src="<?php echo e($meta_image . '/' . (isset($settings['meta_image']) && !empty($settings['meta_image']) ? $settings['meta_image'] : 'meta_image.png')); ?>" width="300px" class="img_setting"> </a>
                            </div>
                            <div class="choose-files mt-4">
                                <label for="meta_image">
                                    <div class=" bg-primary logo"> <i class="ti ti-upload px-1"></i><?php echo e(__('Select image')); ?>

                                    </div>
                                    <input style="margin-top: -40px;" type="file" class="form-control file" name="meta_image" id="meta_image" data-filename="meta_image" onchange="document.getElementById('meta_image_pre').src = window.URL.createObjectURL(this.files[0])" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn-submit btn btn-primary" type="submit">
                            <?php echo e(__('Save Changes')); ?>

                        </button>
                    </div>
                </div>
            </div>

            <?php echo e(Form::close()); ?>

        </div>
        
        <div class="card" id="cache">
            <div class="card-header">
                <div class="row">

                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <h5><?php echo e(__('Cache Settings')); ?></h5>
                        <p class="text-muted">This is a page meant for more advanced users, simply
                            ignore it if you don't understand what cache is.</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">

                </div>
                <div class="row">
                    <div class="row col-xl-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="size">Current cache size</label>
                                <div class="input-group">
                                    <input id="size" name="size" type="text" class="form-control" value="<?php echo e(Utility::GetCacheSize()); ?>" readonly="readonly">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            MB
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="<?php echo e(url('config-cache')); ?>" class="btn btn-print-invoice btn-primary m-r-10"><?php echo e(__('Clear Cache')); ?></a>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
        
        <div class="card" id="cookie">
            <?php echo e(Form::model($settings, ['route' => 'cookie.setting', 'method' => 'post'])); ?>

            <div class="card-header flex-column flex-lg-row  d-flex align-items-lg-center gap-2 justify-content-between">
                <h5><?php echo e(__('Cookie Settings')); ?></h5>
                <div class="d-flex align-items-center">
                    <?php echo e(Form::label('enable_cookie', __('Enable cookie'), ['class' => 'col-form-label p-0 fw-bold me-3'])); ?>

                    <div class="custom-control custom-switch" onclick="enablecookie()">

                        <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary" name="enable_cookie" class="form-check-input input-primary " id="enable_cookie" <?php echo e($settings['enable_cookie'] == 'on' ? ' checked ' : ''); ?>>
                        <label class="custom-control-label mb-1" for="enable_cookie"></label>
                    </div>
                </div>
            </div>
            <div class="card-body cookieDiv <?php echo e($settings['enable_cookie'] == 'off' ? 'disabledCookie ' : ''); ?>">
                <div class="row">
                    <?php if(!empty($settings['chatgpt_key'])): ?>
                    <div class="text-end">
                        <a href="#" data-size="md" class="btn btn-sm btn-primary" data-ajax-popup-over="true" data-size="md" data-title="<?php echo e(__('Generate content with AI')); ?>" data-url="<?php echo e(route('generate', ['account'])); ?>" data-toggle="tooltip" title="<?php echo e(__('Generate')); ?>">
                            <i class="fas fa-robot"></span><span class="robot"><?php echo e(__('Generate With AI')); ?></span></i>
                        </a>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-6">
                        <div class="form-check form-switch custom-switch-v1" id="cookie_log">
                            <input type="checkbox" name="cookie_logging" class="form-check-input tem input-primary cookie_setting str" id="cookie_logging" <?php echo e($settings['cookie_logging'] == 'on' ? ' checked ' : ''); ?>>
                            <label class="form-check-label" style="margin-left:5px" for="cookie_logging"><?php echo e(__('Enable logging')); ?></label>
                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('cookie_title', __('Cookie Title'), ['class' => 'col-form-label'])); ?>

                            <?php echo e(Form::text('cookie_title', null, ['class' => 'form-control cookie_setting'])); ?>

                        </div>
                        <div class="form-group ">
                            <?php echo e(Form::label('cookie_description', __('Cookie Description'), ['class' => ' form-label'])); ?>

                            <?php echo Form::textarea('cookie_description', null, ['class' => 'form-control cookie_setting', 'rows' => '3']); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check form-switch custom-switch-v1 ">
                            <input type="checkbox" name="necessary_cookies" class="form-check-input tem input-primary str" id="necessary_cookies" checked onclick="return false">
                            <label class="form-check-label" style="margin-left:5px" for="necessary_cookies"><?php echo e(__('Strictly necessary cookies')); ?></label>
                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('strictly_cookie_title', __(' Strictly Cookie Title'), ['class' => 'col-form-label'])); ?>

                            <?php echo e(Form::text('strictly_cookie_title', null, ['class' => 'form-control cookie_setting'])); ?>

                        </div>
                        <div class="form-group">
                            <?php echo e(Form::label('strictly_cookie_description', __('Strictly Cookie Description'), ['class' => ' form-label'])); ?>

                            <?php echo Form::textarea('strictly_cookie_description', null, [
                            'class' => 'form-control cookie_setting ',
                            'rows' => '3',
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-12">
                        <h5><?php echo e(__('More Information')); ?></h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <?php echo e(Form::label('more_information_description', __('Contact Us Description'), ['class' => 'col-form-label'])); ?>

                            <?php echo e(Form::text('more_information_description', null, ['class' => 'form-control cookie_setting'])); ?>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <?php echo e(Form::label('contactus_url', __('Contact Us URL'), ['class' => 'col-form-label'])); ?>

                            <?php echo e(Form::text('contactus_url', null, ['class' => 'form-control cookie_setting'])); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center gap-2 flex-sm-column flex-lg-row justify-content-between">
                <div>
                    <?php if(isset($settings['cookie_logging']) && $settings['cookie_logging'] == 'on'): ?>
                    <label for="file" class="form-label"><?php echo e(__('Download cookie accepted data')); ?></label>
                    <a href="<?php echo e(asset(Storage::url('uploads/sample')) . '/data.csv'); ?>" class="btn btn-primary mr-2 ">
                        <i class="ti ti-download"></i>
                    </a>
                    <?php endif; ?>
                </div>
                <input type="submit" value="<?php echo e(__(' Save Changes')); ?>" class="btn btn-primary">
            </div>
            <?php echo e(Form::close()); ?>

        </div>
        
        <?php if(\Auth::user()->type == 'super admin'): ?>
        <div class="card" id="pills-chatgpt-settings">
            <?php echo e(Form::model($settings, ['route' => 'settings.chatgptkey', 'method' => 'post'])); ?>

            <div class="card-header">
                <h5><?php echo e(__('Chat GPT Key Settings')); ?></h5>
                <small><?php echo e(__('Edit your key details')); ?></small>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group">
                        <?php echo e(Form::text('chatgpt_key', isset($settings['chatgpt_key']) ? $settings['chatgpt_key'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Chatgpt Key Here')])); ?>

                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button class="btn btn-primary" type="submit"><?php echo e(__('Save Changes')); ?></button>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
        <?php endif; ?>

    </div>
    <?php endif; ?>
    <?php if(\Auth::user()->type == 'owner'): ?>
    <!-- <div id="site-settings" class="card">
        <div class="card-header">
            <h5><?php echo e(__('Site Settings')); ?></h5>
            <small class="text-muted"><?php echo e(__('Edit your site details')); ?></small>
        </div>
        <div class="card-body">
            <?php echo e(Form::model($settings, ['route' => 'business.setting', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="small-title"><?php echo e(__('Dark Logo')); ?></h5>
                        </div>
                        <div class="card-body setting-card setting-logo-box p-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="logo-content logo-set-bg py-2" style="height:65px">
                                        
                                        <a href="<?php echo e($logo . '/' . (isset($dark_logo) && !empty($dark_logo) ? $dark_logo : 'logo-dark.png' . '?' . time())); ?>"
                                            target="_blank" style="height: 50px; width:150px;">
                                            <img id="blah" alt="your image"
                                                src="<?php echo e($logo . '/' . (isset($dark_logo) && !empty($dark_logo) ? $dark_logo : 'logo-dark.png' . '?' . time())); ?>"
                                                style="height: 50px; width:150px;">
                                        </a>

                                    </div>
                                </div>
                                <div class="col-12">

                                    <div class="choose-files mt-5">
                                        <label for="company_logo_dark">
                                            <div class=" bg-primary"> <i
                                                    class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                            </div>
                                            <input type="file"name="company_logo_dark"
                                                id="company_logo_dark" class="form-control file"
                                                data-filename="company_logo_update"
                                                onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">

                                            
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="small-title"><?php echo e(__('Light Logo')); ?></h5>
                        </div>
                        <div class="card-body setting-card setting-logo-box p-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="logo-content logo-set-bg py-2" style="height:65px">
                                        <a href="<?php echo e($logo . '/' . (isset($light_logo) && !empty($light_logo) ? $light_logo : 'logo-light.png' . '?' . time())); ?>"
                                            target="_blank" style="height: 50px; width:150px;">
                                            <img id="blah1" alt="your image"
                                                src="<?php echo e($logo . '/' . (isset($light_logo) && !empty($light_logo) ? $light_logo : 'logo-light.png' . '?' . time())); ?>"
                                                style="height: 50px; width:150px;" class="img_setting">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="choose-files mt-5">
                                        <label for="company_logo_light">
                                            <div class=" bg-primary"> <i
                                                    class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                            </div>
                                            <input type="file"name="company_logo_light"
                                                id="company_logo_light" class="form-control file"
                                                data-filename="company_logo_update"
                                                onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])">

                                            
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="small-title"><?php echo e(__('Favicon')); ?></h5>
                        </div>
                        <div class="card-body setting-card setting-logo-box p-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="logo-content logo-set-bg py-2" style="height:65px">
                                        <a href="<?php echo e($logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png' . '?' . time())); ?>"
                                            target="_blank">
                                            <img id="blah2" alt="your image"
                                                src="<?php echo e($logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png' . '?' . time())); ?>"
                                                width="50px" class="img_setting">
                                        </a>

                                    </div>
                                </div>
                                <div class="col-12">

                                    <div class="choose-files mt-5">
                                        <label for="company_favicon">
                                            <div class=" bg-primary"> <i
                                                    class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                            </div>
                                            <input type="file"name="company_favicon"
                                                id="company_favicon" class="form-control file"
                                                data-filename="company_logo_update"
                                                onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">

                                            
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="row">
                    <div class="form-group col-md-3">
                        <?php echo e(Form::label('title_text', __('Title Text'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::text('title_text', null, ['class' => 'form-control', 'placeholder' => __('Title Text')])); ?>

                        <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-title_text" role="alert">
                                <strong class="text-danger"><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label"><?php echo e(__('Application URL')); ?></label>
                            <?php echo e(Form::text('currency', URL::to('/'), ['class' => 'form-control', 'placeholder' => __('Enter Currency'), 'disabled' => 'true'])); ?>

                            <small><?php echo e(__('Application URL to log into the app')); ?></small>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="col switch-width">
                            <div class="form-group ml-2 mr-3 ">
                                <?php echo e(Form::label('SITE_RTL', __('Enable RTL'), ['class' => 'form-label'])); ?>

                                <div class="custom-control custom-switch">
                                    <input type="checkbox" data-toggle="switchbutton"
                                        data-onstyle="primary" class="" name="SITE_RTL"
                                        id="SITE_RTL"<?php echo e($settings['SITE_RTL'] == 'on' ? 'checked="checked"' : ''); ?>>
                                    <label class="custom-control-label" for="SITE_RTL"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <?php echo e(Form::label('default_owner_language', __('Default Language'), ['class' => 'form-label'])); ?>

                        <div class="changeLanguage">
                            <select name="default_owner_language" id="default_owner_language"
                                class="form-control custom-select">
                                <?php $__currentLoopData = \App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if($lang == $code): ?> selected <?php endif; ?>
                                        value="<?php echo e($code); ?>"><?php echo e(ucfirst($language)); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <h4 class="small-title"><?php echo e(__('Theme Customizer')); ?></h4>
                    <div class="setting-card setting-logo-box p-3">
                        <div class="row">
                            <div class="pct-body">
                                <div class="row">
                                    <div class="col-lg-4 col-xl-4 col-md-4">
                                        <h6>
                                            <i data-feather="credit-card"
                                                class="me-2"></i><?php echo e(__('Primary color settings')); ?>

                                        </h6>
                                        <hr class="my-2" />
                                        <div class="theme-color themes-color">
                                            <a href="#!"
                                                class="<?php echo e($settings['color'] == 'theme-1' ? 'active_color' : ''); ?>"
                                                data-value="theme-1"
                                                onclick="check_theme('theme-1')"></a>
                                            <input type="radio" class="theme_color" name="color"
                                                value="theme-1" style="display: none;">
                                            <a href="#!"
                                                class="<?php echo e($settings['color'] == 'theme-2' ? 'active_color' : ''); ?> "
                                                data-value="theme-2"
                                                onclick="check_theme('theme-2')"></a>
                                            <input type="radio" class="theme_color" name="color"
                                                value="theme-2" style="display: none;">
                                            <a href="#!"
                                                class="<?php echo e($settings['color'] == 'theme-3' ? 'active_color' : ''); ?>"
                                                data-value="theme-3"
                                                onclick="check_theme('theme-3')"></a>
                                            <input type="radio" class="theme_color" name="color"
                                                value="theme-3" style="display: none;">
                                            <a href="#!"
                                                class="<?php echo e($settings['color'] == 'theme-4' ? 'active_color' : ''); ?>"
                                                data-value="theme-4"
                                                onclick="check_theme('theme-4')"></a>
                                            <input type="radio" class="theme_color" name="color"
                                                value="theme-4" style="display: none;">
                                            <a href="#!"
                                                class="<?php echo e($settings['color'] == 'theme-5' ? 'active_color' : ''); ?>"
                                                data-value="theme-5"
                                                onclick="check_theme('theme-5')"></a>
                                            <input type="radio" class="theme_color" name="color"
                                                value="theme-5" style="display: none;">
                                            <br>
                                            <a href="#!"
                                                class="<?php echo e($settings['color'] == 'theme-6' ? 'active_color' : ''); ?>"
                                                data-value="theme-6"
                                                onclick="check_theme('theme-6')"></a>
                                            <input type="radio" class="theme_color" name="color"
                                                value="theme-6" style="display: none;">
                                            <a href="#!"
                                                class="<?php echo e($settings['color'] == 'theme-7' ? 'active_color' : ''); ?>"
                                                data-value="theme-7"
                                                onclick="check_theme('theme-7')"></a>
                                            <input type="radio" class="theme_color" name="color"
                                                value="theme-7" style="display: none;">
                                            <a href="#!"
                                                class="<?php echo e($settings['color'] == 'theme-8' ? 'active_color' : ''); ?>"
                                                data-value="theme-8"
                                                onclick="check_theme('theme-8')"></a>
                                            <input type="radio" class="theme_color" name="color"
                                                value="theme-8" style="display: none;">
                                            <a href="#!"
                                                class="<?php echo e($settings['color'] == 'theme-9' ? 'active_color' : ''); ?>"
                                                data-value="theme-9"
                                                onclick="check_theme('theme-9')"></a>
                                            <input type="radio" class="theme_color" name="color"
                                                value="theme-9" style="display: none;">
                                            <a href="#!"
                                                class="<?php echo e($settings['color'] == 'theme-10' ? 'active_color' : ''); ?>"
                                                data-value="theme-10"
                                                onclick="check_theme('theme-10')"></a>
                                            <input type="radio" class="theme_color" name="color"
                                                value="theme-10" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <h6>
                                            <i data-feather="layout"
                                                class="me-2"></i><?php echo e(__('Sidebar Settings')); ?>

                                        </h6>
                                        <hr class="my-2" />
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input"
                                                id="cust-theme-bg" name="cust_theme_bg"
                                                <?php echo e(Utility::getValByName('cust_theme_bg') == 'on' ? 'checked' : ''); ?> />
                                            <label class="form-check-label f-w-600 pl-1"
                                                for="cust-theme-bg"><?php echo e(__('Transparent layout')); ?></label>

                                            
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <h6>
                                            <i data-feather="sun"
                                                class=""></i><?php echo e(__('Layout settings')); ?>

                                        </h6>
                                        <hr class=" my-2 " />
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input"
                                                id="cust-darklayout" name="cust_darklayout"
                                                <?php echo e(Utility::getValByName('cust_darklayout') == 'on' ? 'checked' : ''); ?> />
                                            <label class="form-check-label f-w-600 pl-1"
                                                for="cust-darklayout"><?php echo e(__('Dark Layout')); ?></label>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn-submit btn btn-primary'])); ?>

            </div>


            <?php echo e(Form::close()); ?>

        </div>
    </div>  -->

    <!-- <div id="company-settings" class="card">
            <div class="card-header">
                <h5><?php echo e(__('Company Settings')); ?></h5>
                <small class="text-muted"><?php echo e(__('Edit your company details')); ?></small>
            </div>
            <div class="card-body">
                <?php echo e(Form::model($settings, ['route' => 'company.setting', 'method' => 'post'])); ?>

                <div class="row mt-3">
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('company_name *', __('Company Name *'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::text('company_name', null, ['class' => 'form-control font-style', 'placeholder' => 'Company Name'])); ?>

                        <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-company_name" role="alert">
                                <strong class="text-danger"><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('company_address', __('Address'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::text('company_address', null, ['class' => 'form-control font-style', 'placeholder' => 'Company Address'])); ?>

                        <?php $__errorArgs = ['company_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-company_address" role="alert">
                                <strong class="text-danger"><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('company_city', __('City'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::text('company_city', null, ['class' => 'form-control font-style', 'placeholder' => 'City'])); ?>

                        <?php $__errorArgs = ['company_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-company_city" role="alert">
                                <strong class="text-danger"><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('company_state', __('State'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::text('company_state', null, ['class' => 'form-control font-style', 'placeholder' => 'State'])); ?>

                        <?php $__errorArgs = ['company_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-company_state" role="alert">
                                <strong class="text-danger"><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('company_zipcode', __('Zip/Post Code'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::text('company_zipcode', null, ['class' => 'form-control', 'placeholder' => 'Zipcode'])); ?>

                        <?php $__errorArgs = ['company_zipcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-company_zipcode" role="alert">
                                <strong class="text-danger"><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group  col-md-6">
                        <?php echo e(Form::label('company_country', __('Country'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::text('company_country', null, ['class' => 'form-control font-style', 'placeholder' => 'Country'])); ?>

                        <?php $__errorArgs = ['company_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-company_country" role="alert">
                                <strong class="text-danger"><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('company_telephone', __('Telephone'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::text('company_telephone', null, ['class' => 'form-control', 'placeholder' => 'Telephone'])); ?>

                        <?php $__errorArgs = ['company_telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-company_telephone" role="alert">
                                <strong class="text-danger"><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    


                    <div class="text-end">
                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn-submit btn btn-primary'])); ?>

                    </div>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
    </div> -->

    <div id="company-email-setting" class="card">
        <div class="card-header">
            <h5><?php echo e(__('Email Settings')); ?></h5>
            <small class="text-muted"><?php echo e(__('Edit your email details')); ?></small>
        </div>
        <?php echo e(Form::open(['route' => 'email.setting', 'method' => 'post'])); ?>

        <div class="card-body">
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mail_driver" class="col-form-label text-dark"><?php echo e(__('Mail Driver')); ?></label>
                        <input type="text" name="mail_driver" id="mail_driver" class="form-control <?php echo e($errors->has('mail_driver') ? 'is-invalid' : ''); ?>" value="<?php echo e(!isset($settings['mail_driver']) || is_null($settings['mail_driver']) ? '' : $settings['mail_driver']); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_driver_placeholder')); ?>" />
                        <?php if($errors->has('mail_driver')): ?>
                        <span class="invalid-feedback text-danger text-xs">
                            <?php echo e($errors->first('mail_driver')); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mail_host" class="col-form-label text-dark"><?php echo e(__('Mail Host')); ?></label>
                        <input type="text" name="mail_host" id="mail_host" class="form-control <?php echo e($errors->has('mail_host') ? 'is-invalid' : ''); ?>" value="<?php echo e(!isset($settings['mail_host']) || is_null($settings['mail_host']) ? '' : $settings['mail_host']); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_host_placeholder')); ?>" />
                        <?php if($errors->has('mail_host')): ?>
                        <span class="invalid-feedback text-danger text-xs">
                            <?php echo e($errors->first('mail_host')); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mail_port" class="col-form-label text-dark"><?php echo e(__('Mail Port')); ?></label>
                        <input type="number" name="mail_port" id="mail_port" class="form-control <?php echo e($errors->has('mail_port') ? 'is-invalid' : ''); ?>" value="<?php echo e(!isset($settings['mail_port']) || is_null($settings['mail_port']) ? '' : $settings['mail_port']); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_port_placeholder')); ?>" />
                        <?php if($errors->has('mail_port')): ?>
                        <span class="invalid-feedback text-danger text-xs">
                            <?php echo e($errors->first('mail_port')); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mail_username" class="col-form-label text-dark"><?php echo e(__('Mail Username')); ?></label>
                        <input type="text" name="mail_username" id="mail_username" class="form-control <?php echo e($errors->has('mail_username') ? 'is-invalid' : ''); ?>" value="<?php echo e(!isset($settings['mail_username']) || is_null($settings['mail_username']) ? '' : $settings['mail_username']); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_username_placeholder')); ?>" />
                        <?php if($errors->has('mail_username')): ?>
                        <span class="invalid-feedback text-danger text-xs">
                            <?php echo e($errors->first('mail_username')); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mail_password" class="col-form-label text-dark"><?php echo e(__('Mail Password')); ?></label>
                        <input type="text" name="mail_password" id="mail_password" class="form-control <?php echo e($errors->has('mail_password') ? 'is-invalid' : ''); ?>" value="<?php echo e(!isset($settings['mail_password']) || is_null($settings['mail_password']) ? '' : $settings['mail_password']); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_password_placeholder')); ?>" />
                        <?php if($errors->has('mail_password')): ?>
                        <span class="invalid-feedback text-danger text-xs">
                            <?php echo e($errors->first('mail_password')); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mail_encryption" class="col-form-label text-dark"><?php echo e(__('Mail Encryption')); ?></label>
                        <input type="text" name="mail_encryption" id="mail_encryption" class="form-control <?php echo e($errors->has('mail_encryption') ? 'is-invalid' : ''); ?>" value="<?php echo e(!isset($settings['mail_encryption']) || is_null($settings['mail_encryption']) ? '' : $settings['mail_encryption']); ?>" placeholder="<?php echo e(trans('installer_messages.environment.wizard.form.app_tabs.mail_encryption_placeholder')); ?>" />
                        <?php if($errors->has('mail_encryption')): ?>
                        <span class="invalid-feedback text-danger text-xs">
                            <?php echo e($errors->first('mail_encryption')); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mail_from_address" class="col-form-label text-dark"><?php echo e(__('Mail From Address')); ?></label>
                        <input type="text" name="mail_from_address" id="mail_from_address" class="form-control <?php echo e($errors->has('mail_from_address') ? 'is-invalid' : ''); ?>" value="<?php echo e(!isset($settings['mail_from_address']) || is_null($settings['mail_from_address']) ? '' : $settings['mail_from_address']); ?>" placeholder="<?php echo e(__('Enter Mail From Address')); ?>" />
                        <?php if($errors->has('mail_from_address')): ?>
                        <span class="invalid-feedback text-danger text-xs">
                            <?php echo e($errors->first('mail_from_address')); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mail_from_name" class="col-form-label text-dark"><?php echo e(__('Mail From Name')); ?></label>
                        <input type="text" name="mail_from_name" id="mail_from_name" class="form-control <?php echo e($errors->has('mail_from_name') ? 'is-invalid' : ''); ?>" value="<?php echo e(!isset($settings['mail_from_name']) || is_null($settings['mail_from_name']) ? '' : $settings['mail_from_name']); ?>" placeholder="<?php echo e(__('Enter Mail From Name')); ?>" />
                        <?php if($errors->has('mail_from_name')): ?>
                        <span class="invalid-feedback text-danger text-xs">
                            <?php echo e($errors->first('mail_from_name')); ?>

                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="footer-row justify-content-end felx-wrap d-flex">
                    <!-- <a href="#" class="btn btn-print-invoice  btn-primary m-r-10 send_email mb-2"
                                        data-ajax-popup="true" data-title="<?php echo e(__('Send Test Mail')); ?>"
                                        data-url="<?php echo e(route('test.mail')); ?>">
                                        <?php echo e(__('Send Test Mail')); ?>

                                    </a> -->
                    <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-print-invoice  btn-primary m-r-10 mb-2">
                </div>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>

    <!--<div id="system-settings" class="card">
        <div class="card-header">
            <h5><?php echo e(__('System Settings')); ?></h5>
            <small class="text-muted"><?php echo e(__('Edit your system details')); ?></small>
        </div>

        <?php echo e(Form::model($settings, ['route' => 'system.setting', 'method' => 'post'])); ?>

        <div class="card-body">
            <div class="row mt-3">
                <div class="form-group col-md-6">
                    <?php echo e(Form::label('site_currency', __('Currency *'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('site_currency', null, ['class' => 'form-control font-style'])); ?>

                    <?php $__errorArgs = ['site_currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-site_currency" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group col-md-6">
                    <?php echo e(Form::label('site_currency_symbol', __('Currency Symbol *'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('site_currency_symbol', null, ['class' => 'form-control'])); ?>

                    <?php $__errorArgs = ['site_currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-site_currency_symbol" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label"
                            for="example3cols3Input"><?php echo e(__('Currency Symbol Position')); ?></label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" id="flexRadioDefault2"
                                        name="site_currency_symbol_position" value="pre"
                                        class="form-check-input"
                                        <?php if(@$settings['site_currency_symbol_position'] == 'pre'): ?> checked <?php endif; ?>>
                                    <label class="form-check-label"
                                        for="flexRadioDefault2"><?php echo e(__('Pre')); ?></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" id="customRadio6"
                                        name="site_currency_symbol_position" value="post"
                                        class="form-check-input"
                                        <?php if(@$settings['site_currency_symbol_position'] == 'post'): ?> checked <?php endif; ?>>
                                    <label class="form-check-label"
                                        for="customRadio6"><?php echo e(__('Post')); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="site_date_format" class="form-label"><?php echo e(__('Date Format')); ?></label>
                    <select type="text" name="site_date_format" class="form-control selectric"
                        id="site_date_format">
                        <option value="M j, Y"
                            <?php if(@$settings['site_date_format'] == 'M j, Y'): ?> selected="selected" <?php endif; ?>>Jan 1,2015
                        </option>
                        <option value="d-m-Y"
                            <?php if(@$settings['site_date_format'] == 'd-m-Y'): ?> selected="selected" <?php endif; ?>>dd-mm-yyyy
                        </option>
                        <option value="m-d-Y"
                            <?php if(@$settings['site_date_format'] == 'm-d-Y'): ?> selected="selected" <?php endif; ?>>mm-dd-yyyy
                        </option>
                        <option value="Y-m-d"
                            <?php if(@$settings['site_date_format'] == 'Y-m-d'): ?> selected="selected" <?php endif; ?>>yyyy-mm-dd
                        </option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="site_time_format" class="form-label"><?php echo e(__('Time Format')); ?></label>
                    <select type="text" name="site_time_format" class="form-control selectric"
                        id="site_time_format">
                        <option value="g:i A"
                            <?php if(@$settings['site_time_format'] == 'g:i A'): ?> selected="selected" <?php endif; ?>>10:30 PM
                        </option>
                        <option value="g:i a"
                            <?php if(@$settings['site_time_format'] == 'g:i a'): ?> selected="selected" <?php endif; ?>>10:30 pm
                        </option>
                        <option value="H:i"
                            <?php if(@$settings['site_time_format'] == 'H:i'): ?> selected="selected" <?php endif; ?>>22:30
                        </option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <?php echo e(Form::label('quote_prefix', __('Quote Prefix'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('quote_prefix', null, ['class' => 'form-control'])); ?>

                    <?php $__errorArgs = ['quote_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-quote_prefix" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group col-md-6">
                    <?php echo e(Form::label('salesorder_prefix', __('Sales Order Prefix'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('salesorder_prefix', null, ['class' => 'form-control'])); ?>

                    <?php $__errorArgs = ['salesorder_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-salesorder_prefix" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group col-md-6">
                    <?php echo e(Form::label('invoice_prefix', __('Invoice Prefix'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('invoice_prefix', null, ['class' => 'form-control', 'placefolder' => 'Invoice Prefix'])); ?>

                    <?php $__errorArgs = ['invoice_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-invoice_prefix" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group col-md-6">
                    <?php echo e(Form::label('footer_title', __('Quote/Sales Order/Invoice Footer Title'), ['class' => 'form-label', 'placefolder' => 'Footer Title'])); ?>

                    <?php echo e(Form::text('footer_title', null, ['class' => 'form-control'])); ?>

                    <?php $__errorArgs = ['footer_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-footer_title" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group col-md-6">
                    <?php echo e(Form::label('shipping_display', __('Quote / Invoice / Sales-Order Shipping Display'), ['class' => 'form-label'])); ?>

                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="shipping_display" data-toggle="switchbutton"
                            class="custom-control-input" id="shipping_display"
                            <?php echo e($settings['shipping_display'] == 'on' ? 'checked="checked"' : ''); ?>

                            placeholder="Invoice Footer Title">
                        <label name="shipping_display" class="custom-control-label "
                            for="shipping_display"></label>
                    </div>
                    <?php $__errorArgs = ['shipping_display'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-shipping_display" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group col-md-12">
                    <?php echo e(Form::label('footer_notes', __('Quote/SalesOrder/Invoice Footer Notes'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::textarea('footer_notes', null, ['class' => 'form-control', 'rows' => '3'])); ?>

                    <?php $__errorArgs = ['footer_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="invalid-footer_notes" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn-submit btn btn-primary'])); ?>

        </div>
        <?php echo e(Form::close()); ?>

    </div> -->

    <!--<div id="quote-settings" class="card">
        <div class="card-header">
            <h5><?php echo e(__('Quote Settings')); ?></h5>
            <small class="text-muted"><?php echo e(__('')); ?></small>
        </div>
        <div class="card-body p-3">
            <form id="setting-form" method="post" action="<?php echo e(route('quote.template.setting')); ?>"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row ">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label"for="address"><?php echo e(__('Quote Template')); ?></label>
                            <select class="form-control" name="quote_template">
                                <?php $__currentLoopData = \App\Models\Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"
                                        <?php echo e(isset($settings['quote_template']) && $settings['quote_template'] == $key ? 'selected' : ''); ?>>
                                        <?php echo e($template); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><?php echo e(__('Color Input')); ?></label>
                            <div class="row gutters-xs">
                                <?php $__currentLoopData = \App\Models\Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-auto">
                                        <label class="colorinput">
                                            <input name="quote_color" type="radio"
                                                value="<?php echo e($color); ?>" class="colorinput-input"
                                                <?php echo e(isset($settings['quote_color']) && $settings['quote_color'] == $color ? 'checked' : ''); ?>>
                                            <span class="colorinput-color"
                                                style="background:#<?php echo e($color); ?>"></span>
                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"><?php echo e(__('Quote Logo')); ?></label>
                            <div class="choose-files ">
                                <label for="quote_logo">
                                    <div class=" bg-primary quote_logo_update"> <i
                                            class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                    </div>
                                    
                                    <img id="blah1452" class="mt-3" src=""
                                        width="70%" />
                                    <input type="file" class="form-control file " name="quote_logo"
                                        id="quote_logo" data-filename="quote_logo_update"
                                        onchange="document.getElementById('blah1452').src = window.URL.createObjectURL(this.files[0])">
                                </label>
                            </div>
                        </div>
                        <div clas="form-group">
                            <input type="submit" value="Save Changes"
                                class="btn btn-print-invoice  btn-primary m-r-10 float-end">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <?php if(isset($settings['quote_template']) && isset($settings['quote_color'])): ?>
                            <iframe id="quote_frame" class="w-100 h-100" frameborder="0"
                                src="<?php echo e(route('quote.preview', [$settings['quote_template'], $settings['quote_color']])); ?>"></iframe>
                        <?php else: ?>
                            <iframe id="quote_frame" class="w-100 h-100" frameborder="0"
                                src="<?php echo e(route('quote.preview', ['template1', 'fffff'])); ?>"></iframe>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div> -->

    <!-- <div id="invoice-settings" class="card">
        <div class="card-header">
            <h5><?php echo e(__('Invoice Settings')); ?></h5>
            <small class="text-muted"><?php echo e(__('')); ?></small>
        </div>
        <div class="card-body">
            <form id="setting-form" method="post" action="<?php echo e(route('invoice.template.setting')); ?>"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label"for="address"><?php echo e(__('Invoice Template')); ?></label>
                            <select class="form-control" name="invoice_template">
                                <?php $__currentLoopData = \App\Models\Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"
                                        <?php echo e(isset($settings['invoice_template']) && $settings['invoice_template'] == $key ? 'selected' : ''); ?>>
                                        <?php echo e($template); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><?php echo e(__('Color Input')); ?></label>
                            <div class="row gutters-xs">
                                <?php $__currentLoopData = \App\Models\Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-auto">
                                        <label class="colorinput">
                                            <input name="invoice_color" type="radio"
                                                value="<?php echo e($color); ?>" class="colorinput-input"
                                                <?php echo e(isset($settings['invoice_color']) && $settings['invoice_color'] == $color ? 'checked' : ''); ?>>
                                            <span class="colorinput-color"
                                                style="background:#<?php echo e($color); ?>"></span>
                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"><?php echo e(__('Invoice Logo')); ?></label>
                            <div class="choose-files ">
                                <label for="invoice_logo">
                                    <div class=" bg-primary invoice_logo_update"> <i
                                            class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                    </div>
                                    
                                    <img id="blah1454" class="mt-3" src=""
                                        width="70%" />
                                    <input type="file" class="form-control file"
                                        name="invoice_logo" id="invoice_logo"
                                        data-filename="invoice_logo_update"
                                        onchange="document.getElementById('blah1454').src = window.URL.createObjectURL(this.files[0])">
                                </label>
                            </div>
                        </div>
                        <div clas="form-group">
                            <input type="submit" value="Save Changes"
                                class="btn btn-print-invoice  btn-primary m-r-10 float-end">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <?php if(isset($settings['invoice_template']) && isset($settings['invoice_color'])): ?>
                            <iframe id="invoice_frame" class="w-100 h-100" frameborder="0"
                                src="<?php echo e(route('invoice.preview', [$settings['invoice_template'], $settings['invoice_color']])); ?>"></iframe>
                        <?php else: ?>
                            <iframe id="invoice_frame" class="w-100 h-100" frameborder="0"
                                src="<?php echo e(route('invoice.preview', ['template1', 'fffff'])); ?>"></iframe>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div> -->

    <!-- <div id="sales-order-settings" class="card">
        <div class="card-header">
            <h5><?php echo e(__('Sales Order Settings')); ?></h5>
            <small class="text-muted"><?php echo e(__('')); ?></small>
        </div>
        <div class="card-body">
            <form id="setting-form" method="post"
                action="<?php echo e(route('salesorder.template.setting')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label
                                class="form-label"for="address"><?php echo e(__('Sales Order Template')); ?></label>
                            <select class="form-control" name="salesorder_template">
                                <?php $__currentLoopData = \App\Models\Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>"
                                        <?php echo e(isset($settings['salesorder_template']) && $settings['salesorder_template'] == $key ? 'selected' : ''); ?>>
                                        <?php echo e($template); ?> </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label"><?php echo e(__('Color Input')); ?></label>
                            <div class="row gutters-xs">
                                <?php $__currentLoopData = \App\Models\Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-auto">
                                        <label class="colorinput">
                                            <input name="salesorder_color" type="radio"
                                                value="<?php echo e($color); ?>" class="colorinput-input"
                                                <?php echo e(isset($settings['salesorder_color']) && $settings['salesorder_color'] == $color ? 'checked' : ''); ?>>
                                            <span class="colorinput-color"
                                                style="background: #<?php echo e($color); ?>"></span>
                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"><?php echo e(__('Sales Order Logo')); ?></label>
                            <div class="choose-files ">
                                <label for="salesorder_logo">
                                    <div class=" bg-primary salesorder_logo_update"> <i
                                            class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                    </div>
                                    

                                    <img id="blah1453" class="mt-3" src=""
                                        width="70%" />
                                    <input type="file" class="form-control file"
                                        name="salesorder_logo" id="salesorder_logo"
                                        data-filename="salesorder_logo_update"
                                        onchange="document.getElementById('blah1453').src = window.URL.createObjectURL(this.files[0])">
                                </label>
                            </div>
                        </div>
                        <div clas="form-group">
                            <input type="submit" value="Save Changes"
                                class="btn btn-print-invoice btn-primary m-r-10 float-end">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <?php if(isset($settings['salesorder_template']) && isset($settings['salesorder_color'])): ?>
                            <iframe id="salesorder_frame" class="w-100 h-100" frameborder="0"
                                src="<?php echo e(route('salesorder.preview', [$settings['salesorder_template'], $settings['salesorder_color']])); ?>"></iframe>
                        <?php else: ?>
                            <iframe id="salesorder_frame" class="w-100 h-100" frameborder="0"
                                src="<?php echo e(route('salesorder.preview', ['template1', 'fffff'])); ?>"></iframe>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div> -->

    <!-- <div id="payment-settings" class="card">
        <div class="card-header">
            <h5><?php echo e(__('Payment Settings')); ?></h5>
            <small
                class="text-muted"><?php echo e(__('These details will be used to collect invoice payments. Each invoice will have a payment button based on the below configuration')); ?></small>
        </div>
        <?php echo e(Form::model($settings, ['route' => 'payment.setting', 'method' => 'POST'])); ?>

        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                            <label class="col-form-label"><?php echo e(__('Currency')); ?> *</label>
                            <input type="text" name="currency" class="form-control"
                                id="currency"
                                value="<?php echo e(!isset($payment['currency']) || is_null($payment['currency']) ? '' : $payment['currency']); ?>"
                                placeholder="USD" required>
                            <small class="text-xs">
                                <?php echo e(__('Note: Add currency code as per three-letter ISO code.')); ?>.
                                <a href="https://stripe.com/docs/currencies"
                                    target="_blank"><?php echo e(__('You can find out how to do that here.')); ?></a>
                            </small>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 form-group">
                            <label for="currency_symbol"
                                class="col-form-label"><?php echo e(__('Currency Symbol')); ?></label>
                            <input type="text" name="currency_symbol" class="form-control"
                                id="currency_symbol"
                                value="<?php echo e(!isset($payment['currency_symbol']) || is_null($payment['currency_symbol']) ? '' : $payment['currency_symbol']); ?>"
                                placeholder="$" required>
                        </div>

                    </div>
                </div>
            </div>
            <div class="faq justify-content-center">
                <div class="col-sm-12 col-md-10 col-xxl-12">
                    <div class="accordion accordion-flush setting setting-accordion1"
                        id="accordionExample">  -->

    
   <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-16">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse16"
                aria-expanded="false" aria-controls="collapse16">
                <span class="d-flex align-items-center">
                    
                    <?php echo e(__('Bank Transfer')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_bank_enabled" value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_bank_enabled" id="is_bank_enabled"
                        <?php echo e(isset($payment['is_bank_enabled']) && $payment['is_bank_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-1"></label>
                </div>
            </button>
        </h2>
        <div id="collapse16"
            class="accordion-collapse collapse"aria-labelledby="heading-2-16"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row gy-4">
                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <?php echo e(Form::label('bank_details', __('Bank Details'), ['class' => 'col-form-label'])); ?>

                            <?php echo e(Form::textarea('bank_details', isset($payment['bank_details']) ? $payment['bank_details'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Your Bank Details'), 'rows' => 4])); ?>

                            <small class="text-xs">
                                <?php echo e(__('Example : Bank : bank name </br> Account Number : 0000 0000 </br>')); ?>

                            </small>
                            <?php if($errors->has('bank_details')): ?>
                                <span class="invalid-feedback d-block">
                                    <?php echo e($errors->first('bank_details')); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  -->

    <!-- Strip -->
    <!-- <div class="accordion-item card">
            <h2 class="accordion-header" id="heading-2-2">
                <button class="accordion-button collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#collapse1"
                    aria-expanded="true" aria-controls="collapse1">
                    <span class="d-flex align-items-center">
                        
                        <?php echo e(__('Stripe')); ?>

                    </span>
                    <?php echo e(__('Enable:')); ?>

                    <div class="form-check form-switch custom-switch-v1">
                        <input type="hidden" name="is_stripe_enabled" value="off">
                        <input type="checkbox" class="form-check-input input-primary"
                            name="is_stripe_enabled" id="is_stripe_enabled"
                            <?php echo e(isset($payment['is_stripe_enabled']) && $payment['is_stripe_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                        <label class="form-check-label" for="customswitchv1-1"></label>
                    </div>
                </button>
            </h2>
            <div id="collapse1"
                class="accordion-collapse collapse"aria-labelledby="heading-2-2"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">


                    <div class="row">
                        
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="stripe_key"
                                    class="form-label"><?php echo e(__('Stripe Key')); ?></label>
                                <input class="form-control"
                                    placeholder="<?php echo e(__('Stripe Key')); ?>"
                                    name="stripe_key" type="text"
                                    value="<?php echo e(!isset($payment['stripe_key']) || is_null($payment['stripe_key']) ? '' : $payment['stripe_key']); ?>"
                                    id="stripe_key">
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="form-group">
                                <label for="stripe_secret"
                                    class="form-label"><?php echo e(__('Stripe Secret')); ?></label>
                                <input class="form-control "
                                    placeholder="<?php echo e(__('Stripe Secret')); ?>"
                                    name="stripe_secret" type="text"
                                    value="<?php echo e(!isset($payment['stripe_secret']) || is_null($payment['stripe_secret']) ? '' : $payment['stripe_secret']); ?>"
                                    id="stripe_secret">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
    </div> -->

    <!-- Paypal -->
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-3">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse2"
                aria-expanded="true" aria-controls="collapse2">
                <span class="d-flex align-items-center">
                    
                    <?php echo e(__('Paypal')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_paypal_enabled" value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        id="customswitchv1-2" name="is_paypal_enabled"
                        id="is_paypal_enabled"
                        <?php echo e(isset($payment['is_paypal_enabled']) && $payment['is_paypal_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>
        <div id="collapse2"
            class="accordion-collapse collapse"aria-labelledby="heading-2-3"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    
                    
                    
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                        <div class="row pt-2">
                            <label class="pb-2"
                                for="paypal_mode"><?php echo e(__('Paypal Mode')); ?></label>
                            <div class="col-lg-3">
                                <div class="border card p-3">
                                    <div class="form-check">
                                        <input type="radio"
                                            class="form-check-input input-primary "
                                            name="paypal_mode" value="sandbox"
                                            <?php echo e(!isset($payment['paypal_mode']) || $payment['paypal_mode'] == '' || $payment['paypal_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                        <label class="form-check-label d-block"
                                            for="">
                                            <span>
                                                <span class="h5 d-block"><strong
                                                        class="float-end"></strong><?php echo e(__('Sandbox')); ?></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="border card p-3">
                                    <div class="form-check">
                                        <input type="radio"
                                            class="form-check-input input-primary "
                                            name="paypal_mode" value="live"
                                            <?php echo e(isset($payment['paypal_mode']) && $payment['paypal_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                        <label class="form-check-label d-block"
                                            for="">
                                            <span>
                                                <span class="h5 d-block"><strong
                                                        class="float-end"></strong><?php echo e(__('Live')); ?></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paypal_client_id"
                                class="form-label"><?php echo e(__('Client ID')); ?></label>
                            <input type="text" name="paypal_client_id"
                                id="paypal_client_id" class="form-control"
                                value="<?php echo e(!isset($payment['paypal_client_id']) || is_null($payment['paypal_client_id']) ? '' : $payment['paypal_client_id']); ?>"
                                placeholder="<?php echo e(__('Client ID')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paypal_secret_key"
                                class="form-label"><?php echo e(__('Secret Key')); ?></label>
                            <input type="text" name="paypal_secret_key"
                                id="paypal_secret_key" class="form-control"
                                value="<?php echo e(!isset($payment['paypal_secret_key']) || is_null($payment['paypal_secret_key']) ? '' : $payment['paypal_secret_key']); ?>"
                                placeholder="<?php echo e(__('Secret Key')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Paystack -->
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-4">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse3"
                aria-expanded="true" aria-controls="collapse3">
                <span class="d-flex align-items-center">
                    
                    <?php echo e(__('Paystack')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_paystack_enabled"
                        value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        id="customswitchv1-2" name="is_paystack_enabled"
                        id="is_paystack_enabled"
                        <?php echo e(isset($payment['is_paystack_enabled']) && $payment['is_paystack_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>
        <div id="collapse3"
            class="accordion-collapse collapse"aria-labelledby="heading-2-4"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">


                <div class="row">
                    
                    
                    
                    
                    

                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="paypal_client_id"
                                class="form-label"><?php echo e(__(' Key')); ?></label>
                            <input type="text" name="paystack_public_key"
                                id="paystack_public_key" class="form-control"
                                value="<?php echo e(!isset($payment['paystack_public_key']) || is_null($payment['paystack_public_key']) ? '' : $payment['paystack_public_key']); ?>"
                                placeholder="<?php echo e(__(' Key')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="paystack_secret_key"
                                class="form-label"><?php echo e(__('Secret Key')); ?></label>
                            <input type="text" name="paystack_secret_key"
                                id="paystack_secret_key" class="form-control"
                                value="<?php echo e(!isset($payment['paystack_secret_key']) || is_null($payment['paystack_secret_key']) ? '' : $payment['paystack_secret_key']); ?>"
                                placeholder="<?php echo e(__('Secret Key')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- FLUTTERWAVE -->
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-5">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse4"
                aria-expanded="true" aria-controls="collapse4">
                <span class="d-flex align-items-center">
                    
                    <?php echo e(__('Flutterwave')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_flutterwave_enabled"
                        value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        id="customswitchv1-2" name="is_flutterwave_enabled"
                        id="is_flutterwave_enabled"
                        <?php echo e(isset($payment['is_flutterwave_enabled']) && $payment['is_flutterwave_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>
        <div id="collapse4"
            class="accordion-collapse collapse"aria-labelledby="heading-2-5"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">

                <div class="row">
                    
                    
                    

                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="paypal_client_id"
                                class="form-label"><?php echo e(__(' Key')); ?></label>
                            <input type="text" name="flutterwave_public_key"
                                id="flutterwave_public_key" class="form-control"
                                value="<?php echo e(!isset($payment['flutterwave_public_key']) || is_null($payment['flutterwave_public_key']) ? '' : $payment['flutterwave_public_key']); ?>"
                                placeholder="Public Key">
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="paystack_secret_key"
                                class="form-label"><?php echo e(__('Secret Key')); ?></label>
                            <input type="text" name="flutterwave_secret_key"
                                id="flutterwave_secret_key" class="form-control"
                                value="<?php echo e(!isset($payment['flutterwave_secret_key']) || is_null($payment['flutterwave_secret_key']) ? '' : $payment['flutterwave_secret_key']); ?>"
                                placeholder="Secret Key">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Razorpay -->
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-6">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse5"
                aria-expanded="true" aria-controls="collapse5">
                <span class="d-flex align-items-center">
                    
                    <?php echo e(__('Razorpay')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_razorpay_enabled"
                        value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        id="customswitchv1-2" name="is_razorpay_enabled"
                        id="is_razorpay_enabled"
                        <?php echo e(isset($payment['is_razorpay_enabled']) && $payment['is_razorpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>
        <div id="collapse5"
            class="accordion-collapse collapse"aria-labelledby="heading-2-6"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    
                    
                    

                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="paypal_client_id"
                                class="form-label"><?php echo e(__(' Key')); ?></label>

                            <input type="text" name="razorpay_public_key"
                                id="razorpay_public_key" class="form-control"
                                value="<?php echo e(!isset($payment['razorpay_public_key']) || is_null($payment['razorpay_public_key']) ? '' : $payment['razorpay_public_key']); ?>"
                                placeholder="Public Key">
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="paystack_secret_key"
                                class="form-label"><?php echo e(__('Secret Key')); ?></label>
                            <input type="text" name="razorpay_secret_key"
                                id="razorpay_secret_key" class="form-control"
                                value="<?php echo e(!isset($payment['razorpay_secret_key']) || is_null($payment['razorpay_secret_key']) ? '' : $payment['razorpay_secret_key']); ?>"
                                placeholder="Secret Key">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Paytm -->
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-7">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse6"
                aria-expanded="true" aria-controls="collapse6">
                <span class="d-flex align-items-center">
                    
                    <?php echo e(__('Paytm')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_paytm_enabled" value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_paytm_enabled" id="is_paytm_enabled"
                        <?php echo e(isset($payment['is_paytm_enabled']) && $payment['is_paytm_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>
        <div id="collapse6"
            class="accordion-collapse collapse"aria-labelledby="heading-2-7"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    
                    
                    

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                        <div class="row pt-2">
                            <label class="pb-2"
                                for="paypal_mode"><?php echo e(__('Paytm Environment')); ?></label>
                            <div class="col-lg-3">
                                <div class="border card p-3">
                                    <div class="form-check">
                                        <input type="radio"
                                            class="form-check-input input-primary "
                                            name="paytm_mode" value="local"
                                            <?php echo e(!isset($payment['paytm_mode']) || $payment['paytm_mode'] == '' || $payment['paytm_mode'] == 'local' ? 'checked="checked"' : ''); ?>>


                                        <label class="form-check-label d-block"
                                            for="">
                                            <span>
                                                <span class="h5 d-block"><strong
                                                        class="float-end"></strong><?php echo e(__('Local')); ?></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="border card p-3">
                                    <div class="form-check">
                                        <input type="radio"
                                            class="form-check-input input-primary"
                                            name="paytm_mode" value="production"
                                            <?php echo e(isset($payment['paytm_mode']) && $payment['paytm_mode'] == 'production' ? 'checked="checked"' : ''); ?>>
                                        <label class="form-check-label d-block"
                                            for="">
                                            <span>
                                                <span class="h5 d-block"><strong
                                                        class="float-end"></strong><?php echo e(__('Production')); ?></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paytm_public_key"
                                class="form-label"><?php echo e(__('Merchant ID')); ?></label>
                            <input type="text" name="paytm_merchant_id"
                                id="paytm_merchant_id" class="form-control"
                                value="<?php echo e(!isset($payment['paytm_merchant_id']) || is_null($payment['paytm_merchant_id']) ? '' : $payment['paytm_merchant_id']); ?>"
                                placeholder="Merchant ID">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paytm_secret_key"
                                class="form-label"><?php echo e(__('Merchant Key')); ?></label>
                            <input type="text" name="paytm_merchant_key"
                                id="paytm_merchant_key" class="form-control"
                                value="<?php echo e(!isset($payment['paytm_merchant_key']) || is_null($payment['paytm_merchant_key']) ? '' : $payment['paytm_merchant_key']); ?>"
                                placeholder="Merchant Key">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="paytm_industry_type"
                                class="form-label"><?php echo e(__('Industry Type')); ?></label>
                            <input type="text" name="paytm_industry_type"
                                id="paytm_industry_type" class="form-control"
                                value="<?php echo e(!isset($payment['paytm_industry_type']) || is_null($payment['paytm_industry_type']) ? '' : $payment['paytm_industry_type']); ?>"
                                placeholder="Industry Type">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Mercado Pago-->
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-8">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse7"
                aria-expanded="true" aria-controls="collapse7">
                <span class="d-flex align-items-center">
                    
                    <?php echo e(__('Mercado Pago')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_mercado_enabled"
                        value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_mercado_enabled" id="is_mercado_enabled"
                        <?php echo e(isset($payment['is_mercado_enabled']) && $payment['is_mercado_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>
        <div id="collapse7"
            class="accordion-collapse collapse"aria-labelledby="heading-2-8"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    
                    
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                        <div class="row pt-2">
                            <label class="pb-2"
                                for="paypal_mode"><?php echo e(__('Mercado Mode')); ?></label>
                            <div class="col-lg-3">
                                <div class="border card p-3">
                                    <div class="form-check">
                                        <input type="radio"
                                            class="form-check-input input-primary "
                                            name="mercado_mode" value="sandbox"
                                            <?php echo e((isset($payment['mercado_mode']) && $payment['mercado_mode'] == '') || (isset($payment['mercado_mode']) && $payment['mercado_mode'] == 'sandbox') ? 'checked="checked"' : ''); ?>>


                                        <label class="form-check-label d-block"
                                            for="">
                                            <span>
                                                <span class="h5 d-block"><strong
                                                        class="float-end"></strong><?php echo e(__('Sandbox')); ?></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="border card p-3">
                                    <div class="form-check">
                                        <input type="radio"
                                            class="form-check-input input-primary "
                                            name="mercado_mode" value="live"
                                            <?php echo e(isset($payment['mercado_mode']) && $payment['mercado_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                        <label class="form-check-label d-block"
                                            for="">
                                            <span>
                                                <span class="h5 d-block"><strong
                                                        class="float-end"></strong><?php echo e(__('Live')); ?></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mercado_access_token"
                                class="form-label"><?php echo e(__('Access Token')); ?></label>
                            <input type="text" name="mercado_access_token"
                                id="mercado_access_token" class="form-control"
                                value="<?php echo e(isset($payment['mercado_access_token']) ? $payment['mercado_access_token'] : ''); ?>" />
                            <?php if($errors->has('mercado_secret_key')): ?>
                                <span class="invalid-feedback d-block">
                                    <?php echo e($errors->first('mercado_access_token')); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Mollie -->
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-9">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse8"
                aria-expanded="true" aria-controls="collapse8">
                <span class="d-flex align-items-center">
                    
                    <?php echo e(__('Mollie')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_mollie_enabled" value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_mollie_enabled" id="is_mollie_enabled"
                        <?php echo e(isset($payment['is_mollie_enabled']) && $payment['is_mollie_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>
        <div id="collapse8"
            class="accordion-collapse collapse"aria-labelledby="heading-2-9"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    
                    
                    
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mollie_api_key"
                                    class="form-label"><?php echo e(__('Mollie Api Key')); ?></label>
                                <input type="text" name="mollie_api_key"
                                    id="mollie_api_key" class="form-control"
                                    value="<?php echo e(!isset($payment['mollie_api_key']) || is_null($payment['mollie_api_key']) ? '' : $payment['mollie_api_key']); ?>"
                                    placeholder="Mollie Api Key">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mollie_profile_id"
                                    class="form-label"><?php echo e(__('Mollie Profile Id')); ?></label>
                                <input type="text" name="mollie_profile_id"
                                    id="mollie_profile_id" class="form-control"
                                    value="<?php echo e(!isset($payment['mollie_profile_id']) || is_null($payment['mollie_profile_id']) ? '' : $payment['mollie_profile_id']); ?>"
                                    placeholder="Mollie Profile Id">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mollie_partner_id"
                                    class="form-label"><?php echo e(__('Mollie Partner Id')); ?></label>
                                <input type="text" name="mollie_partner_id"
                                    id="mollie_partner_id" class="form-control"
                                    value="<?php echo e(!isset($payment['mollie_partner_id']) || is_null($payment['mollie_partner_id']) ? '' : $payment['mollie_partner_id']); ?>"
                                    placeholder="Mollie Partner Id">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Skrill -->
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-10">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse9"
                aria-expanded="true" aria-controls="collapse9">
                <span class="d-flex align-items-center">
                    
                    <?php echo e(__('Skrill')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_skrill_enabled" value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_skrill_enabled" id="is_skrill_enabled"
                        <?php echo e(isset($payment['is_skrill_enabled']) && $payment['is_skrill_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>
        <div id="collapse9"
            class="accordion-collapse collapse"aria-labelledby="heading-2-10"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    
                    
                    
                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <label for="mollie_api_key"
                                class="form-label"><?php echo e(__('Skrill Email')); ?></label>
                            <input type="text" name="skrill_email"
                                id="skrill_email" class="form-control"
                                value="<?php echo e(!isset($payment['skrill_email']) || is_null($payment['skrill_email']) ? '' : $payment['skrill_email']); ?>"
                                placeholder="Enter Skrill Email">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- CoinGate -->
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-11">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse10"
                aria-expanded="true" aria-controls="collapse10">
                <span class="d-flex align-items-center">
                    
                    <?php echo e(__('CoinGate')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_coingate_enabled"
                        value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_coingate_enabled" id="is_coingate_enabled"
                        <?php echo e(isset($payment['is_coingate_enabled']) && $payment['is_coingate_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>
        <div id="collapse10"
            class="accordion-collapse collapse"aria-labelledby="heading-2-11"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    
                    
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                        <div class="row pt-2">
                            <label class="pb-2"
                                for="paypal_mode"><?php echo e(__('CoinGate Mode')); ?></label>
                            <div class="col-lg-3">
                                <div class="border card p-3">
                                    <div class="form-check">
                                        <input type="radio"
                                            class="form-check-input input-primary"
                                            name="coingate_mode" value="sandbox"
                                            <?php echo e(!isset($payment['coingate_mode']) || $payment['coingate_mode'] == '' || $payment['coingate_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>


                                        <label class="form-check-label d-block"
                                            for="">
                                            <span>
                                                <span class="h5 d-block"><strong
                                                        class="float-end"></strong><?php echo e(__('Sandbox')); ?></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="border card p-3">
                                    <div class="form-check">
                                        <input type="radio"
                                            class="form-check-input input-primary"
                                            name="coingate_mode" value="live"
                                            <?php echo e(isset($payment['coingate_mode']) && $payment['coingate_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                        <label class="form-check-label d-block"
                                            for="">
                                            <span>
                                                <span class="h5 d-block"><strong
                                                        class="float-end"></strong><?php echo e(__('Live')); ?></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="coingate_auth_token"
                                class="form-label"><?php echo e(__('CoinGate Auth Token')); ?></label>
                            <input type="text" name="coingate_auth_token"
                                id="coingate_auth_token" class="form-control"
                                value="<?php echo e(!isset($payment['coingate_auth_token']) || is_null($payment['coingate_auth_token']) ? '' : $payment['coingate_auth_token']); ?>"
                                placeholder="CoinGate Auth Token">
                        </div>
                        <?php if($errors->has('coingate_auth_token')): ?>
                            <span class="invalid-feedback d-block">
                                <?php echo e($errors->first('coingate_auth_token')); ?>

                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- PaymentWall -->
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-12">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse11"
                aria-expanded="true" aria-controls="collapse11">
                <span class="d-flex align-items-center">
                    
                    <?php echo e(__('PaymentWall')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_paymentwall_enabled"
                        value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_paymentwall_enabled" id="is_paymentwall_enabled"
                        <?php echo e(isset($payment['is_paymentwall_enabled']) && $payment['is_paymentwall_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>
        <div id="collapse11"
            class="accordion-collapse collapse"aria-labelledby="heading-2-12"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    
                    
                    

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paymentwall_public_key"
                                class="form-label"><?php echo e(__(' Key')); ?></label>
                            <input type="text" name="paymentwall_public_key"
                                id="paymentwall_public_key" class="form-control"
                                value="<?php echo e(!isset($payment['paymentwall_public_key']) || is_null($payment['paymentwall_public_key']) ? '' : $payment['paymentwall_public_key']); ?>"
                                placeholder="<?php echo e(__(' Key')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paymentwall_private_key"
                                class="form-label"><?php echo e(__('Private Key')); ?></label>
                            <input type="text" name="paymentwall_private_key"
                                id="paymentwall_private_key" class="form-control"
                                value="<?php echo e(!isset($payment['paymentwall_private_key']) || is_null($payment['paymentwall_private_key']) ? '' : $payment['paymentwall_private_key']); ?>"
                                placeholder="<?php echo e(__('Private Key')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-13">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse12"
                aria-expanded="true" aria-controls="collapse12">
                <span class="d-flex align-items-center">
                    
                    <?php echo e(__('Toyyibpay')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_toyyibpay_enabled"
                        value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_toyyibpay_enabled" id="is_toyyibpay_enabled"
                        <?php echo e(isset($payment['is_toyyibpay_enabled']) && $payment['is_toyyibpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label for="customswitch1-2" class="form-check-label"></label>
                </div>
            </button>
        </h2>
        <div id="collapse12"
            class="accordion-collapse collapse"aria-labelledby="heading-2-13"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="toyyibpay_secret_key"
                                class="form-label"><?php echo e(__('Secret Key')); ?></label>
                            <input type="text" name="toyyibpay_secret_key"
                                id="toyyibpay_secret_key" class="form-control"
                                value="<?php echo e(!isset($payment['toyyibpay_secret_key']) || is_null($payment['toyyibpay_secret_key']) ? '' : $payment['toyyibpay_secret_key']); ?>"
                                placeholder="<?php echo e(__('Secret Key')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_code"
                                class="form-label"><?php echo e(__('Category Code')); ?></label>
                            <input type="text" name="category_code"
                                id="category_code" class="form-control"
                                value="<?php echo e(!isset($payment['category_code']) || is_null($payment['category_code']) ? '' : $payment['category_code']); ?>"
                                placeholder="<?php echo e(__('Category Code')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-14">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse14"
                aria-expanded="true" aria-controls="collapse14">
                <span class="d-flex align-items-center">
                    
                    <?php echo e(__('Payfast')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_payfast_enabled"
                        value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_payfast_enabled" id="is_payfast_enabled"
                        <?php echo e(isset($payment['is_payfast_enabled']) && $payment['is_payfast_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>

        <div id="collapse14"
            class="accordion-collapse collapse"aria-labelledby="heading-2-14"
            data-bs-parent="#accordionExample">

            <div class="accordion-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                    <div class="row pt-2">
                        <label class="pb-2"
                            for="payfast_mode"><?php echo e(__('Payfast Mode')); ?></label>
                        <div class="col-lg-3">
                            <div class="border card p-3">
                                <div class="form-check">
                                    <input type="radio"
                                        class="form-check-input input-primary "
                                        name="payfast_mode" value="sandbox"
                                        <?php echo e(!isset($payment['payfast_mode']) || $payment['payfast_mode'] == '' || $payment['payfast_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                    <label class="form-check-label d-block"
                                        for="">
                                        <span>
                                            <span class="h5 d-block"><strong
                                                    class="float-end"></strong><?php echo e(__('Sandbox')); ?></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="border card p-3">
                                <div class="form-check">
                                    <input type="radio"
                                        class="form-check-input input-primary "
                                        name="payfast_mode" value="live"
                                        <?php echo e(isset($payment['payfast_mode']) && $payment['payfast_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                    <label class="form-check-label d-block"
                                        for="">
                                        <span>
                                            <span class="h5 d-block"><strong
                                                    class="float-end"></strong><?php echo e(__('Live')); ?></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payfast_merchant_id"
                                class="form-label"><?php echo e(__('Merchant Id')); ?></label>
                            <input type="text" name="payfast_merchant_id"
                                id="payfast_merchant_id" class="form-control"
                                value="<?php echo e(!isset($payment['payfast_merchant_id']) || is_null($payment['payfast_merchant_id']) ? '' : $payment['payfast_merchant_id']); ?>"
                                placeholder="<?php echo e(__('Merchant Id')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payfast_merchant_key"
                                class="form-label"><?php echo e(__('Merchant Key')); ?></label>
                            <input type="text" name="payfast_merchant_key"
                                id="payfast_merchant_key" class="form-control"
                                value="<?php echo e(!isset($payment['payfast_merchant_key']) || is_null($payment['payfast_merchant_key']) ? '' : $payment['payfast_merchant_key']); ?>"
                                placeholder="<?php echo e(__('Merchant Key')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="payfast_signature"
                                class="form-label"><?php echo e(__('Salt Passphrase')); ?></label>
                            <input type="text" name="payfast_signature"
                                id="payfast_signature" class="form-control"
                                value="<?php echo e(!isset($payment['payfast_signature']) || is_null($payment['payfast_signature']) ? '' : $payment['payfast_signature']); ?>"
                                placeholder="<?php echo e(__('Salt Passphrase')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-15">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse15"
                aria-expanded="true" aria-controls="collapse15">
                <span class="d-flex align-items-center">
                    
                    <?php echo e(__('IyziPay')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_iyzipay_enabled"
                        value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_iyzipay_enabled" id="is_iyzipay_enabled"
                        <?php echo e(isset($payment['is_iyzipay_enabled']) && $payment['is_iyzipay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>

        <div id="collapse15"
            class="accordion-collapse collapse"aria-labelledby="heading-2-14"
            data-bs-parent="#accordionExample">

            <div class="accordion-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pb-4">
                    <div class="row pt-2">
                        <label class="pb-2"
                            for="iyzipay_mode"><?php echo e(__('IyziPay Mode')); ?></label>
                        <div class="col-lg-3">
                            <div class="border card p-3">
                                <div class="form-check">
                                    <input type="radio"
                                        class="form-check-input input-primary "
                                        name="iyzipay_mode" value="sandbox"
                                        <?php echo e(!isset($payment['iyzipay_mode']) || $payment['iyzipay_mode'] == '' || $payment['iyzipay_mode'] == 'sandbox' ? 'checked="checked"' : ''); ?>>
                                    <label class="form-check-label d-block"
                                        for="">
                                        <span>
                                            <span class="h5 d-block"><strong
                                                    class="float-end"></strong><?php echo e(__('Sandbox')); ?></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="border card p-3">
                                <div class="form-check">
                                    <input type="radio"
                                        class="form-check-input input-primary "
                                        name="iyzipay_mode" value="live"
                                        <?php echo e(isset($payment['iyzipay_mode']) && $payment['iyzipay_mode'] == 'live' ? 'checked="checked"' : ''); ?>>
                                    <label class="form-check-label d-block"
                                        for="">
                                        <span>
                                            <span class="h5 d-block"><strong
                                                    class="float-end"></strong><?php echo e(__('Live')); ?></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="iyzipay_key"
                                class="form-label"><?php echo e(__('IyziPay Key')); ?></label>
                            <input type="text" name="iyzipay_key"
                                id="iyzipay_key" class="form-control"
                                value="<?php echo e(!isset($payment['iyzipay_key']) || is_null($payment['iyzipay_key']) ? '' : $payment['iyzipay_key']); ?>"
                                placeholder="<?php echo e(__('IyziPay Key')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="iyzipay_secret"
                                class="form-label"><?php echo e(__('IyziPay Secret')); ?></label>
                            <input type="text" name="iyzipay_secret"
                                id="iyzipay_secret" class="form-control"
                                value="<?php echo e(!isset($payment['iyzipay_secret']) || is_null($payment['iyzipay_secret']) ? '' : $payment['iyzipay_secret']); ?>"
                                placeholder="<?php echo e(__('IyziPay Secret')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-16">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse16"
                aria-expanded="true" aria-controls="collapse16">
                <span class="d-flex align-items-center">
                    <?php echo e(__('SSPay')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_sspay_enabled" value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_sspay_enabled" id="is_sspay_enabled"
                        <?php echo e(isset($payment['is_sspay_enabled']) && $payment['is_sspay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label for="customswitch1-2" class="form-check-label"></label>
                </div>
            </button>
        </h2>
        <div id="collapse16"
            class="accordion-collapse collapse"aria-labelledby="heading-2-16"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sspay_secret_key"
                                class="form-label"><?php echo e(__('Secret Key')); ?></label>
                            <input type="text" name="sspay_secret_key"
                                id="sspay_secret_key" class="form-control"
                                value="<?php echo e(!isset($payment['sspay_secret_key']) || is_null($payment['sspay_secret_key']) ? '' : $payment['sspay_secret_key']); ?>"
                                placeholder="<?php echo e(__('Secret Key')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sspay_category_code"
                                class="form-label"><?php echo e(__('Category Code')); ?></label>
                            <input type="text" name="sspay_category_code"
                                id="sspay_category_code" class="form-control"
                                value="<?php echo e(!isset($payment['sspay_category_code']) || is_null($payment['sspay_category_code']) ? '' : $payment['sspay_category_code']); ?>"
                                placeholder="<?php echo e(__('Category Code')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-17">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse17"
                aria-expanded="true" aria-controls="collapse17">
                <span class="d-flex align-items-center">
                    <?php echo e(__('PayTab')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_paytab_enabled" value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_paytab_enabled" id="is_paytab_enabled"
                        <?php echo e(isset($payment['is_paytab_enabled']) && $payment['is_paytab_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label for="customswitch1-2" class="form-check-label"></label>
                </div>
            </button>
        </h2>
        <div id="collapse17"
            class="accordion-collapse collapse"aria-labelledby="heading-2-17"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paytab_profile_id"
                                class="form-label"><?php echo e(__('Profile Id')); ?></label>
                            <input type="text" name="paytab_profile_id"
                                id="paytab_profile_id" class="form-control"
                                value="<?php echo e(!isset($payment['paytab_profile_id']) || is_null($payment['paytab_profile_id']) ? '' : $payment['paytab_profile_id']); ?>"
                                placeholder="<?php echo e(__('Profile Id')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paytab_server_key"
                                class="form-label"><?php echo e(__('Server Key')); ?></label>
                            <input type="text" name="paytab_server_key"
                                id="paytab_server_key" class="form-control"
                                value="<?php echo e(!isset($payment['paytab_server_key']) || is_null($payment['paytab_server_key']) ? '' : $payment['paytab_server_key']); ?>"
                                placeholder="<?php echo e(__('Server Key')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paytab_region"
                                class="form-label"><?php echo e(__('Paytab Region')); ?></label>
                            <input type="text" name="paytab_region"
                                id="paytab_region" class="form-control"
                                value="<?php echo e(!isset($payment['paytab_region']) || is_null($payment['paytab_region']) ? '' : $payment['paytab_region']); ?>"
                                placeholder="<?php echo e(__('Paytab Region')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-18">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse18"
                aria-expanded="true" aria-controls="collapse18">
                <span class="d-flex align-items-center">
                    <?php echo e(__('Benefit')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_benefit_enabled"
                        value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_benefit_enabled" id="is_benefit_enabled"
                        <?php echo e(isset($payment['is_benefit_enabled']) && $payment['is_benefit_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label for="customswitch1-2" class="form-check-label"></label>
                </div>
            </button>
        </h2>
        <div id="collapse18"
            class="accordion-collapse collapse"aria-labelledby="heading-2-18"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="benefit_api_key"
                                class="form-label"><?php echo e(__('Benefit Key')); ?></label>
                            <input type="text" name="benefit_api_key"
                                id="benefit_api_key" class="form-control"
                                value="<?php echo e(!isset($payment['benefit_api_key']) || is_null($payment['benefit_api_key']) ? '' : $payment['benefit_api_key']); ?>"
                                placeholder="<?php echo e(__('Enter Benefit Key')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="benefit_secret_key"
                                class="form-label"><?php echo e(__('Benefit Secret Key')); ?></label>
                            <input type="text" name="benefit_secret_key"
                                id="benefit_secret_key" class="form-control"
                                value="<?php echo e(!isset($payment['benefit_secret_key']) || is_null($payment['benefit_secret_key']) ? '' : $payment['benefit_secret_key']); ?>"
                                placeholder="<?php echo e(__('Enter Benefit Secret key')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-19">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse19"
                aria-expanded="true" aria-controls="collapse19">
                <span class="d-flex align-items-center">
                    <?php echo e(__('Cashfree')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_cashfree_enabled"
                        value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_cashfree_enabled" id="is_cashfree_enabled"
                        <?php echo e(isset($payment['is_cashfree_enabled']) && $payment['is_cashfree_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label for="customswitch1-2" class="form-check-label"></label>
                </div>
            </button>
        </h2>
        <div id="collapse19"
            class="accordion-collapse collapse"aria-labelledby="heading-2-19"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cashfree_api_key"
                                class="form-label"><?php echo e(__(' Cashfree Key')); ?></label>
                            <input type="text" name="cashfree_api_key"
                                id="cashfree_api_key" class="form-control"
                                value="<?php echo e(!isset($payment['cashfree_api_key']) || is_null($payment['cashfree_api_key']) ? '' : $payment['cashfree_api_key']); ?>"
                                placeholder="<?php echo e(__('Enter Cashfree Key')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cashfree_secret_key"
                                class="form-label"><?php echo e(__('Cashfree Secret Key')); ?></label>
                            <input type="text" name="cashfree_secret_key"
                                id="cashfree_secret_key" class="form-control"
                                value="<?php echo e(!isset($payment['cashfree_secret_key']) || is_null($payment['cashfree_secret_key']) ? '' : $payment['cashfree_secret_key']); ?>"
                                placeholder="<?php echo e(__('Enter Cashfree Secret Key')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-20">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse20"
                aria-expanded="true" aria-controls="collapse20">
                <span class="d-flex align-items-center">
                    <?php echo e(__('Aamarpay')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_aamarpay_enabled"
                        value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_aamarpay_enabled" id="is_aamarpay_enabled"
                        <?php echo e(isset($payment['is_aamarpay_enabled']) && $payment['is_aamarpay_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label for="customswitch1-2" class="form-check-label"></label>
                </div>
            </button>
        </h2>
        <div id="collapse20"
            class="accordion-collapse collapse"aria-labelledby="heading-2-20"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="aamarpay_store_id"
                                class="form-label"><?php echo e(__(' Store Id')); ?></label>
                            <input type="text" name="aamarpay_store_id"
                                id="aamarpay_store_id" class="form-control"
                                value="<?php echo e(!isset($payment['aamarpay_store_id']) || is_null($payment['aamarpay_store_id']) ? '' : $payment['aamarpay_store_id']); ?>"
                                placeholder="<?php echo e(__('Enter Store Id')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="aamarpay_signature_key"
                                class="form-label"><?php echo e(__('Signature Key')); ?></label>
                            <input type="text" name="aamarpay_signature_key"
                                id="aamarpay_signature_key" class="form-control"
                                value="<?php echo e(!isset($payment['aamarpay_signature_key']) || is_null($payment['aamarpay_signature_key']) ? '' : $payment['aamarpay_signature_key']); ?>"
                                placeholder="<?php echo e(__('Enter Signature Key')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="aamarpay_description"
                                class="form-label"><?php echo e(__('Description')); ?></label>
                            <input type="text" name="aamarpay_description"
                                id="aamarpay_description" class="form-control"
                                value="<?php echo e(!isset($payment['aamarpay_description']) || is_null($payment['aamarpay_description']) ? '' : $payment['aamarpay_description']); ?>"
                                placeholder="<?php echo e(__('Enter Signature Key')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-21">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse21"
                aria-expanded="true" aria-controls="collapse21">
                <span class="d-flex align-items-center">
                    <?php echo e(__('Pay TR')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_paytr_enabled" value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_paytr_enabled" id="is_paytr_enabled"
                        <?php echo e(isset($payment['is_paytr_enabled']) && $payment['is_paytr_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>
        <div id="collapse21"
            class="accordion-collapse collapse"aria-labelledby="heading-2-21"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paytr_merchant_id"
                                class="form-label"><?php echo e(__('Merchant Id')); ?></label>
                            <input type="text" name="paytr_merchant_id"
                                id="paytr_merchant_id" class="form-control"
                                value="<?php echo e(!isset($payment['paytr_merchant_id']) || is_null($payment['paytr_merchant_id']) ? '' : $payment['paytr_merchant_id']); ?>"
                                placeholder="<?php echo e(__('Enter Merchant Id')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paytr_merchant_key"
                                class="form-label"><?php echo e(__('Merchant Key')); ?></label>
                            <input type="text" name="paytr_merchant_key"
                                id="paytr_merchant_key" class="form-control"
                                value="<?php echo e(!isset($payment['paytr_merchant_key']) || is_null($payment['paytr_merchant_key']) ? '' : $payment['paytr_merchant_key']); ?>"
                                placeholder="<?php echo e(__('Enter Merchant Key')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paytr_merchant_salt"
                                class="form-label"><?php echo e(__('Salt Passphrase')); ?></label>
                            <input type="text" name="paytr_merchant_salt"
                                id="paytr_merchant_salt" class="form-control"
                                value="<?php echo e(!isset($payment['paytr_merchant_salt']) || is_null($payment['paytr_merchant_salt']) ? '' : $payment['paytr_merchant_salt']); ?>"
                                placeholder="<?php echo e(__('Enter Salt Passphrase')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-21">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse22"
                aria-expanded="true" aria-controls="collapse22">
                <span class="d-flex align-items-center">
                    <?php echo e(__('Yookassa')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_yookassa_enabled"
                        value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_yookassa_enabled" id="is_yookassa_enabled"
                        <?php echo e(isset($payment['is_yookassa_enabled']) && $payment['is_yookassa_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>
        <div id="collapse22"
            class="accordion-collapse collapse"aria-labelledby="heading-2-22"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="yookassa_shop_id"
                                class="form-label"><?php echo e(__('Shop ID Key')); ?></label>
                            <input type="text" name="yookassa_shop_id"
                                id="yookassa_shop_id" class="form-control"
                                value="<?php echo e(!isset($payment['yookassa_shop_id']) || is_null($payment['yookassa_shop_id']) ? '' : $payment['yookassa_shop_id']); ?>"
                                placeholder="<?php echo e(__('Enter Shop ID Key')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="yookassa_secret"
                                class="form-label"><?php echo e(__('Secret Key')); ?></label>
                            <input type="text" name="yookassa_secret"
                                id="yookassa_secret" class="form-control"
                                value="<?php echo e(!isset($payment['yookassa_secret']) || is_null($payment['yookassa_secret']) ? '' : $payment['yookassa_secret']); ?>"
                                placeholder="<?php echo e(__('Enter Secret Key')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


    
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-23">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse23"
                aria-expanded="true" aria-controls="collapse23">
                <span class="d-flex align-items-center">
                    <?php echo e(__('Midtrans')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_midtrans_enabled"
                        value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_midtrans_enabled" id="is_midtrans_enabled"
                        <?php echo e(isset($payment['is_midtrans_enabled']) && $payment['is_midtrans_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>
        <div id="collapse23"
            class="accordion-collapse collapse"aria-labelledby="heading-2-23"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="midtrans_secret"
                                class="form-label"><?php echo e(__('Secret Key')); ?></label>
                            <input type="text" name="midtrans_secret"
                                id="midtrans_secret" class="form-control"
                                value="<?php echo e(!isset($payment['midtrans_secret']) || is_null($payment['midtrans_secret']) ? '' : $payment['midtrans_secret']); ?>"
                                placeholder="<?php echo e(__('Enter Secret Key')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    
    <!-- <div class="accordion-item card">
        <h2 class="accordion-header" id="heading-2-24">
            <button class="accordion-button collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target="#collapse24"
                aria-expanded="true" aria-controls="collapse24">
                <span class="d-flex align-items-center">
                    <?php echo e(__('Xendit')); ?>

                </span>
                <?php echo e(__('Enable:')); ?>

                <div class="form-check form-switch custom-switch-v1">
                    <input type="hidden" name="is_xendit_enabled" value="off">
                    <input type="checkbox" class="form-check-input input-primary"
                        name="is_xendit_enabled" id="is_xendit_enabled"
                        <?php echo e(isset($payment['is_xendit_enabled']) && $payment['is_xendit_enabled'] == 'on' ? 'checked="checked"' : ''); ?>>
                    <label class="form-check-label" for="customswitchv1-2"></label>
                </div>
            </button>
        </h2>
        <div id="collapse24"
            class="accordion-collapse collapse"aria-labelledby="heading-2-24"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="xendit_api"
                                class="form-label"><?php echo e(__('API Key')); ?></label>
                            <input type="text" name="xendit_api"
                                id="xendit_api" class="form-control"
                                value="<?php echo e(!isset($payment['xendit_api']) || is_null($payment['xendit_api']) ? '' : $payment['xendit_api']); ?>"
                                placeholder="<?php echo e(__('Enter API Key')); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="xendit_token"
                                class="form-label"><?php echo e(__('Token')); ?></label>
                            <input type="text" name="xendit_token"
                                id="xendit_token" class="form-control"
                                value="<?php echo e(!isset($payment['xendit_token']) || is_null($payment['xendit_token']) ? '' : $payment['xendit_token']); ?>"
                                placeholder="<?php echo e(__('Enter Token')); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    

<!-- </div>
                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn-submit btn btn-primary'])); ?>

                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div> -->

<div id="twilio-settings" class="card">
    <div class="card-header">
        <h5><?php echo e(__('Twilio Settings')); ?></h5>
        <small class="text-muted"><?php echo e(__('Edit your twilio details')); ?></small>
    </div>
    <div class="card-body">
        <h4 class="small-title"><?php echo e(__('Twilio')); ?></h4>
        <?php echo e(Form::model($settings, ['route' => 'twilio.setting', 'method' => 'post'])); ?>

        <?php echo csrf_field(); ?>
        <div class="row mt-3">
            <div class="form-group col-md-4">
                <?php echo e(Form::label('SID', __('SID'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('twilio_sid', isset($settings['twilio_sid']) ? $settings['twilio_sid'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Twilio Sid'), 'required' => 'required'])); ?>

            </div>
            <div class="form-group col-md-4">
                <?php echo e(Form::label('Token', __('Token'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('twilio_token', isset($settings['twilio_token']) ? $settings['twilio_token'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Twilio Token'), 'required' => 'required'])); ?>

            </div>
            <div class="form-group col-md-4">
                <?php echo e(Form::label('From', __('From'), ['class' => 'form-label'])); ?>


                <?php echo e(Form::text('twilio_from', isset($settings['twilio_from']) ? $settings['twilio_from'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Twilio From'), 'required' => 'required'])); ?>

            </div>
            <div class="col-md-12 mt-4 mb-2">
                <h4 class="small-title"><?php echo e(__('Module Settings')); ?></h4>
            </div>
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span><?php echo e(__('New User')); ?></span>
                        <div class="form-check form-switch float-end">
                            <?php echo e(Form::checkbox('twilio_user_create', '1', isset($settings['twilio_user_create']) && $settings['twilio_user_create'] == '1' ? 'checked' : '', ['class' => 'form-check-input input-primary', 'id' => 'twilio_user_create'])); ?>

                            <label class="form-check-label" for="twilio_user_create"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span><?php echo e(__('New Lead')); ?></span>
                        <div class="form-check form-switch float-end">
                            <?php echo e(Form::checkbox('twilio_lead_create', '1', isset($settings['twilio_lead_create']) && $settings['twilio_lead_create'] == '1' ? 'checked' : '', ['class' => 'form-check-input input-primary', 'id' => 'twilio_lead_create'])); ?>

                            <label class="form-check-label" for="twilio_lead_create"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span><?php echo e(__('New Meeting')); ?></span>
                        <div class="form-check form-switch float-end">
                            <?php echo e(Form::checkbox('twilio_meeting_create', '1', isset($settings['twilio_meeting_create']) && $settings['twilio_meeting_create'] == '1' ? 'checked' : '', ['class' => 'form-check-input input-primary', 'id' => 'twilio_meeting_create'])); ?>

                            <label class="form-check-label" for="twilio_meeting_create"></label>
                        </div>
                    </li>
                    <!-- <li class="list-group-item">
                                            <span><?php echo e(__('New Quotes')); ?></span>
                                            <div class="form-check form-switch float-end">
                                                <?php echo e(Form::checkbox('twilio_quotes_create', '1', isset($settings['twilio_quotes_create']) && $settings['twilio_quotes_create'] == '1' ? 'checked' : '', ['class' => 'form-check-input input-primary', 'id' => 'twilio_quotes_create'])); ?>

                                                <label class="form-check-label" for="twilio_quotes_create"></label>
                                            </div>
                                        </li> -->
                </ul>
            </div>
            <!-- <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span><?php echo e(__('New Sales Order')); ?></span>
                        <div class="form-check form-switch float-end">
                            <?php echo e(Form::checkbox('twilio_salesorder_create', '1', isset($settings['twilio_salesorder_create']) && $settings['twilio_salesorder_create'] == '1' ? 'checked' : '', ['class' => 'form-check-input input-primary', 'id' => 'twilio_salesorder_create'])); ?>

                            <label class="form-check-label" for="twilio_salesorder_create"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span><?php echo e(__('New Invoice')); ?></span>
                        <div class="form-check form-switch float-end">
                            <?php echo e(Form::checkbox('twilio_invoice_create', '1', isset($settings['twilio_invoice_create']) && $settings['twilio_invoice_create'] == '1' ? 'checked' : '', ['class' => 'form-check-input input-primary', 'id' => 'twilio_invoice_create'])); ?>

                            <label class="form-check-label" for="twilio_invoice_create"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span><?php echo e(__('New Invoice Payment')); ?></span>
                        <div class="form-check form-switch float-end">
                            <?php echo e(Form::checkbox('twilio_invoicepay_create', '1', isset($settings['twilio_invoicepay_create']) && $settings['twilio_invoicepay_create'] == '1' ? 'checked' : '', ['class' => 'form-check-input input-primary', 'id' => 'twilio_invoicepay_create'])); ?>

                            <label class="form-check-label" for="twilio_invoicepay_create"></label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span><?php echo e(__('New Meeting')); ?></span>
                        <div class="form-check form-switch float-end">
                            <?php echo e(Form::checkbox('twilio_meeting_create', '1', isset($settings['twilio_meeting_create']) && $settings['twilio_meeting_create'] == '1' ? 'checked' : '', ['class' => 'form-check-input input-primary', 'id' => 'twilio_meeting_create'])); ?>

                            <label class="form-check-label" for="twilio_meeting_create"></label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <span><?php echo e(__('New Task')); ?></span>
                        <div class="form-check form-switch float-end">
                            <?php echo e(Form::checkbox('twilio_task_create', '1', isset($settings['twilio_task_create']) && $settings['twilio_task_create'] == '1' ? 'checked' : '', ['class' => 'form-check-input input-primary', 'id' => 'twilio_task_create'])); ?>

                            <label class="form-check-label" for="twilio_task_create"></label>
                        </div>
                    </li>
                </ul>
            </div> -->
            <div class="text-end">
                <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn-submit btn btn-primary'])); ?>

            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
</div>

<!--Email Notification Setting-->
<!-- <div id="email-notification-settings" class="card">
    <?php echo e(Form::model($settings, ['route' => ['status.email.language'], 'method' => 'post'])); ?>

    <?php echo csrf_field(); ?>
    <div class="col-md-12">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h5><?php echo e(__('Email Notification Settings')); ?></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <?php $__currentLoopData = $EmailTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $EmailTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                        <div class="list-group">
                            <div class="list-group-item form-switch form-switch-right">
                                <label class="form-label"
                                    style="margin-left:5%;"><?php echo e($EmailTemplate->name); ?></label>
                                <input class="form-check-input" name='<?php echo e($EmailTemplate->id); ?>'
                                    id="email_tempalte_<?php echo e($EmailTemplate->template->id); ?>"
                                    type="checkbox"
                                    <?php if($EmailTemplate->template->is_active == 1): ?> checked="checked" <?php endif; ?>
                                    type="checkbox" value="1"
                                    data-url="<?php echo e(route('status.email.language', [$EmailTemplate->template->id])); ?>" />
                                <label class="form-check-label"
                                    for="email_tempalte_<?php echo e($EmailTemplate->template->id); ?>"></label>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="card-footer p-0">
                <div class="col-sm-12 mt-3 px-2">
                    <div class="text-end">
                        <input class="btn btn-print-invoice  btn-primary " type="submit"
                            value="<?php echo e(__('Save Changes')); ?>">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div> -->

<!-- <div class="" id="google-calender">
                        <div class="card">
                            <?php echo e(Form::open(['url' => route('google.calender.settings'), 'enctype' => 'multipart/form-data'])); ?>

                            <div class="card-header">
                                <div class="row">

                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <h5><?php echo e(__('Google Calendar Settings')); ?></h5>
                                    </div>

                                    <div class="col-lg-4 col-md-4 text-end">
                                        <div class="form-check custom-control custom-switch">
                                            <input type="checkbox" class="form-check-input" name="is_enabled"
                                                data-toggle="switchbutton" data-onstyle="primary" id="is_enabled"
                                                <?php echo e(isset($settings['is_enabled']) && $settings['is_enabled'] == 'on' ? 'checked' : ''); ?>>
                                            <label class="custom-control-label form-label" for="is_enabled"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <?php echo e(Form::label('Google calendar id', __('Google Calendar Id'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('google_clender_id', !empty($settings['google_clender_id']) ? $settings['google_clender_id'] : '', ['class' => 'form-control ', 'placeholder' => 'Google Calendar Id'])); ?>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <?php echo e(Form::label('Google calendar json file', __('Google Calendar json File'), ['class' => 'col-form-label'])); ?>

                                        <input type="file" class="form-control" name="google_calender_json_file"
                                            id="file">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" type="submit">
                                    <?php echo e(__('Save Changes')); ?>

                                </button>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div> -->


<!-- <div class="" id="webhook-settings">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">

                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <h5><?php echo e(__('Webhook Settings')); ?></h5>
                                    </div>

                                    <div class="col-lg-4 col-md-4 text-end">
                                        <div class="form-check custom-control custom-switch">
                                            <a href="#" data-url="<?php echo e(route('webhook.create')); ?>"
                                                data-size="md" data-ajax-popup="true" data-bs-toggle="tooltip"
                                                title="<?php echo e(__('Create')); ?>"data-title="<?php echo e(__('Create New Webhook')); ?>"
                                                class="btn btn-sm btn-primary btn-icon">
                                                <i class="ti ti-plus"></i>
                                            </a>
                                            <label class="custom-control-label form-label" for="is_enabled"></label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr class="col-md-6">
                                                <th scope="col" class="sort" data-sort="module">
                                                    <?php echo e(__('Module')); ?></th>
                                                <th scope="col" class="sort" data-sort="url">
                                                    <?php echo e(__('URL')); ?></th>
                                                <th scope="col" class="sort" data-sort="method">
                                                    <?php echo e(__('Method')); ?></th>
                                                <th scope="col" class="sort" data-sort="">
                                                    <?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $webhooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webhook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="Action">
                                                    <td>
                                                        <label for="module"
                                                            class="control-label text-decoration-none tag-lable-<?php echo e($webhook->id); ?>"><?php echo e($webhook->module); ?></label>
                                                    </td>
                                                    <td>
                                                        <label for="url"
                                                            class="control-label text-decoration-none tag-lable-<?php echo e($webhook->id); ?>"><?php echo e($webhook->url); ?></label>
                                                    </td>
                                                    <td>
                                                        <label for="method"
                                                            class="control-label text-decoration-none tag-lable-<?php echo e($webhook->id); ?>"><?php echo e($webhook->method); ?></label>
                                                    </td>
                                                    <td class="">

                                                        <div class="action-btn bg-info ms-2">
                                                            <a class="mx-3 btn btn-sm  align-items-center"
                                                                data-url="<?php echo e(route('webhook.edit', $webhook->id)); ?>"
                                                                data-size="md" data-bs-toggle="tooltip"
                                                                data-bs-original-title="<?php echo e(__('Edit')); ?>"
                                                                data-bs-placement="top" data-ajax-popup="true"
                                                                data-title="<?php echo e(__('Edit WebHook')); ?>"
                                                                class="edit-icon"
                                                                data-original-title="<?php echo e(__('Edit')); ?>"><i
                                                                    class="ti ti-pencil text-white"></i></a>
                                                        </div>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['webhook.destroy', $webhook->id]]); ?>

                                                            <a href="#!"
                                                                class="mx-3 btn btn-sm align-items-center text-white show_confirm"
                                                                data-bs-toggle="tooltip" title='Delete'>
                                                                <i class="ti ti-trash"></i>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div> -->
<div id ="user-settings" class="card">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
            <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h5><?php echo e(__('Staff Settings')); ?></h5>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create User')): ?>
                            <div class="action-btn bg-warning ms-2" style="float: inline-end;">
                                <a href="#" data-url="<?php echo e(route('user.create')); ?>" data-size="md" data-ajax-popup="true" data-bs-toggle="tooltip"
                                    title="<?php echo e(__('Create Staff')); ?>"data-title="<?php echo e(__('Create Staff Member')); ?>" class="btn btn-sm btn-primary btn-icon">
                                    <i class="ti ti-plus"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table id="datatable" class="table align-items-center datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="username"><?php echo e(__('Avatar')); ?></th>
                                    <th scope="col" class="sort" data-sort="username"><?php echo e(__('User Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                    <th scope="col" class="sort" data-sort="email"><?php echo e(__('Email')); ?></th>
                                    <?php if(\Auth::user()->type != 'super admin'): ?>
                                        <th scope="col" class="sort" data-sort="title"><?php echo e(__('Type')); ?></th>
                                        <th scope="col" class="sort" data-sort="isactive"><?php echo e(__('Status')); ?></th>
                                    <?php endif; ?>
                                    <?php if(Gate::check('Edit User') || Gate::check('Delete User')): ?>
                                        <th class="text-end" scope="col"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $profile = \App\Models\Utility::get_file('upload/profile/');
                                ?>
                            
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <span class="avatar">
                                                <a href="<?php echo e($profile); ?><?php echo e(!empty($user->avatar) ? $user->avatar : 'avatar.png'); ?>"
                                                    target="_blank">
                                                <img class="rounded-circle" width="25%"
                                                    <?php if($user->avatar): ?> src="<?php echo e($profile); ?><?php echo e(!empty($user->avatar) ? $user->avatar : 'avatar.png'); ?>" <?php else: ?> src="<?php echo e($profile . 'avatar.png'); ?>" <?php endif; ?>
                                                    alt="<?php echo e($user->name); ?>">
                                                </a>
                                            </span>
                                        </td>
                                        <td class="budget">
                                            <a href="#" data-size="md" data-url="<?php echo e(route('user.show', $user->id)); ?>"
                                                data-ajax-popup="true" data-title="<?php echo e(__('User Details')); ?>"
                                                class="action-item text-primary">
                                                <?php echo e(ucfirst($user->username)); ?>

                                            </a>
                                        </td>
                                        <td>
                                            <span class="budget"> <?php echo e(ucfirst($user->name)); ?> </span>
                                        </td>
                                        <td>
                                            <span class="budget"><?php echo e($user->email); ?></span>
                                        </td>
                                        <?php if(\Auth::user()->type != 'super admin'): ?>
                                            <td>
                                                <?php echo e(ucfirst($user->type)); ?>

                                            </td>
                                            <td>
                                                <?php if($user->is_active == 1): ?>
                                                    <span
                                                        class="badge bg-success p-2 px-3 rounded"><?php echo e(__('Active')); ?></span>
                                                <?php else: ?>
                                                    <span
                                                        class="badge bg-danger p-2 px-3 rounded"><?php echo e(__('In Active')); ?></span>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                        <?php if(Gate::check('Edit User') || Gate::check('Delete User')): ?>
                                            <td class="text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show User')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="#" data-size="md"
                                                            data-url="<?php echo e(route('user.show', $user->id)); ?>"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Details')); ?>"
                                                            data-ajax-popup="true" data-title="<?php echo e(__('User Details')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit User')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="<?php echo e(route('user.edit', $user->id)); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                            data-bs-toggle="tooltip"
                                                            title="<?php echo e(__('Edit')); ?>"data-title="<?php echo e(__('Edit User')); ?>"><i
                                                                class="ti ti-edit"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete User')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['user.destroy', $user->id]]); ?>

                                                        <a href="#!"
                                                            class="mx-3 btn btn-sm align-items-center text-white show_confirm"
                                                            data-bs-toggle="tooltip" title='Delete'>
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="role-settings" class="card">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h5><?php echo e(__('Role Settings')); ?></h5>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Role')): ?>
                                <div class="action-btn bg-warning ms-2" style="float: inline-end;">
                                    <a href="#" data-url="<?php echo e(route('role.create')); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip"title="<?php echo e(__(' Create Role')); ?>"data-title="<?php echo e(__('Create New Role')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
                                        <i class="ti ti-plus"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable" id="datatable1">
                            <thead>
                                <tr>
                                    <th width="150"><?php echo e(__('Role')); ?> </th>
                                    <th><?php echo e(__('Permissions')); ?> </th>
                                    <?php if(Gate::check('Edit Role') || Gate::check('Delete Role')): ?>
                                        <th width="150" class="text-end"><?php echo e(__('Action')); ?> </th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td width="150"><?php echo e($role->name); ?></td>
                                        <td class="Permission mt-10">
                                            <div class="badges">
                                                
                                                <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <span class="badge rounded p-2 m-1 px-3 bg-primary">
                                                    <a href="#" class="text-white"><?php echo e($permission->name); ?></a>
                                                </span>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </td>
                                        <?php if(Gate::check('Edit Role') || Gate::check('Delete Role')): ?>
                                            <td class="text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Role')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-url="<?php echo e(route('role.edit',$role->id)); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Role')); ?>">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Role')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['role.destroy', $role->id]]); ?>

                                                            <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                                <i class="ti ti-trash"></i>
                                                            </a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="eventtype-settings" class="card">
    <div class="col-md-12">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h5><?php echo e(__('Event Type Settings')); ?></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-3">
                <?php echo e(Form::open(['route' => 'event_type.setting', 'method' => 'post'])); ?>

                <?php echo csrf_field(); ?>
                <div class="form-group col-md-12">
                    <?php echo e(Form::label('event_type', __('Event Type'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('event_type',null,['class' => 'form-control ', 'placeholder' => __('Enter Event Type'), 'required' => 'required'])); ?>

                </div>
                <div class="text-end">
                    <?php echo e(Form::submit(__('Save'), ['class' => 'btn-submit btn btn-primary'])); ?>

                </div>
                <?php echo e(Form::close()); ?>

            </div>
            <?php if(isset($eventtypes) && !empty($eventtypes)): ?>
            <div class="row mt-3">
                <div class="form-group col-md-12">
                    <label class="form-label">Events List</label>
                    <div class="badges">
                        <?php $__currentLoopData = $eventtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $types): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge rounded p-2 m-1 px-3 bg-primary" style="cursor:pointer">
                            <?php echo e($types); ?>

                            <?php if(Gate::check('Delete Role')): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Role')): ?>
                            <div class="action-btn  ms-2">
                                <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white event_show_confirm" data-bs-toggle="tooltip" title='Delete' data-url="<?php echo e(route('eventedit.setting')); ?>" data-token="<?php echo e(csrf_token()); ?>">
                                    <i class="ti ti-trash"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>
                        </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div id="venue-settings" class="card">
    <div class="col-md-12">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h5><?php echo e(__('Venue Settings')); ?></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-3">
                <?php echo e(Form::open(['route' => 'venue.setting', 'method' => 'post'])); ?>

                <?php echo csrf_field(); ?>
                <div class="form-group col-md-12">
                    <?php echo e(Form::label('venue', __('Venue'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('venue',null,['class' => 'form-control ', 'placeholder' => __('Enter Venue'), 'required' => 'required'])); ?>

                </div>
                <div class="text-end">
                    <?php echo e(Form::submit(__('Save'), ['class' => 'btn-submit btn btn-primary'])); ?>

                </div>
                <?php echo e(Form::close()); ?>

            </div>
            <?php if(isset($venue) && !empty($venue)): ?>
            <div class="row mt-3">
                <div class="form-group col-md-12">
                    <label class="form-label">Venue</label>
                    <div class="badges">
                        <?php $__currentLoopData = $venue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge rounded p-2 m-1 px-3 bg-primary" style="cursor:pointer">
                            <?php echo e($value); ?>

                            <?php if(Gate::check('Delete Role')): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Role')): ?>
                            <div class="action-btn  ms-2">
                                <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white venue_show_confirm" data-bs-toggle="tooltip" title='Delete' data-url="<?php echo e(route('venueedit.setting')); ?>" data-token="<?php echo e(csrf_token()); ?>">
                                    <i class="ti ti-trash"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>
                        </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div id="function-settings" class="card">
    <div class="col-md-12">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h5><?php echo e(__('Function Settings')); ?></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-3">
                <?php echo e(Form::open(['route' => 'function.setting', 'method' => 'post'])); ?>

                <?php echo csrf_field(); ?>
                <div class="form-group col-md-12">
                    <?php echo e(Form::label('function', __('Function'), ['class' => 'form-label'])); ?>

                    <?php echo e(Form::text('function',null,['class' => 'form-control ', 'placeholder' => __('Enter Function'), 'required' => 'required'])); ?>

                </div>
                <div class="text-end">
                    <?php echo e(Form::submit(__('Save'), ['class' => 'btn-submit btn btn-primary'])); ?>

                </div>
                <?php echo e(Form::close()); ?>

            </div>
            <?php if(isset($function) && !empty($function)): ?>
            <div class="row mt-3">
                <div class="form-group col-md-12">
                    <label class="form-label">Function</label>
                    <div class="badges">
                        <?php $__currentLoopData = $function; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge rounded p-2 m-1 px-3 bg-primary" style="cursor:pointer">
                            <?php echo e($value); ?>

                            <?php if(Gate::check('Delete Role')): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Role')): ?>
                            <div class="action-btn  ms-2">
                                <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white venue_show_confirm" data-bs-toggle="tooltip" title='Delete' data-url="<?php echo e(route('functionedit.setting')); ?>" data-token="<?php echo e(csrf_token()); ?>">
                                    <i class="ti ti-trash"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>
                        </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div id="floor-plan-setting" class="card">
    <div class="col-md-12">
        <div class="card-header">
            <div class="row">
                <div id="floor-plan-setting" class="col-lg-8 col-md-8 col-sm-8">
                    <h5><?php echo e(__('Upload Floor Plan')); ?></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-3">
                <form method="POST" action="<?php echo e(url('/floor-images')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group col-md-12">
                        <label for="setup" class="form-label">Choose Image</label></br>
                        <input type="file" name="setup" class="form-control" />
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn-submit btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12">
            <div class="row">
                <?php $__currentLoopData = File::files(public_path('floor_images')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6">
                    <input type="radio" id="image_<?php echo e($loop->index); ?>" name="uploadedImage" class="form-check-input" value="<?php echo e(asset('floor_images/' . basename($image))); ?>">
                    <label for="image_<?php echo e($loop->index); ?>" class="form-check-label">
                        <img src="<?php echo e(asset('floor_images/'. basename($image))); ?>" alt="Uploaded Image" class="img-thumbnail floorimages zoom">
                        <i class="ti ti-trash" data-image="<?php echo e(basename($image)); ?>" onclick="deleteImage(this)"></i>
                    </label>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>
<div id="billing-setting" class="card">
    <div class="col-md-12">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h5><?php echo e(__('Billing Settings')); ?></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-3">

                <?php echo e(Form::open(['route' => 'billing.setting', 'method' => 'post'])); ?>

                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="form-group col-md-6">
                       <?php echo e(Form::label('venue_rental',__('Venue Rental'),['class'=>'form-label'])); ?>

                        <?php echo Form::select('venue_rental',$venue, null,['class' => 'form-control ', 'placeholder' => __('Select Venue'), 'required' => 'required']); ?>

                    </div>
                    <div class="col-md-6">
                        <?php echo e(Form::label('venue_rental_cost', __('Venue Rental'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::number('venue_rental_cost',null,['class' => 'form-control ', 'placeholder' => __('Enter Venue Rental Cost'), 'required' => 'required'])); ?>

                    </div>
                   
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('equipment', __('Tent, Tables, Chairs, AV Equipment'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::number('equipment',null,['class' => 'form-control ', 'placeholder' => __('Enter Equipments Cost'), 'required' => 'required'])); ?>

                    </div>
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('setup', __('Welcome/Rehearsel/Special Setup'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::number('setup',null,['class' => 'form-control ', 'placeholder' => __('Enter Setup Cost'), 'required' => 'required'])); ?>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('bar_package', __('Bar Package'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::number('bar_package',null,['class' => 'form-control ', 'placeholder' => __('Enter Bar Package Cost'), 'required' => 'required'])); ?>

                    </div>
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('special_req', __('Special Request/Others'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::number('special_req',null,['class' => 'form-control ', 'placeholder' => __('Enter Cost'), 'required' => 'required'])); ?>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('food', __('Brunch/Lunch/Dinner Package'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::number('food',null,['class' => 'form-control ', 'placeholder' => __('Enter Food Package Cost'), 'required' => 'required'])); ?>

                    </div>
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('hotel_rooms', __('Hotel Rooms'), ['class' => 'form-label'])); ?>

                        <?php echo e(Form::number('hotel_rooms',null,['class' => 'form-control ', 'placeholder' => __('Enter Hotel Rooms Cost'), 'required' => 'required'])); ?>

                    </div>
                </div>
                <div class="text-end">
                    <?php echo e(Form::submit(__('Save'), ['class' => 'btn-submit btn btn-primary'])); ?>

                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>
<div id="buffer-settings" class="card">
    <div class="col-md-12">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h5><?php echo e(__('Add Buffer Time')); ?></h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mt-3">
                <?php echo e(Form::open(['route' => 'buffer.setting', 'method' => 'post'])); ?>

                <?php echo csrf_field(); ?>
                <div class="col-12">
                    <div class="form-group">
                        <?php echo e(Form::label('buffer_time', __('Add Buffer Time'), ['class' => 'form-label'])); ?>

                        <?php echo Form::input('time', 'buffer_time',$settings['buffer_time'], ['class' => 'form-control', 'required' => 'required']); ?>

                    </div>
                </div>
                <div class="text-end">
                    <?php echo e(Form::submit(__('Save'), ['class' => 'btn-submit btn btn-primary'])); ?>

                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>
<div id="add-signature" class="card">
    <div class="col-md-12">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h5><?php echo e(__('Add Authorised Signature')); ?></h5>
                </div>
            </div>
        </div>
        <form method="POST"  id='sign'>
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-6">
                        <strong>Existing  Signature:</strong> <br>
                        <img src="<?php echo e($base64Image); ?>" style=" width: 55%;padding-right: 39px;border-bottom: 1px solid black;">
                    </div>
                    <div class="col-6">
                        <strong> Signature:</strong>
                        <br>
                        <div id="sig" class="mt-3">
                            <canvas id="signatureCanvas" width="200" height="200" required></canvas>
                            <input type="hidden" name="imageData" id="imageData">
                        </div>
                        <button id="clearButton" class="btn btn-danger btn-sm mt-1">Clear Signature</button>
                    </div>
                    <div class="text-end">
                        <input type="submit" value="Save" class="btn-submit btn btn-primary">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>
</div>
</div>
</div>
<!-- [ sample-page ] end -->
</div>
<!-- [ Main Content ] end -->

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<script>
    $(document).ready(function() {
        $("#checkall").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $(".ischeck").click(function() {
            var ischeck = $(this).data('id');
            $('.isscheck_' + ischeck).prop('checked', this.checked);

        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function deleteImage(icon) {
        var imageName = icon.getAttribute('data-image');
        var url = "<?php echo e(url('/delete-image')); ?>";
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "This action can not be undone. Do you want to continue?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        "imageName": imageName,
                        "_token": "<?php echo e(csrf_token()); ?>",
                    },
                    success: function(result) {
                        if (result.success == true) {
                            swal.fire("Done!", result.message, "success");
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swal.fire("Error!", result.message, "error");
                        }
                    }
                });
            }
        })
    }
</script>
<script>
    // document.addEventListener('DOMContentLoaded', function() {
        // var canvas = document.getElementById('signatureCanvas');

        // var signaturePad = new SignaturePad(canvas);
        // function clearCanvas() {
        //     signaturePad.clear();
        // }
        
        // document.querySelector('form').addEventListener('submit', function() {
        //     if (signaturePad.points.length != 0) {
        //         document.getElementById('imageData').value = signaturePad.toDataURL();
        //     } else {
        //        document.getElementById('imageData').value = '';
        //     }
        // });
    // });
 </script> 
<script>
document.addEventListener('DOMContentLoaded', function () {
    var canvas = document.getElementById('signatureCanvas');
    var signaturePad = new SignaturePad(canvas);
    function clearCanvas() {
        signaturePad.clear();
    }  
    document.getElementById('clearButton').addEventListener('click', function(e) {
            e.preventDefault();
            clearCanvas();
     });
    // Access the data (image or coordinates) from the signature pad on form submit
    document.getElementById('sign').addEventListener('submit', function (event) {
        event.preventDefault();
        if (signaturePad.isEmpty()) {
            alert('Please provide your signature before submitting.');
        } else {
            var signatureData = signaturePad.toDataURL();
            document.getElementById('imageData').value = signatureData;
            $.ajax({
                url: "<?php echo e(route('authorised.signature')); ?>",
                type: 'POST',
                data: {
                    "signature": signatureData,
                    "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function(data) {
                    location.reload();
                }
            });
        }
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/settings/index.blade.php ENDPATH**/ ?>