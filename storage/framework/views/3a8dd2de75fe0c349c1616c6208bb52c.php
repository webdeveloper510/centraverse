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
                        <a href="<?php echo e(route('meeting.create',['meeting',0])); ?>" style="float: right;" data-date-selected="" id="selectedDate">
                            <button data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-original-title="Create"><i class="ti ti-plus"></i></button>
                        </a>
                    </h3>
                    <p class="text-muted" id="daySelected"></p>
                    <ul class="event-cards list-group list-group-flush mt-3 w-100" id="listEvent"></ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap',
            selectable: true,
            select: function(start, end, allDay, info) {

                var selectedStartDate = start.startStr;
                var selectedEndDate = start.endStr;
                var formattedStartDate = moment(selectedStartDate).format('dddd, MMMM DD, YYYY');
                var selectedDate = moment(selectedStartDate).format('Y-MM-DD');
                sessionStorage.setItem('selectedDate', selectedDate);
                document.getElementById('daySelected').innerHTML = formattedStartDate;
                document.getElementById('selectedDate').setAttribute('data-date-selected', selectedDate);
                fetch("<?php echo e(url('/calender-meeting-data')); ?>?start=" + start.startStr, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-Token": "<?php echo e(csrf_token()); ?>",
                        },
                        body: JSON.stringify({
                            request_type: 'viewMeeting',
                            start: start.startStr,
                            end: start.endStr,
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        const JSON = data.events;
                        console.log(JSON);
                        if (JSON.length != 0) {
                            Json = [];
                            JSON.forEach((event, index, array) => {
                                lists = `
                            <li class="list-group-item card mb-3" data-index="${index}">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-info">
                                            <i class="ti ti-calendar-event"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="m-0">${event.name}</h6>
                                            <small class="text-muted">${event.start_time} to ${event.end_time}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        `;
                                Json.push(lists);
                            });
                            document.getElementById('listEvent').innerHTML = Json.join('');
                        } else {
                            lists = `<h6 class="m-0">No event found!</h6>`;
                            document.getElementById('listEvent').innerHTML = lists;
                        }
                        calendar.refetchEvents();
                    })
                    .catch(console.error);
            },
        })
        calendar.render();
    })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/calender_new/index.blade.php ENDPATH**/ ?>