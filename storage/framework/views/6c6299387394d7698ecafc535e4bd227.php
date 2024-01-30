
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Calendar')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Calendar')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Calendar')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Meeting')): ?>
            <a href="<?php echo e(route('meeting.create',['meeting',0])); ?>" data-title="<?php echo e(__('Create New Event')); ?>" class="btn btn-sm btn-info">
                <?php echo e(__('Add Events')); ?>

            </a>
    <?php endif; ?>
  <div class="checkbox"><b>COMPLETED EVENTS</b></div>
  <div class="checkbox1"><b>UPCOMING EVENTS</b></div>
  <div class="checkbox2"><b>BLOCKED DATES</b></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('script-page'); ?>
<style>
.blocked-by-tooltip {
    position: absolute;
    background-color: #333;
    color: #fff;
    padding: 5px;
    border-radius: 5px;
    z-index: 1000; 
}
/* CHECKBOX 1 COMPLETED */
    .checkbox {
        width: -1px;
        height: 20px;
        float: left;
        margin-right: 10px;
        margin-left: 130px;
        margin-bottom: 14px;
        position: relative;
    }
    .checkbox:after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background-color: red;
        top: 0px;
        left: -22px;
    }
/* CHECKBOX 1 UPCOMING */
.checkbox1 {
    /* width: 26px; */
    height: 20px;
    float: left;
    margin-right: 10px;
    margin-bottom: 14px;
    position: relative;
    margin-top: 23px;
    margin-left: -147px;
}
.checkbox1:after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    background-color: green;
    top: 0px;
    left: -22px;
}
/* CHECKBOX 1 BLOCKED */
.checkbox2 {
    /* width: 26px; */
    height: 20px;
    float: left;
    margin-right: 10px;
    margin-bottom: 14px;
    margin-top: 47px;
    position: relative;
    margin-left: -147px;
}
.checkbox2:after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    background-color: Gray;
    top: 0px;
    left: -22px;
}
#popup-form {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      border-radius:2px
    }

    #overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 999;
    }

</style>

<?php $__env->stopPush(); ?>
<?php
$setting = App\Models\Utility::settings();
?>


<?php $__env->startSection('content'); ?>
<div class ="blockd_dates">
<?php $__currentLoopData = $blockeddate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <input type="hidden" name="strt<?php echo e($key); ?>"  value = "<?php echo e($value->start_date); ?>">
    <input type="hidden" name="end<?php echo e($key); ?>"   value = "<?php echo e($value->end_date); ?>">
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
    <div class="row">
         <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h5 style="width: 150px;"><?php echo e(__('Calendar')); ?></h5>
                        <input type="hidden" id="path_admin" value="<?php echo e(url('/')); ?>">
                </div>
                <div class="card-body">
                    <div id='calendar' class='calendar'></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Next events</h4>
        
                    <ul class="event-cards list-group list-group-flush mt-3 w-100">
                        <?php
                            $now = Carbon\Carbon::now();
                            $this_month_meeting = \Auth::user()->type == 'owner'
                                ? App\Models\meeting::where('created_by', \Auth::user()->creatorId())->get()
                                : App\Models\meeting::where('user_id', \Auth::user()->id)->get();
                        ?>

                        <?php $__currentLoopData = $this_month_meeting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $start_date = Carbon\Carbon::parse($meeting->start_date);
                            ?>

                            <?php if($start_date >= $now): ?>
                                <li class="list-group-item card mb-3">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-auto mb-3 mb-sm-0">
                                            <div class="d-flex align-items-center">
                                                <div class="theme-avtar bg-info">
                                                    <i class="ti ti-calendar-event"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="m-0"><?php echo e($meeting->name); ?></h6>
                                                    <small class="text-muted"><?php echo e($meeting->start_date); ?> to <?php echo e($meeting->end_date); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <div id="overlay"></div>
    <div id="popup-form">
        <div class="row">
        <div  class ="card">
            <div class="col-md-12">
                <div class="card-header">
                    <?php echo e(Form::open(['route' => 'meeting.blockdate', 'method' => 'post', 'enctype' => 'multipart/form-data'])); ?>

                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <h5><?php echo e(__('Block Date')); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

                                <?php echo Form::date('start_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required']); ?>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

                                <?php echo Form::date('end_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required']); ?>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <?php echo e(Form::label('purpose',__('Purpose'),['class'=>'form-label'])); ?>

                                <?php echo e(Form::textarea('purpose',null,array('class'=>'form-control','rows'=>2))); ?>

                            </div>
                        </div> 
                    </div>
                </div>
                <div class="card-footer text-end">
                    <?php echo e(Form::submit(__('Block'), ['id'=>'block','class' => 'btn  btn-primary '])); ?>

                    <?php echo e(Form::close()); ?>

                    <button class="btn btn-primary" id= "unblock" data-bs-toggle="tooltip" title="<?php echo e(__('Close')); ?>" style ="display:none">Unblock</button> 
                    <button class="btn  btn-primary" id= "close-popup" data-bs-toggle="tooltip" title="<?php echo e(__('Close')); ?>">Close</button> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

 <?php $__env->startPush('css-page'); ?>

 <?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
<script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "dc4641f860664c6e824b093274f50291"}'></script>
<script src="<?php echo e(asset('assets/js/plugins/main.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script type="text/javascript">
    <?php
    $segment=Request::segment(2);
    ?>
    $(document).ready(function()
    {
        get_data();
    });

    function get_data()
    {
        var segment="<?php echo e($segment); ?>";
        if(segment=='call'){
            var urls=$("#path_admin").val()+"/call/get_call_data";
        }
        else if(segment=='meeting'){
            var urls=$("#path_admin").val()+"/meeting/get_meeting_data";
        }
        else if(segment=='task'){
            var urls=$("#path_admin").val()+"/task/get_task_data";
        }
        else{
            var urls=$("#path_admin").val()+"/all-data";
        }

        var calender_type=$('#calender_type :selected').val();
        // console.log("calender_type"+calender_type)
        // $('#calendar').removeClass('local_calender');
        // $('#calendar').removeClass('goggle_calender');

        if(calender_type == undefined){
            calender_type = 'local_calender';
        }
        $('#calendar').addClass(calender_type);
        $.ajax({
            url: urls ,
            method:"POST",
            data: {"_token": "<?php echo e(csrf_token()); ?>",'calender_type':calender_type},
            success: function(data) {             
                (function() {
                    var etitle;
                    var etype;
                    var etypeclass;
                    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        buttonText: {
                            timeGridDay: "<?php echo e(__('Day')); ?>",
                            timeGridWeek: "<?php echo e(__('Week')); ?>",
                            dayGridMonth: "<?php echo e(__('Month')); ?>"
                        },
                        slotLabelFormat: {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    hour12: false,
                                },
                        themeSystem: 'bootstrap',
                        navLinks: true,
                        droppable: false,
                        selectable: true,
                        selectMirror: true,
                        editable: false,
                        dayMaxEvents: true,
                        handleWindowResize: true,
                        height: 'auto',
                        timeFormat: 'H(:mm)',
                        events: data,
                        select: function(info) {
                            var startDate = info.startStr;
                            var endDate =  info.endStr;
                            console.log(endDate)
                            openPopupForm(startDate,endDate);
                        },       
                        eventContent: function(arg) {
                            return {
                                html: arg.event.title,
                            };
                        },

                        eventMouseEnter: function(arg) {
                            if (arg.event.extendedProps.blocked_by) {
                                arg.el.innerHTML += '<div class="blocked-by-tooltip">' + 'By:' + arg.event.extendedProps.blocked_by + '</div>';
                            }
                        },

                        eventMouseLeave: function(arg) {
                            var tooltip = arg.el.querySelector('.blocked-by-tooltip');
                            if (tooltip) {
                                tooltip.remove();
                            }
                        },
                            });
                            calendar.render();
                        })();
                    }
                });
    $('#close-popup').on('click', function() {
        closePopupForm();
    });

    function openPopupForm(start,end) {
        $("#block").show();
        $("#unblock").hide();
        $( ".blockd_dates input" ).each(function( index ) {
            if($(this).val() == start){
                $("#unblock").show();
                $("#block").hide();
            }
        });
        var enddate = moment(end).subtract(1, 'days').format('yyyy-MM-DD');     
        $("input[name = 'start_date']").attr('value',start);
        $("input[name = 'end_date']").attr('value',enddate);
        $('#popup-form').show();
        $('#overlay').show();
    }


    function closePopupForm() {
      $('#popup-form').hide();
      $('#overlay').hide();
    }
    
    }
   $('#unblock').on('click', function() {
        var start = $('#popup-form input[name = "start_date"]').val();
        var end = $('#popup-form input[name = "end_date"]').val();
        var purpose = $('#popup-form textarea[name = "purpose"]').val();
        var url = "<?php echo e(route('meeting.unblock')); ?>";
        $.ajax({
            url : url,
            method:"POST",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                'start':start,
                'end':end,
            },
            success: function(data) {
                location.reload();
                // console.log(data);
            }
        })
    });
</script>
    <script type="text/javascript">
        $(document).on('change', 'select[name=parent]', function () {

            var parent = $(this).val();
            getparent(parent);
        });

        function getparent(bid) {
            // console.log(bid);
            $.ajax({
                url: '<?php echo e(route('call.getparent')); ?>',
                type: 'POST',
                data: {
                    "parent": bid, "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function (data) {
                    // console.log(data);
                    $('#parent_id').empty();
                    

                    $.each(data, function (key, value) {
                        $('#parent_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                    if (data == '') {
                        $('#parent_id').empty();
                    }
                }
            });
        }

        $(document).on('change', '#parents', function () {
            // console.log('h');
            var parent = $(this).val();
            getparents(parent);
        });

        function getparents(bid) {
            // console.log(bid);
            $.ajax({
                url: '<?php echo e(route("task.getparent")); ?>',
                type: 'POST',
                data: {
                    "parent": bid, "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function (data) {
                    // console.log(data);
                    $('#parent_id').empty();
                    

                    $.each(data, function (key, value) {
                        $('#parent_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                    if (data == '') {
                        $('#parent_id').empty();
                    }
                }
            });
        }
    </script>

    <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraglobe\main-file\resources\views/calendar/index.blade.php ENDPATH**/ ?>