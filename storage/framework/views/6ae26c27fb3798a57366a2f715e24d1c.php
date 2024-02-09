<?php $__env->startSection('breadcrumb'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Home')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Dashboard')); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>

<?php $__env->stopSection(); ?> 
<?php $__env->startSection('content'); ?>
<style>
    #optionsContainer {
        display: none;
        margin-top: 10px;
    }

    button {
        background-color: #007bff;
        color: #fff;
        padding: 8px 16px;
        margin-right: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }


    #optionsContainer {
        display: block;
        margin-left: 474px;
        margin-top: -16px;
        padding: 10px;
    }

    .cmplt {
        margin-left: 630px;
        margin-top: -206px;
        cursor: pointer;
    }

    #toggleDiv {
        cursor: pointer;
    }

    .totallead {
        cursor: pointer;
    }

    .upcmg {
        margin-left: 251px;
        margin-top: -201px;
        cursor: pointer;
    }

    .totallead {
        cursor: pointer;
    }

    #popup-form {
        display: none;
        /*position: fixed; */
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        border-radius: 2px;
        width: 600px;
    }

    button:hover {
        background-color: #0056b3;
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

    /* .blocked-by-tooltip {
        position: absolute;
        background-color: #333;
        color: #fff;
        padding: 5px;
        border-radius: 5px;
        z-index: 2000;      
        margin-top: -53px;
    } */

    .blocked-by-tooltip {
        position: absolute;
        background-color: #145388;
        color: #fff;
        padding: 10px;
        border-radius: 8px;
        z-index: 2000;
        margin-top: -28px;
        margin-left: -94px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease, transform 0.2s ease;
        background: linear-gradient(45deg, #145388, #145388);
    }

    .blocked-by-tooltip:hover {
        background-color: #145388;
        transform: scale(1.05);
    }


    /* CHECKBOX 1 COMPLETED */
    .checkbox {
        width: -1px;
        height: 20px;
        float: left;
        margin-right: 10px;
        margin-left: 25px;
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
        height: 20px;
        float: left;
        margin-right: 10px;
        margin-bottom: 14px;
        position: relative;
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
        height: 20px;
        float: left;
        margin-right: 10px;
        margin-bottom: 14px;
        position: relative;
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

    p.close-popup {
        margin-bottom: 0 !important;
    }
</style>
<div class="container-field">
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <?php if(\Auth::user()->type == 'owner'): ?>
                <div class="col-xxl-12">
                    <div class="row">

                        <div class="col-lg-3 col-6 totallead">
                            <div class="card">
                                <div class="card-body" onclick="leads();">
                                    <div class="theme-avtar bg-info">
                                        <i class="fas fa-address-card"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"></p>
                                    <h6 class="mb-3"><?php echo e(__('Total Lead')); ?></h6>
                                    <h3 class="mb-0"><?php echo e($data['totalLead']); ?></h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6" id="toggleDiv">
                            <div class="card">
                                <div class="card-body" onclick="toggleOptions()">
                                    <div class="theme-avtar bg-warning">
                                        <i class="ti ti-user"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"></p>
                                    <h6 class="mb-3"><?php echo e(__('Total Events')); ?></h6>
                                    <h3 class="mb-0"><?php echo e(@$totalevent); ?> </h3>
                                </div>
                            </div>
                        </div>

                        <div id="optionsContainer" style="display: none;">
                            <div class="col-lg-3 col-6 upcmg">
                                <div class="card option" onclick="showUpcoming()">
                                    <div class="card-body" style="height: 182px;">
                                        <div class="theme-avtar bg-info">
                                            <i class="fas fa-address-card"></i>
                                        </div>
                                        <p class="text-muted text-sm mt-4 mb-2"></p>
                                        <h6 class="mb-3"><?php echo e(__('Upcoming Events')); ?></h6>
                                        <h4 class="mb-0"><?php echo e(@$upcoming); ?></h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6 cmplt">
                                <div class="card option" onclick="showCompleted()">
                                    <div class="card-body" style="height: 182px;">
                                        <div class="theme-avtar bg-info">
                                            <i class="fas fa-address-card"></i>
                                        </div>
                                        <p class="text-muted text-sm mt-4 mb-2"></p>
                                        <h6 class="mb-3"><?php echo e(__('Completed Events')); ?></h6>
                                        <h4 class="mb-0"><?php echo e(@$completed); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php
                $setting = App\Models\Utility::settings();
                ?>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>

    <div class="blockd_dates">
        <?php $__currentLoopData = $blockeddate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <input type="hidden" name="strt<?php echo e($key); ?>" value="<?php echo e($value->start_date); ?>">
        <input type="hidden" name="end<?php echo e($key); ?>" value="<?php echo e($value->end_date); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="row checkbox-new">
        <div class="col-lg-4">
            <div data-colorCST="red" class="checkbox"><b>COMPLETED EVENTS</b></div>
        </div>
        <div class="col-lg-4">
            <div data-colorCST="red" class="checkbox1"><b>UPCOMING EVENTS</b></div>
        </div>
        <div class="col-lg-4">
            <div data-colorCST="red" class="checkbox2"><b>BLOCKED DATES</b></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
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

        <!-- [ sample-page ] end -->
    </div>
</div>
<div id="overlay"></div>
<div id="popup-form" style="border:solid 1px black;">
    <div class="row step1 blocked" data-popdate="">
        <div class="card">
            <div class="col-md-12">
                <?php echo e(Form::open(['route' => 'meeting.blockdate', 'method' => 'post', 'enctype' => 'multipart/form-data'])); ?>

                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <h5><?php echo e(__('Block Date')); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Venue</label>
                                <div class="checkbox-container d-flex flex-wrap">
                                    <?php $__currentLoopData = $venue_dropdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check mx-2">
                                        <input class="form-check-input venue-checkbox" type="checkbox" id="<?php echo e($value); ?>" name="venue[]" value="<?php echo e($label); ?>">
                                        <label class="form-check-label" for="<?php echo e($value); ?>"><?php echo e($label); ?></label>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

                                <?php echo Form::date('start_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required','min' => date('Y-m-d')]); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('start_time', __('Start Time'), ['class' => 'form-label'])); ?>

                                <?php echo Form::time('start_time', '00:00', ['class' => 'form-control']); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

                                <?php echo Form::date('end_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required','required' => 'required','min' => date('Y-m-d')]); ?>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('end_time', __('End Time'), ['class' => 'form-label'])); ?>

                                <?php echo Form::time('end_time', '00:00', ['class' => 'form-control', 'required' => 'required']); ?>

                            </div>
                        </div>                         
                        <div class="col-12">
                            <div class="form-group">
                                <?php echo e(Form::label('purpose',__('Purpose'),['class'=>'form-label'])); ?>

                                <?php echo e(Form::textarea('purpose',null,['class'=>'form-control','rows'=>2])); ?>

                            </div>
                        </div>                       
                    </div>
                </div>
                <div class="card-footer text-end">
                    <?php echo e(Form::submit(__('Block'), ['id'=>'block','class' => 'btn  btn-primary '])); ?>

                    <button class="btn btn-primary" id="unblock" data-bs-toggle="tooltip" title="<?php echo e(__('Close')); ?>" style="display:none">Unblock</button>
                    <p class="btn  btn-primary close-popup" data-bs-toggle="tooltip" title="<?php echo e(__('Close')); ?>">Close</p>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
<script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "dc4641f860664c6e824b093274f50291"}'></script>
<script src="<?php echo e(asset('assets/js/plugins/main.min.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script type="text/javascript">
    <?php
    $segment = Request::segment(2);
    ?>
    $(document).ready(function() {
        get_data();
    });

    function get_data() {
        var segment = "<?php echo e($segment); ?>";
        if (segment == 'call') {
            var urls = $("#path_admin").val() + "/call/get_call_data";
        } else if (segment == 'meeting') {
            var urls = $("#path_admin").val() + "/meeting/get_meeting_data";
        } else if (segment == 'task') {
            var urls = $("#path_admin").val() + "/task/get_task_data";
        } else {
            var urls = $("#path_admin").val() + "/all-data";
        }

        var calender_type = $('#calender_type :selected').val();

        if (calender_type == undefined) {
            calender_type = 'local_calender';
        }
        $('#calendar').addClass(calender_type);
        $.ajax({
            url: urls,
            method: "POST",
            data: {
                "_token": "<?php echo e(csrf_token()); ?>",
                'calender_type': calender_type
            },
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
                            dayGridMonth: "<?php echo e(__('Month')); ?>",
                        },
                        slotLabelFormat: {
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: false,
                        },
                        themeSystem: 'bootstrap',
                        navLinks: true,
                        droppable: false,
                        eventLimit: true,
                        selectable: true,
                        selectMirror: true,
                        editable: false,
                        dayMaxEvents: 1,
                        handleWindowResize: true,
                        height: 'auto',
                        timeFormat: 'H(:mm)',
                        events: data,
                        select: function(info) {
                            var startDate = info.startStr;
                            var endDate = info.endStr;
                            localStorage.setItem('startDate', JSON.stringify(info));
                            openPopupForm(startDate, endDate);
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
        $('.close-popup').on('click', function() {
            closePopupForm();
        });
        $('input[name="venue[]"]').on('change', function() {
            if ($(this).is(':checked')) {
                const valueDataString = localStorage.getItem('startDate');
                const valueDataArg = JSON.parse(valueDataString);
                var startdate = valueDataArg.startStr;
                var enddate = valueDataArg.endStr;
                let venue = $(this).val();
                ff(startdate, enddate, venue);
            } else {
                // console.log("deselect")
                $('.venue-checkbox').prop('checked', false);
                $('input[name="start_time"]').attr('min', '00:00');
                $('input[name="start_time"]').val('00:00');
                $('input[name="start_time"]').attr('value', '00:00');
                $('input[name="end_time"]').attr('min', '00:00');
            }
        });

        function ff(startdate, enddate, venue) {
            var url = "<?php echo e(url('/buffer-time')); ?>";

            $.ajax({
                url: url,
                method: "POST",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    startdate: startdate,
                    enddate: enddate,
                    venue: venue,
                },
                success: function(data, bufferedTime) {
                    if (data.bufferedTime) {
                        // console.log('Buffered Time:', data.bufferedTime);
                        $('input[name="start_time"]').attr('min', data.bufferedTime);
                        $('input[name="start_time"]').val(data.bufferedTime);
                        $('input[name="start_time"]').attr('value', data.bufferedTime);
                        $('input[name="end_time"]').attr('min', data.bufferedTime);
                    } else {
                        // console.log('No data found');
                        $('input[name="start_time"]').attr('min', '00:00');
                        $('input[name="start_time"]').val('00:00');
                        $('input[name="start_time"]').attr('value', '00:00');
                        $('input[name="end_time"]').attr('min', '00:00');
                    }
                },
                error: function(data) {
                    console.log('error');
                },
            });
        }


        function openPopupForm(start, end) {
            var enddate = moment(end).subtract(1, 'days').format('yyyy-MM-DD');
            $("input[name = 'start_date']").attr('value', start);
            $("input[name = 'end_date']").attr('value', enddate);
            $("div#popup-form").show();
        }

        function closePopupForm() {
            $('#popup-form').hide();
            $('#overlay').hide();
   
            document.getElementById('purpose').value = '';
            $('.venue-checkbox').prop('checked', false);
            $('input[name="start_time"]').attr('min', '00:00');
            $('input[name="start_time"]').val('00:00');
            $('input[name="start_time"]').attr('value', '00:00');
        }

    }
</script>

<script>
    function toggleOptions() {
        var optionsContainer = document.getElementById('optionsContainer');
        optionsContainer.style.display = optionsContainer.style.display === 'none' ? 'block' : 'none';
    }

    function showUpcoming() {
        window.location.href = "<?php echo e(url('/meeting-upcoming')); ?>";
    }

    function showCompleted() {
        window.location.href = "<?php echo e(url('/meeting-completed')); ?>";
    }

    function leads() {
        window.location.href = "<?php echo e(url('/lead')); ?>";
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/home.blade.php ENDPATH**/ ?>