
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
<?php  
$settings = App\Models\Utility::settings();
$venue = explode(',',$settings['venue']);
?>
<style>
li.item-event {
    display: flex;
    /* justify-content: space-between; */
}

li.item-event>p:nth-child(2) {
    margin-left: 35%;
}
</style>
<style>

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

    p.close-popup {
        margin-bottom: 0 !important;
    }
</style>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div id="calendar"></div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-4">Event lists
                        <a href="<?php echo e(route('meeting.create',['meeting',0])); ?>" style="float: right;"
                            data-date-selected="" id="selectedDate">
                            <button data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                                class="btn btn-sm btn-primary btn-icon m-1" data-bs-original-title="Create"><i
                                    class="ti ti-plus"></i></button>
                        </a>
                    </h3>
                    <p class="text-muted" id="daySelected"></p>
                    <ul class="event-cards list-group list-group-flush mt-3 w-100" id="listEvent">

                    </ul>
                </div>
            </div>
        </div>
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
                                    <?php $__currentLoopData = $venue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                                <?php echo Form::date('start_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required']); ?>

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

                                <?php echo Form::date('end_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required','required' => 'required']); ?>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
    $(document).on('click', 'button.fc-next-button', function() {
        var month = $('.fc-toolbar-title').text();
        var date = new Date(month);
        // Get the month and year separately
        var monthNumber = date.getMonth() + 1; // Adding 1 because month index starts from 0
        var year = date.getFullYear();
        $.ajax({
            url: "<?php echo e(route('monthbaseddata')); ?>",
            type: 'POST',
            data: {
                "month": monthNumber,
                "year": year,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function(data) {
                var html = '';
                $(data).each(function(index, element) {
                    var start = element.start_time;
                    var start_time = moment(start, 'HH:mm:ss')
                        .format('h:mm A');
                    var end = element.end_time;
                    var end_time = moment(end, 'HH:mm:ss').format(
                        'h:mm A');
                    html += `<li class="list-group-item card mb-3">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mb-3 mb-sm-0">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-info">
                                <i class="ti ti-calendar-event"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="m-0">${element.eventname} (${element.name})</h6>
                                <small class="text-muted">${start_time} - ${end_time}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </li>`;
                });
                $('#listEvent').html(html);
            }
        });

    });
    $(document).on('click', 'button.fc-prev-button', function() {
        var month = $('.fc-toolbar-title').text();
        var date = new Date(month);
        // Get the month and year separately
        var monthNumber = date.getMonth() + 1; // Adding 1 because month index starts from 0
        var year = date.getFullYear();
        $.ajax({
            url: "<?php echo e(route('monthbaseddata')); ?>",
            type: 'POST',
            data: {
                "month": monthNumber,
                "year": year,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function(data) {
                // console.log(data);
                var html = '';
                $(data).each(function(index, element) {
                    var start = element.start_time;
                    var start_time = moment(start, 'HH:mm:ss')
                        .format('h:mm A');
                    var end = element.end_time;
                    var end_time = moment(end, 'HH:mm:ss').format(
                        'h:mm A');
                    html += `<li class="list-group-item card mb-3">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mb-3 mb-sm-0">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-info">
                                <i class="ti ti-calendar-event"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="m-0">${element.eventname} (${element.name})</h6>
                                <small class="text-muted">${start_time} - ${end_time}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </li>`;
                });
                $('#listEvent').html(html);
            }
        });

    });
    // $(document).ready(function() {
    //     display_count();
    //     setTimeout(() => {
    //         var month = $('.fc-toolbar-title').text();
    //         var date = new Date(month);
    //         // Get the month and year separately
    //         var monthNumber = date.getMonth() + 1; // Adding 1 because month index starts from 0
    //         var year = date.getFullYear();
    //         $.ajax({
    //             url: "<?php echo e(route('monthbaseddata')); ?>",
    //             type: 'POST',
    //             data: {
    //                 "month": monthNumber,
    //                 "year": year,
    //                 "_token": "<?php echo e(csrf_token()); ?>",
    //             },
    //             success: function(data) {
    //                 console.log(data);
    //                 var html = '';
    //                 $(data).each(function(index, element) {
    //                     var start = element.start_time;
    //                     var start_time = moment(start, 'HH:mm:ss')
    //                         .format('h:mm A');
    //                     var end = element.end_time;
    //                     var end_time = moment(end, 'HH:mm:ss').format(
    //                         'h:mm A');
    //                     html += `<li class="list-group-item card mb-3">
    //             <div class="row align-items-center justify-content-between">
    //                 <div class="col-auto mb-3 mb-sm-0">
    //                     <div class="d-flex align-items-center">
    //                         <div class="theme-avtar bg-info">
    //                             <i class="ti ti-calendar-event"></i>
    //                         </div>
    //                         <div class="ms-3">
    //                             <h6 class="m-0">${element.eventname} (${element.name})</h6>
    //                             <small class="text-muted">${start_time} - ${end_time}</small>
    //                         </div>
    //                     </div>
    //                 </div>
    //             </div>
    //         </li>`;
    //                 });
    //                 $('#listEvent').html(html);
    //             }
    //         });
    //         // console.log('dsf'+ month);
    //     }, 2450);

    // });
    // function display_count() {
    //     var events = new Array();
    //     $.ajax({
    //         url: '<?php echo e(route("eventinformation")); ?>',
    //         method: 'GET',
    //         dataType: 'json',
    //         success: function(response) {
    //             var eventDates = {};
    //             // Count the number of events for each date
    //             response.forEach(function(event) {
    //                 var startDate = moment(event.start_date).format('YYYY-MM-DD');
    //                 if (eventDates[startDate]) {
    //                     eventDates[startDate]++;
    //                 } else {
    //                     eventDates[startDate] = 1;
    //                 }
    //             });
    //             // Convert the event counts into background event objects
    //             var backgroundEvents = [];
    //             for (var date in eventDates) {
    //                 backgroundEvents.push({
    //                     title: eventDates[date],
    //                     start: date,
    //                     textColor: '#fff',
    //                     display: 'background',
    //                 });
    //             }
    //             let calendarEl = document.getElementById('calendar');
    //             var calendar = new FullCalendar.Calendar(calendarEl, {
    //                 headerToolbar: {
    //                     left: 'prev,next today',
    //                     center: 'title',
    //                     right: 'dayGridMonth,timeGridWeek,timeGridDay'
    //                 },
    //                 buttonText: {
    //                     timeGridDay: "<?php echo e(__('Day')); ?>",
    //                     timeGridWeek: "<?php echo e(__('Week')); ?>",
    //                     dayGridMonth: "<?php echo e(__('Month')); ?>"
    //                 },
    //                 slotLabelFormat: {
    //                     hour: '2-digit',
    //                     minute: '2-digit',
    //                     hour12: false,
    //                 },
    //                 themeSystem: 'bootstrap',
    //                 navLinks: true,
    //                 droppable: false,
    //                 selectable: true,
    //                 selectMirror: true,
    //                 editable: false,
    //                 dayMaxEvents: true,
    //                 handleWindowResize: true,
    //                 height: 'auto',
    //                 timeFormat: 'H(:mm)',
    //                 initialView: 'dayGridMonth',
    //                 eventDisplay: 'block',
    //                 select: function(start, end, allDay, info) {

    //                     var selectedStartDate = start.startStr;
    //                     var selectedEndDate = start.endStr;
    //                     var formattedStartDate = moment(selectedStartDate).format(
    //                         'dddd, MMMM DD, YYYY');
    //                     var selectedDate = moment(selectedStartDate).format('Y-MM-DD');
    //                     sessionStorage.setItem('selectedDate', selectedDate);
    //                     document.getElementById('daySelected').innerHTML = formattedStartDate;
    //                     document.getElementById('selectedDate').setAttribute(
    //                         'data-date-selected',
    //                         selectedDate);
    //                     fetch("<?php echo e(url('/calender-meeting-data')); ?>?start=" + start.startStr, {
    //                             method: "POST",
    //                             headers: {
    //                                 "Content-Type": "application/json",
    //                                 "X-CSRF-Token": "<?php echo e(csrf_token()); ?>",
    //                             },
    //                             body: JSON.stringify({
    //                                 request_type: 'viewMeeting',
    //                                 start: start.startStr,
    //                                 end: start.endStr,
    //                             }),
    //                         })
    //                         .then(response => response.json())
    //                         .then(data => {
    //                             const JSON = data.events;
    //                             console.log(JSON);

    //                             if (JSON.length != 0) {
    //                                 Json = [];
    //                                 JSON.forEach((event, index, array) => {
    //                                     var start = event.start_time;
    //                                     var start_time = moment(start, 'HH:mm:ss')
    //                                         .format('h:mm A');
    //                                     var end = event.end_time;
    //                                     var end_time = moment(end, 'HH:mm:ss')
    //                                         .format(
    //                                             'h:mm A');
    //                                     if (event.attendees_lead == 0) {
    //                                         eventname = event.eventname;
    //                                     } else {
    //                                         eventname = 'event';
    //                                     }
    //                                     lists = `
    //                         <li class="list-group-item card mb-3" data-index="${index}">
                            
    //                             <div class="row align-items-center justify-content-between">
    //                                 <div class="col-auto mb-3 mb-sm-0">
    //                                     <div class="d-flex align-items-center">
    //                                         <div class="theme-avtar bg-info">
    //                                             <i class="ti ti-calendar-event"></i>
    //                                         </div>
    //                                         <div class="ms-3">
    //                                             <h6 class="m-0">${eventname} (${event.name})</h6>
                                                
    //                                             <small class="text-muted">${start_time} - ${end_time}</small>
    //                                         </div>

    //                                     </div>

    //                                 </div>
    //                             </div>
    //                     </li>
    //                     `;
    //                                     Json.push(lists);
    //                                 });
    //                                 document.getElementById('listEvent').innerHTML = Json
    //                                     .join(
    //                                         '');
    //                             } else {
    //                             var startDate = start.startStr;
    //                         var endDate = start.endStr;
    //                         // localStorage.setItem('startDate', JSON.stringify(start));
    //                         openPopupForm(startDate, endDate);
    //                                     lists = `<h6 class="m-0">No event found!</h6>`;
    //                                 document.getElementById('listEvent').innerHTML = lists;
    //                             }
    //                             calendar.refetchEvents();
    //                         })
    //                         .catch(console.error);
    //                 },

    //                 events: backgroundEvents
    //             });
    //             calendar.render();
    //         }
    //     })
    //     $('.close-popup').on('click', function() {
    //         closePopupForm();
    //     });
    //     $('input[name="venue[]"]').on('change', function() {
    //         if ($(this).is(':checked')) {
    //             const valueDataString = localStorage.getItem('startDate');
    //             const valueDataArg = JSON.parse(valueDataString);
    //             var startdate = valueDataArg.startStr;
    //             var enddate = valueDataArg.endStr;
    //             let venue = $(this).val();
    //             ff(startdate, enddate, venue);
    //         } else {
    //             // console.log("deselect")

    //             $('.venue-checkbox').prop('checked', false);
    //             $('input[name="start_time"]').attr('min', '00:00');
    //             $('input[name="start_time"]').val('00:00');
    //             $('input[name="start_time"]').attr('value', '00:00');
    //             $('input[name="end_time"]').attr('min', '00:00');
    //         }
    //     });

    //     function ff(startdate, enddate, venue) {
    //         var url = "<?php echo e(url('/buffer-time')); ?>";

    //         $.ajax({
    //             url: url,
    //             method: "POST",
    //             data: {
    //                 "_token": "<?php echo e(csrf_token()); ?>",
    //                 startdate: startdate,
    //                 enddate: enddate,
    //                 venue: venue,
    //             },
    //             success: function(data, bufferedTime) {
    //                 if (data.bufferedTime) {
    //                     // console.log('Buffered Time:', data.bufferedTime);
    //                     $('input[name="start_time"]').attr('min', data.bufferedTime);
    //                     $('input[name="start_time"]').val(data.bufferedTime);
    //                     $('input[name="start_time"]').attr('value', data.bufferedTime);
    //                     $('input[name="end_time"]').attr('min', data.bufferedTime);

    //                 } else {
    //                     // console.log('No data found');
    //                     $('input[name="start_time"]').attr('min', '00:00');
    //                     $('input[name="start_time"]').val('00:00');
    //                     $('input[name="start_time"]').attr('value', '00:00');
    //                     $('input[name="end_time"]').attr('min', '00:00');
    //                 }
    //             },
    //             error: function(data) {
    //                 console.log('error');
    //             },
    //         });
    //     }

    //     function openPopupForm(start, end) {
    //         var enddate = moment(end).subtract(1, 'days').format('yyyy-MM-DD');
    //         $("input[name = 'start_date']").attr('value', start);
    //         $("input[name = 'end_date']").attr('value', enddate);
    //         $("div#popup-form").show();
    //     }

    //     function closePopupForm() {
    //         $('#popup-form').hide();
    //         $('#overlay').hide();
    //         // document.getElementById('start_time').value = '00:00';
    //         // document.getElementById('end_time').value = '00:00';
    //         document.getElementById('purpose').value = '';
    //         $('.venue-checkbox').prop('checked', false);
    //         $('input[name="start_time"]').attr('min', '00:00');
    //         $('input[name="start_time"]').val('00:00');
    //         $('input[name="start_time"]').attr('value', '00:00');
    //     }
    // }
    $(document).ready(function() {
        get_data();
    });

    function get_data() {
      
            var urls = "<?php echo e(route('meeting.get_meeting_data')); ?>";
     

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
            // document.getElementById('start_time').value = '00:00';
            // document.getElementById('end_time').value = '00:00';
            document.getElementById('purpose').value = '';
            $('.venue-checkbox').prop('checked', false);
            $('input[name="start_time"]').attr('min', '00:00');
            $('input[name="start_time"]').val('00:00');
            $('input[name="start_time"]').attr('value', '00:00');
        }

    }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/calender_new/index.blade.php ENDPATH**/ ?>