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

<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz"  id="useradd-1">
                <div class="row">
                    <?php if(\Auth::user()->type == 'owner'): ?>
                        <div class="col-lg-3 col-6 totallead" style="padding: 15px;">
                            <div class="card">
                                <div class="card-body newcard_body" onclick="leads();">
                                    <div class="theme-avtar bg-info">
                                        <i class="fas fa-address-card"></i>
                                    </div>
                                    <div class="right_side">
                                        <h6 class="mb-3"><?php echo e(__('Total Lead')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($data['totalLead']); ?></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6" id="toggleDiv" style="padding: 15px;">
                            <div class="card">
                                <div class="card-body newcard_body" onclick="toggleOptions()">
                                    <div class="theme-avtar bg-warning">
                                        <i class="ti ti-user"></i>
                                    </div>
                                    <div class="right_side">
                                        <h6 class="mb-3"><?php echo e(__('Total Events')); ?></h6>
                                        <h3 class="mb-0"><?php echo e(@$totalevent); ?> </h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6 upcmg optionsContainer" style="padding: 15px;">
                            <div class="card option" onclick="showUpcoming()">
                                <div class="card-body newcard_body">
                                    <div class="theme-avtar bg-info">
                                        <i class="fas fa-address-card"></i>
                                    </div>
                                    <div class="right_side">
                                        <h6 class="mb-3"><?php echo e(__('Upcoming Events')); ?></h6>
                                        <h4 class="mb-0"><?php echo e(@$upcoming); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 cmplt optionsContainer" style="padding: 15px;">
                            <div class="card option" onclick="showCompleted()">
                                <div class="card-body newcard_body" style="">
                                    <div class="theme-avtar bg-info">
                                        <i class="fas fa-address-card"></i>
                                    </div>
                                    <div class="right_side">
                                        <h6 class="mb-3"><?php echo e(__('Completed Events')); ?></h6>
                                        <h4 class="mb-0"><?php echo e(@$completed); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php
                    $setting = App\Models\Utility::settings();
                    ?>
                </div>

                <div class="row">
                    <div class="col-sm">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Active Leads</h5>
                            <?php $__currentLoopData = $activeLeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="card">
                                <div class="card-body new_bottomcard">
                                    <h5 class="card-text"><?php echo e($lead['leadname']); ?>

                                        <span>(<?php echo e($lead['type']); ?>)</span>
                                    </h5>
                                    <?php if($lead['start_date'] == $lead['end_date']): ?>
                                    <p><?php echo e(Carbon\Carbon::parse($lead['start_date'])->format('M d')); ?></p>
                                    <?php else: ?>
                                    <p><?php echo e(Carbon\Carbon::parse($lead['start_date'])->format('M d')); ?> -
                                        <?php echo e(\Auth::user()->dateFormat($lead['end_date'])); ?>

                                    </p>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Lead')): ?>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md" data-url="<?php echo e(route('lead.show',$lead['id'])); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Lead Details')); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Lead')): ?>
                            <div class="col-12 text-end mt-3">
                                <a href="javascript:void(0);" data-url="<?php echo e(route('lead.create',['lead',0])); ?>" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Lead')); ?>" title="<?php echo e(__('Create Lead')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
                                    <i class="ti ti-plus"></i>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="col-sm">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Active/Upcoming Events</h5>
                            <?php $__currentLoopData = $activeEvent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-text"><?php echo e($event['name']); ?>

                                        <span>(<?php echo e($event['type']); ?>)</span>
                                    </h5>
                                    <?php if($event['start_date'] == $event['end_date']): ?>
                                    <p><?php echo e(Carbon\Carbon::parse($event['start_date'])->format('M d')); ?></p>
                                    <?php else: ?>
                                    <p><?php echo e(Carbon\Carbon::parse($event['start_date'])->format('M d')); ?> -
                                        <?php echo e(\Auth::user()->dateFormat($event['end_date'])); ?>

                                    </p>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Meeting')): ?>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md"
                                                data-url="<?php echo e(route('meeting.show', $event['id'])); ?>"
                                                data-ajax-popup="true" data-bs-toggle="tooltip"
                                                data-title="<?php echo e(__('Event Details')); ?>"title="<?php echo e(__('Quick View')); ?>"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Meeting')): ?>
                            <div class="col-12 text-end mt-3">
                                <a href="<?php echo e(route('meeting.create',['meeting',0])); ?>">
                                    <button data-bs-toggle="tooltip" title="<?php echo e(__('Create Event')); ?>" class="btn btn-sm btn-primary btn-icon m-1">
                                        <i class="ti ti-plus"></i></button>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                      
                    </div>
                    <div class="col-sm">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Past Events</h5>
                            <?php $__currentLoopData = $pastEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-text"><?php echo e($event['name']); ?>

                                        <span>(<?php echo e($event['type']); ?>)</span>
                                    </h5>
                                    <?php if($event['start_date'] == $event['end_date']): ?>
                                    <p><?php echo e(Carbon\Carbon::parse($event['start_date'])->format('M d')); ?></p>
                                    <?php else: ?>
                                    <p><?php echo e(Carbon\Carbon::parse($event['start_date'])->format('M d')); ?> -
                                        <?php echo e(\Auth::user()->dateFormat($event['end_date'])); ?>

                                    </p>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Meeting')): ?>
                                        <div class="action-btn bg-warning ms-2">
                                            <a href="javascript:void(0);" data-size="md"
                                                data-url="<?php echo e(route('meeting.show', $event['id'])); ?>"
                                                data-ajax-popup="true" data-bs-toggle="tooltip"
                                                data-title="<?php echo e(__('Event Details')); ?>"title="<?php echo e(__('Quick View')); ?>"
                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <div class="col-sm">
                        <div class="inner_col">
                            <h5 class="card-title mb-2">Lost Leads</h5>
                            <?php $__currentLoopData = $lostLeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-text"><?php echo e($lead['leadname']); ?>

                                        <span><?php echo e($lead['type']); ?></span>
                                    </h5>
                                    <?php if($lead['start_date'] == $lead['end_date']): ?>
                                    <p><?php echo e(Carbon\Carbon::parse($lead['start_date'])->format('M d')); ?></p>
                                    <?php else: ?>
                                    <p><?php echo e(Carbon\Carbon::parse($lead['start_date'])->format('M d')); ?> -
                                        <?php echo e(\Auth::user()->dateFormat($lead['end_date'])); ?>

                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
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
    /* function toggleOptions() {
            var optionsContainer = document.getElementsByClassName('optionsContainer')[0];
            optionsContainer.style.display = optionsContainer.style.display === 'none' ? 'block' : 'none';
        } */

    function showUpcoming() {
        window.location.href = "<?php echo e(url('/meeting-upcoming')); ?>";
    }

    function showCompleted() {
        window.location.href = "<?php echo e(url('/meeting-completed')); ?>";
    }

    function leads() {
        window.location.href = "<?php echo e(url('/lead')); ?>";
    }
    jQuery(function() {
        $('div#toggleDiv').click(function(e) {
            e.preventDefault();
            $('div.optionsContainer').toggle('show');
        })
    })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/home.blade.php ENDPATH**/ ?>