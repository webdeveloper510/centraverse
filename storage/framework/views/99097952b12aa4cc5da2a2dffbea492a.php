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
                                <input type='text' id='autocomplete' name= "type"class="form-control" required>
                                <ul id="autocomplete-suggestions" class="list-group"  ></ul>
                            </div>
                        </div>
                        <!--<div class="col-md-4">
                            <div class="form-group">
                                <label for="type">Select Recipients</label>
                                <select name="recipients" id="recipients" class="form-select" required>
                                    <option selected disabled>Select Recipents</option>
                                    <option value="existing_leads">Existing Leads</option>
                                    <option value="lists">Upload User List</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Select Recipients</label>
                                <input type='text' name= "recipients"class="form-control" id ="recipients" placeholder="Please Select Recipient" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type='text' name= "title"class="form-control" id ="abc"required>
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
                <a href="#"data-url="<?php echo e(route('campaign.existinguser')); ?>" data-size="lg" data-ajax-popup="true" 
                data-bs-toggle="tooltip" data-title="<?php echo e(__('User List')); ?>" title="<?php echo e(__('Select Reciients')); ?>" 
                class="btn btn-primary btn-icon m-1 close" style="float: right;"><?php echo e(__('Existing Lead')); ?></a>
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary btn-icon m-1" style="float: left;"class="form-control">
                Upload User List</button>
            </div>
        </div>
       
        <!-- <button class="btn btn-primary" class="form-control" onclick="leads_list()" >Existing Leads</button>
        <button class="btn btn-primary" class="form-control">Upload User List</button> -->
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <style>
        div#myModal {
            position: absolute;
        }
    </style>
<?php $__env->stopPush(); ?>
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
    <script>
    $(document).ready(function() {
        $("#recipients").click(function() {
        $("#myModal").css("display", "block");
        });

        $(".close").click(function() {
        $("#myModal").css("display", "none");
        });

        // Close the popup if the overlay is clicked
        $(window).click(function(event) {
        if (event.target.id === "myModal") {
            $("#myModal").css("display", "none");
        }
        });
    });
    function leads_list(){
        // $("#myModal").css("display", "none");
        // alert('hy');
    }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/customer/index.blade.php ENDPATH**/ ?>