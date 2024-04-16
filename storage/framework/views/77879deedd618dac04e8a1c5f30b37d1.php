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

<style>
li.item-event {
    display: flex;
    /* justify-content: space-between; */
}

li.item-event>p:nth-child(2) {
    margin-left: 35%;
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
        <!-- <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">Next events</h4> -->
        <!-- <ul class="event-cards list-group list-group-flush mt-3 w-100">
                        <li class="list-group-item card mb-3">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-info">
                                            <i class="ti ti-calendar-event"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="m-0"></h6>
                                            <small class="text-muted"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul> -->
        <!-- </div>
            </div>
        </div> -->

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
            $(data).each(function(index, element) {
                data += `<li class="list-group-item card mb-3">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mb-3 mb-sm-0">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-info">
                                <i class="ti ti-calendar-event"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="m-0">${element.name} (${element.name})</h6>
                                <small class="text-muted">${element.start_time} - ${element.end_time}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </li>`;
            });
            $('#listEvent').html(data);
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
            $(data).each(function(index, element) {
                data = `<li class="list-group-item card mb-3">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mb-3 mb-sm-0">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-info">
                                <i class="ti ti-calendar-event"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="m-0">${element.name} (${element.name})</h6>
                                <small class="text-muted">${element.start_time} - ${element.end_time}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </li>`;
            });
            $('#listEvent').html(data);
        }
    });

});
// $(document).ready(function(){
//     var month = $('.fc-toolbar-title').text();
//     var date = new Date(month);
//     // Get the month and year separately
//     var monthNumber = date.getMonth() + 1; // Adding 1 because month index starts from 0
//     var year = date.getFullYear();
//     $.ajax({
//         url: "<?php echo e(route('monthbaseddata')); ?>",
//         type: 'GET',
//         data: {
//             "month": monthNumber,
//             "year": year,
//             "_token": "<?php echo e(csrf_token()); ?>",
//         },
//         success: function(data) {
//             $(data).each(function(index, element) {
//                 data = `<li class="list-group-item card mb-3">
//                 <div class="row align-items-center justify-content-between">
//                     <div class="col-auto mb-3 mb-sm-0">
//                         <div class="d-flex align-items-center">
//                             <div class="theme-avtar bg-info">
//                                 <i class="ti ti-calendar-event"></i>
//                             </div>
//                             <div class="ms-3">
//                                 <h6 class="m-0">${element.name} (${element.name})</h6>
//                                 <small class="text-muted">${element.start_time} - ${element.end_time}</small>
//                             </div>
//                         </div>
//                     </div>
//                 </div>
//             </li>`;
//             });
//             $('#listEvent').html(data);
//         }
//     });
// })


$(document).ready(function() {
    display_count();

});

function display_count() {
    var events = new Array();
    $.ajax({
        url: '<?php echo e(route("eventinformation")); ?>',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            var eventDates = {};
            // Count the number of events for each date
            response.forEach(function(event) {
                var startDate = moment(event.start_date).format('YYYY-MM-DD');
                if (eventDates[startDate]) {
                    eventDates[startDate]++;
                } else {
                    eventDates[startDate] = 1;
                }
            });
            // Convert the event counts into background event objects
            var backgroundEvents = [];
            for (var date in eventDates) {
                backgroundEvents.push({
                    title: eventDates[date],
                    start: date,
                    textColor: '#fff',
                    display: 'background',
                });
            }
            let calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
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
                initialView: 'dayGridMonth',
                eventDisplay: 'block',
                // select: function(start, end, allDay, info) {
                //     var selectedStartDate = start.startStr;
                //     var selectedEndDate = start.endStr;
                //     var formattedStartDate = moment(selectedStartDate).format(
                //         'dddd, MMMM DD, YYYY');
                //     var selectedDate = moment(selectedStartDate).format('Y-MM-DD');
                //     sessionStorage.setItem('selectedDate', selectedDate);
                //     document.getElementById('daySelected').innerHTML = formattedStartDate;
                //     document.getElementById('selectedDate').setAttribute('data-date-selected',
                //         selectedDate);
                //     fetch("<?php echo e(url('/calender-meeting-data')); ?>?start=" + start.startStr, {
                //             method: "POST",
                //             headers: {
                //                 "Content-Type": "application/json",
                //                 "X-CSRF-Token": "<?php echo e(csrf_token()); ?>",
                //             },
                //             body: JSON.stringify({
                //                 request_type: 'viewMeeting',
                //                 start: start.startStr,
                //                 end: start.endStr,
                //             }),
                //         })
                //         .then(response => response.json())
                //         .then(data => {
                //             const JSON = data.events;
                //             console.log(JSON);

                //             if (JSON.length != 0) {
                //                 Json = [];
                //                 JSON.forEach((event, index, array) => {
                //                     var start = event.start_time;
                //                     var start_time = moment(start, 'HH:mm:ss')
                //                         .format('h:mm A');
                //                     var end = event.end_time;
                //                     var end_time = moment(end, 'HH:mm:ss').format(
                //                         'h:mm A');
                //                     if (event.attendees_lead == 0) {
                //                         eventname = event.eventname;
                //                     } else {
                //                         eventname = 'event';
                //                     }
                //                     lists = `
                //             <li class="list-group-item card mb-3" data-index="${index}">
                //                 <div class="row align-items-center justify-content-between">
                //                     <div class="col-auto mb-3 mb-sm-0">
                //                         <div class="d-flex align-items-center">
                //                             <div class="theme-avtar bg-info">
                //                                 <i class="ti ti-calendar-event"></i>
                //                             </div>
                //                             <div class="ms-3">
                //                                 <h6 class="m-0">${eventname} (${event.name})</h6>
                //                                 <small class="text-muted">${start_time} - ${end_time}</small>
                //                             </div>

                //                         </div>

                //                     </div>
                //                 </div>
                //         </li>
                //         `;
                //                     Json.push(lists);
                //                 });
                //                 document.getElementById('listEvent').innerHTML = Json.join(
                //                     '');
                //             } else {
                //                 lists = `<h6 class="m-0">No event found!</h6>`;
                //                 document.getElementById('listEvent').innerHTML = lists;
                //             }
                //             calendar.refetchEvents();
                //         })
                //         .catch(console.error);
                // },
                // events: backgroundEvents
            });
            calendar.render();
        }
    })
}
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmcentraverse/public_html/resources/views/calender_new/index.blade.php ENDPATH**/ ?>