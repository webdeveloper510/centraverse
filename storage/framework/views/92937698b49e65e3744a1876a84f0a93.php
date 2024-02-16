
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Campaign')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Campaign')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Campaign')); ?></li>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://editor.unlayer.com/embed.css">
<script src="https://editor.unlayer.com/embed.js"></script>
<?php echo e(Form::open(array('route' => 'customer.sendmail','method' =>'post'))); ?>

<div class="container-field">
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
                    <a href="#useradd-1" class="list-group-item list-group-item-action">
                        <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                        <span class="dash-mtext"><?php echo e(__('Campaign')); ?> </span></a>
                </div>
            </div>
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <input type='text' id='autocomplete' name="type" class="form-control" required>
                                    <ul id="autocomplete-suggestions" class="list-group"></ul>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Select Recipients</label>
                                    <input type='text' name="recipients" class="form-control" id="recipients" placeholder="Please Select Recipient" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type='text' name="title" class="form-control" id="abc" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <label for="type">Notify as:</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="email" value="email" name="notify[1][]">
                                    <label class="form-check-label" for="email">Email</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="text" value="text" name="notify[1][]">
                                    <label class="form-check-label" for="text">Text</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <label>Upload Documents:</label><br>
                                 <input type="file" name="document" id="document"class="form-control" placeholder="Drag and Drop files here">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php echo e(Form::close()); ?>

<div class="modal" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Recipients</h5>
                <button type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="#" data-url="<?php echo e(route('campaign.existinguser')); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('User List')); ?>" title="<?php echo e(__('Select Reciients')); ?>" class="btn btn-primary btn-icon m-1 close" style="float: right;"><?php echo e(__('Existing Lead')); ?></a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" data-url="<?php echo e(route('campaign.addeduser')); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('User List')); ?>" title="<?php echo e(__('Select Reciients')); ?>" class="btn btn-primary btn-icon m-1 close" style="float: right;"><?php echo e(__('User list')); ?></a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="formatting">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Email Formatting</h5>
                <button type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6  mt-4">
                        <div class="form-group">
                        <input type="radio" name="format" id="format" class="form-check-input " value="html" style="display: none;">
                        <label for="format" class="form-check-label">
                            <img src="<?php echo e(asset('assets/images/html-formatter.svg')); ?>" alt="Uploaded Image" class="img-thumbnail formatter" data-bs-toggle="tooltip" title="HTML Mail" style="float: inline-end;">
                        </label>
                        <h4  style="float: inline-end;">HTML Mail</h4>
                        </div>
                      
                    </div>
                    <div class="col-6  mt-4">
                        <div class="form-group">
                            <input type="radio" name="format" id="txt" class="form-check-input " value="text" style="display: none;">
                            <label for="txt" class="form-check-label">
                                <img src="<?php echo e(asset('assets/images/text.svg')); ?>" alt="Uploaded Image" class="img-thumbnail formatter" data-bs-toggle="tooltip" title="Text Mail" >
                            </label>
                            <h4 class="mt-2">Text Mail</h4>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="htmlmail">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">HTML Mail</h5>
                <button type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div id="editor" style="height:500px;"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="textformat">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Email Formatting</h5>
                <button type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('subject', __('Subject'), ['class' => 'form-control-label text-dark'])); ?>

                                <?php echo e(Form::text('subject', null, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

                            </div>
                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('from', __('From'), ['class' => 'form-control-label text-dark'])); ?>

                                <?php echo e(Form::text('from',null, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <?php echo e(Form::label('content', __('Email Message'), ['class' => 'form-control-label text-dark'])); ?>

                                <?php echo e(Form::textarea('content',null, ['class' => 'summernote', 'required' => 'required'])); ?>

                            </div>
                            <div class="col-md-12 text-end">
                                <input type="submit" value="<?php echo e(__('Save')); ?>"
                                    class="btn btn-print-invoice  btn-primary">
                            </div>

                        </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">

<style>
    div#myModal {
        position: absolute;
    }

    .formatter {
        background: #e3e8ef;
        width: 35%;
        padding: 14px;
        border-radius: 7px;
    }

    #formatter {
        width: 80px;
        height: 80px;
    }

    img#text-icon {
        background: #e3e8ef;
        width: 80px;
        height: 80px;
        padding: 8px;
        border-radius: 7px;
    }

    .selected-image {
        border: 2px solid #3498db;
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.5);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .selected-image:hover {
        border-color: #2980b9;
        box-shadow: 0 0 15px rgba(41, 128, 185, 0.8);
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
<script>
    $('input[name="format"]').change(function() {
        $('.formatter').removeClass('selected-image');
        if ($(this).is(':checked')) {
            var imageId = $(this).attr('id');
            $('label[for="' + imageId + '"] img').addClass('selected-image');
        }
        $('input[name="format"]').removeAttr('checked');
        $(this).attr('checked', 'checked');
        $('label[for="' + $(this).attr('id') + '"] img').addClass('selected-image');
    });
</script>
<script>
    $("input[type='checkbox']").click(function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
        var val = $(this).val();
        if (val == 'email') {
            $("#formatting").css("display", "block");
        } else {
            $("#textformat").css("display", "block");
        }
    })
</script>
<script>
    $('#autocomplete').on("keyup", function() {
        var value = this.value;
        $.ajax({
            type: 'POST',
            url: "<?php echo e(route('auto.campaign_type')); ?>",
            data: {
                "type": value,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function(result) {
                console.log(result);
                $('#autocomplete-suggestions').empty();
                $.each(result, function(index, suggestion) {
                    $('#autocomplete-suggestions').append('<li class="list-group-item">' + suggestion + '</li>');
                });
                $('#autocomplete-suggestions').on('click', 'li', function() {
                    $('#autocomplete').val($(this).text());
                    $('#autocomplete-suggestions').empty();
                });
            }
        });
    });
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
<script>
    $(document).ready(function() {
        $("#recipients").click(function() {
            $("#myModal").css("display", "block");
        });
        $(".close").click(function() {
            $("#myModal").css("display", "none");
            $("#formatting").css("display", "none");
            $("#htmlmail").css("display", "none");
            $("#textformat").css("display", "none");
        })
        $(window).click(function(event) {
            if (event.target.id === "myModal") {
                $("#myModal").css("display", "none");
            }
        });
    });
</script>
<script>
    $('input[name = "format"]').change(function(){
        var value = $(this).val();
        $('#formatting').css("display","none");
    if(value == 'html'){
        window.location.href ='<?php echo e(route("htmlmail")); ?>';
    }else{
        window.location.href ="<?php echo e(route('textmail')); ?>";
    }
    });
</script>
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/customer/index.blade.php ENDPATH**/ ?>