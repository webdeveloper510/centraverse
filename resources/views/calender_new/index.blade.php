@extends('layouts.admin')
@section('page-title')
{{__('Calendar')}}
@endsection
@section('title')
{{__('Calendar')}}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
<li class="breadcrumb-item">{{__('Calendar')}}</li>
@endsection
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

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div id="calendar"></div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-4">Event lists
                        <a href="{{ route('meeting.create',['meeting',0]) }}" style="float: right;"
                            data-date-selected="" id="selectedDate">
                            <button data-bs-toggle="tooltip" title="{{ __('Create') }}"
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

<!-- <div id="overlay"></div>
<div id="popup-form" style="border:solid 1px black;">
    <div class="row step1 blocked" data-popdate="">
        <div class="card">
            <div class="col-md-12">
                {{ Form::open(['route' => 'meeting.blockdate', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                <div class="card-header">
                    <div class="row">
                        <div class="col-12">
                            <h5>{{ __('Block Date') }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Venue</label>
                                <div class="checkbox-container d-flex flex-wrap">
                                    @foreach ($venue as $value => $label)
                                    <div class="form-check mx-2">
                                        <input class="form-check-input venue-checkbox" type="checkbox" id="{{ $value }}" name="venue[]" value="{{ $label }}">
                                        <label class="form-check-label" for="{{ $value }}">{{ $label }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('start_date', __('Start Date'), ['class' => 'form-label']) }}
                                {!! Form::date('start_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('start_time', __('Start Time'), ['class' => 'form-label']) }}
                                {!! Form::time('start_time', '00:00', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('end_date', __('End Date'), ['class' => 'form-label']) }}
                                {!! Form::date('end_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required','required' => 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('end_time', __('End Time'), ['class' => 'form-label']) }}
                                {!! Form::time('end_time', '00:00', ['class' => 'form-control', 'required' => 'required']) !!}
                            </div>
                        </div>                         
                        <div class="col-12">
                            <div class="form-group">
                                {{Form::label('purpose',__('Purpose'),['class'=>'form-label']) }}
                                {{Form::textarea('purpose',null,['class'=>'form-control','rows'=>2])}}
                            </div>
                        </div>                       
                    </div>
                </div>
                <div class="card-footer text-end">
                    {{ Form::submit(__('Block'), ['id'=>'block','class' => 'btn  btn-primary ']) }}
                    <button class="btn btn-primary" id="unblock" data-bs-toggle="tooltip" title="{{__('Close')}}" style="display:none">Unblock</button>
                    <p class="btn  btn-primary close-popup" data-bs-toggle="tooltip" title="{{__('Close')}}">Close</p>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>

</div> -->
    @endsection
    @push('script-page')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
    $(document).on('click', 'button.fc-next-button', function() {
        var month = $('.fc-toolbar-title').text();
        var date = new Date(month);
        // Get the month and year separately
        var monthNumber = date.getMonth() + 1; // Adding 1 because month index starts from 0
        var year = date.getFullYear();
        $.ajax({
            url: "{{route('monthbaseddata')}}",
            type: 'POST',
            data: {
                "month": monthNumber,
                "year": year,
                "_token": "{{ csrf_token() }}",
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
            url: "{{route('monthbaseddata')}}",
            type: 'POST',
            data: {
                "month": monthNumber,
                "year": year,
                "_token": "{{ csrf_token() }}",
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
    $(document).ready(function() {
        display_count();
        setTimeout(() => {
            var month = $('.fc-toolbar-title').text();
            var date = new Date(month);
            // Get the month and year separately
            var monthNumber = date.getMonth() + 1; // Adding 1 because month index starts from 0
            var year = date.getFullYear();
            $.ajax({
                url: "{{route('monthbaseddata')}}",
                type: 'POST',
                data: {
                    "month": monthNumber,
                    "year": year,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
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
            // console.log('dsf'+ month);
        }, 2450);

    });

    function display_count() {
        var events = new Array();
        $.ajax({
            url: '{{route("eventinformation")}}',
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
                        timeGridDay: "{{ __('Day') }}",
                        timeGridWeek: "{{ __('Week') }}",
                        dayGridMonth: "{{ __('Month') }}"
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
                    select: function(start, end, allDay, info) {

                        var selectedStartDate = start.startStr;
                        var selectedEndDate = start.endStr;
                        var formattedStartDate = moment(selectedStartDate).format(
                            'dddd, MMMM DD, YYYY');
                        var selectedDate = moment(selectedStartDate).format('Y-MM-DD');
                        sessionStorage.setItem('selectedDate', selectedDate);
                        document.getElementById('daySelected').innerHTML = formattedStartDate;
                        document.getElementById('selectedDate').setAttribute(
                            'data-date-selected',
                            selectedDate);
                        fetch("{{url('/calender-meeting-data')}}?start=" + start.startStr, {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-Token": "{{ csrf_token() }}",
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
                                        var start = event.start_time;
                                        var start_time = moment(start, 'HH:mm:ss')
                                            .format('h:mm A');
                                        var end = event.end_time;
                                        var end_time = moment(end, 'HH:mm:ss')
                                            .format(
                                                'h:mm A');
                                        if (event.attendees_lead == 0) {
                                            eventname = event.eventname;
                                        } else {
                                            eventname = 'event';
                                        }
                                        lists = `
                            <li class="list-group-item card mb-3" data-index="${index}">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-info">
                                                <i class="ti ti-calendar-event"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="m-0">${eventname} (${event.name})</h6>
                                                <small class="text-muted">${start_time} - ${end_time}</small>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                        </li>
                        `;
                                        Json.push(lists);
                                    });
                                    document.getElementById('listEvent').innerHTML = Json
                                        .join(
                                            '');
                                } else {
                            //         var startDate = start.startStr;
                            // var endDate = start.endStr;
                            // localStorage.setItem('startDate', JSON.stringify(start));
                            // openPopupForm(startDate, endDate);
                                        lists = `<h6 class="m-0">No event found!</h6>`;
                                    document.getElementById('listEvent').innerHTML = lists;
                                }
                                calendar.refetchEvents();
                            })
                            .catch(console.error);
                    },

                    events: backgroundEvents
                });
                calendar.render();
            }
        })
        // $('.close-popup').on('click', function() {
        //     closePopupForm();
        // });
        // $('input[name="venue[]"]').on('change', function() {
        //     if ($(this).is(':checked')) {
        //         const valueDataString = localStorage.getItem('startDate');
        //         const valueDataArg = JSON.parse(valueDataString);
        //         var startdate = valueDataArg.startStr;
        //         var enddate = valueDataArg.endStr;
        //         let venue = $(this).val();
        //         ff(startdate, enddate, venue);
        //     } else {
        //         // console.log("deselect")

        //         $('.venue-checkbox').prop('checked', false);
        //         $('input[name="start_time"]').attr('min', '00:00');
        //         $('input[name="start_time"]').val('00:00');
        //         $('input[name="start_time"]').attr('value', '00:00');
        //         $('input[name="end_time"]').attr('min', '00:00');
        //     }
        // });

        // function ff(startdate, enddate, venue) {
        //     var url = "{{url('/buffer-time')}}";

        //     $.ajax({
        //         url: url,
        //         method: "POST",
        //         data: {
        //             "_token": "{{ csrf_token() }}",
        //             startdate: startdate,
        //             enddate: enddate,
        //             venue: venue,
        //         },
        //         success: function(data, bufferedTime) {
        //             if (data.bufferedTime) {
        //                 // console.log('Buffered Time:', data.bufferedTime);
        //                 $('input[name="start_time"]').attr('min', data.bufferedTime);
        //                 $('input[name="start_time"]').val(data.bufferedTime);
        //                 $('input[name="start_time"]').attr('value', data.bufferedTime);
        //                 $('input[name="end_time"]').attr('min', data.bufferedTime);

        //             } else {
        //                 // console.log('No data found');
        //                 $('input[name="start_time"]').attr('min', '00:00');
        //                 $('input[name="start_time"]').val('00:00');
        //                 $('input[name="start_time"]').attr('value', '00:00');
        //                 $('input[name="end_time"]').attr('min', '00:00');
        //             }
        //         },
        //         error: function(data) {
        //             console.log('error');
        //         },
        //     });
        // }

        // function openPopupForm(start, end) {
        //     var enddate = moment(end).subtract(1, 'days').format('yyyy-MM-DD');
        //     $("input[name = 'start_date']").attr('value', start);
        //     $("input[name = 'end_date']").attr('value', enddate);
        //     $("div#popup-form").show();
        // }

        // function closePopupForm() {
        //     $('#popup-form').hide();
        //     $('#overlay').hide();
        //     // document.getElementById('start_time').value = '00:00';
        //     // document.getElementById('end_time').value = '00:00';
        //     document.getElementById('purpose').value = '';
        //     $('.venue-checkbox').prop('checked', false);
        //     $('input[name="start_time"]').attr('min', '00:00');
        //     $('input[name="start_time"]').val('00:00');
        //     $('input[name="start_time"]').attr('value', '00:00');
        // }
    }

    </script>

    @endpush