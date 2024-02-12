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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://editor.unlayer.com/embed.js"></script>
<?php echo e(Form::open(array('route' => 'customer.sendmail','method' =>'post'))); ?>

<div class="main-div">
    <div class="row mt-3">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-2">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#useradd-1" class="list-group-item list-group-item-action"><?php echo e(__('Campaign')); ?> <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <input type='text' id='autocomplete' name= "type"class="form-control" required>
                                <ul id="autocomplete-suggestions" class="list-group"  ></ul>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type">Select Recipients</label>
                                <select name="recipients" id="recipients" class="form-select" required>
                                    <option selected disabled>Select Recipents</option>
                                    <option value="Lists">Lists</option>
                                    <option value="Leads/Events">Leads/Events</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type='text' name= "title"class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4">
                            <label for="type">Notify as:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="email" value="email" name = "notify[1][]">
                                <label class="form-check-label" for="email">Email</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="text" value="text"  name = "notify[1][]">
                                <label class="form-check-label" for="text">Text</label>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="type">Select Recipients</label>
                                <select name="recipients" id="recipients" class="form-select" required>
                                    <option selected disabled>Select Recipents</option>
                                    <option value="Lists">Lists</option>
                                    <option value="Leads/Events">Leads/Events</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type='text' name= "title"class="form-control" required>
                            </div>
                        </div> -->
                    </div>
                        <!-- <div class="row">
                            <div class="col-sm-10">
                                <select class="form-select" name="template">
                                    <option selected disabled>Select Template</option>
                                    <?php $__currentLoopData = $emailtemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($template->id); ?>"><?php echo e($template->subject); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <input type="submit" class="btn btn-primary" value="Send Email">
                            </div>
                        </div> -->
                    
                    <!-- <div class="card" id = "useradd-1">
                        <div class="card-body table-border-style">
                            <div class="table-responsive overflow_hidden">
                                <table id="datatable" class="table align-items-center datatable">

                                    <thead class="thead-light">
                                        <tr>
                                            <th></th>
                                            <th scope="col" class="sort" data-sort="username"><?php echo e(__('Customer Name')); ?></th>
                                            <th scope="col" class="sort" data-sort="email"><?php echo e(__('Email')); ?></th>
                                            <th scope="col" class="sort" data-sort="phone"><?php echo e(__('Phone')); ?></th>
                                            <th scope="col" class="sort" data-sort="address"><?php echo e(__('Address')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="checkall" id="checkall" class="form-check-input">
                                            </td>
                                        </tr>
                                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="form-check-input align-middle ischeck" value="<?php echo e($customer->email); ?>" name="customer[]">
                                            </td>
                                            <td>
                                                <span class="budget"><b><?php echo e(ucfirst($customer->name)); ?></b></span>
                                            </td>
                                            <td>
                                                <span class="budget"><?php echo e($customer->email); ?></span>
                                            </td>
                                            <td>
                                                <span class="budget"><?php echo e($customer->phone); ?></span>
                                            </td>
                                            <td>
                                                <span class="budget"><?php echo e($customer->lead_address); ?></span>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
                    <div class="container">
                    <div id="editor" style ="height:500px !important ;display:none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo e(Form::close()); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<script>
    $("input[type='checkbox']").click(function(){
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
        var val = $(this).val();
        if(val == 'email'){
            $('#editor').show();
        }else{
            $('#editor').hide();
        }
    })

    $(document).ready(function() {
        var unlayer = $('#editor-container').unlayer({
            apiKey: '1JIEPtRKTHWUcY5uMLY4TWFs2JHUbYjAcZIyd6ubblfukgU6XfAQkceYXUzI1DpR',
        });
    });
    unlayer.init({
        id: 'editor',
        projectId: 119381,
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
                    $('#autocomplete-suggestions').on('click', 'li', function () {
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/customer/index.blade.php ENDPATH**/ ?>