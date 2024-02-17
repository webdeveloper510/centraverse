@extends('layouts.admin')
@section('breadcrumb')
@endsection
@section('page-title')
{{ __('Home') }}
@endsection
@section('title')
{{ __('Dashboard') }}
@endsection
@section('action-btn')
@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
                    <a href="#useradd-1" class="list-group-item list-group-item-action"><span class="fa-stack fa-lg pull-left"><i class="ti ti-home-2"></i></span>
                        <span class="dash-mtext">{{ __('Dashboard') }} </span></a>
                    </a>
                </div>
            </div>
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <!-- <div class="col-lg-12"> -->
                        @if (\Auth::user()->type == 'owner')
                        <div class="col-lg-3 col-6 totallead"style="padding: 15px;">
                            <div class="card">
                                <div class="card-body" onclick="leads();">
                                    <div class="theme-avtar bg-info">
                                        <i class="fas fa-address-card"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"></p>
                                    <h6 class="mb-3">{{ __('Total Lead') }}</h6>
                                    <h3 class="mb-0">{{ $data['totalLead'] }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6" id="toggleDiv" style="padding: 15px;">
                            <div class="card">
                                <div class="card-body" onclick="toggleOptions()">
                                    <div class="theme-avtar bg-warning">
                                        <i class="ti ti-user"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"></p>
                                    <h6 class="mb-3">{{ __('Total Events') }}</h6>
                                    <h3 class="mb-0">{{ @$totalevent }} </h3>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="optionsContainer"> -->
                        <div class="col-lg-3 col-6 upcmg optionsContainer"  style="padding: 15px;">
                            <div class="card option" onclick="showUpcoming()">
                                <div class="card-body" style="height: 182px;">
                                    <div class="theme-avtar bg-info">
                                        <i class="fas fa-address-card"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"></p>
                                    <h6 class="mb-3">{{ __('Upcoming Events') }}</h6>
                                    <h4 class="mb-0">{{ @$upcoming }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6 cmplt optionsContainer"  style="padding: 15px;">
                            <div class="card option" onclick="showCompleted()">
                                <div class="card-body" style="height: 182px;">
                                    <div class="theme-avtar bg-info">
                                        <i class="fas fa-address-card"></i>
                                    </div>
                                    <p class="text-muted text-sm mt-4 mb-2"></p>
                                    <h6 class="mb-3">{{ __('Completed Events') }}</h6>
                                    <h4 class="mb-0">{{ @$completed }}</h4>
                                </div>
                            </div>
                        </div>
                        <!-- </div> -->
                        @endif

                        @php
                        $setting = App\Models\Utility::settings();
                        @endphp
                    <!-- </div> -->
                </div>
                <div class="blockd_dates">
                    @foreach($blockeddate as $key=> $value)
                    <input type="hidden" name="strt{{$key}}" value="{{$value->start_date}}">
                    <input type="hidden" name="end{{$key}}" value="{{$value->end_date}}">
                    @endforeach
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
                                <h5 style="width: 150px;">{{ __('Calendar') }}</h5>
                                <input type="hidden" id="path_admin" value="{{url('/')}}">
                            </div>
                            <div class="card-body">
                                <div id='calendar' class='calendar'></div>
                            </div>
                        </div>
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
                                        @foreach ($venue_dropdown as $value => $label)
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
                                    {!! Form::date('start_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required','min' => date('Y-m-d')]) !!}
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
                                    {!! Form::date('end_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required','required' => 'required','min' => date('Y-m-d')]) !!}
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
    </div>

    @endsection

    @push('script-page')
    <script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "dc4641f860664c6e824b093274f50291"}'></script>
    <script src="{{ asset('assets/js/plugins/main.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script type="text/javascript">
        @php
        $segment = Request::segment(2);
        @endphp
        $(document).ready(function() {
            get_data();
        });

        function get_data() {
            var segment = "{{$segment}}";
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
                    "_token": "{{ csrf_token() }}",
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
                                timeGridDay: "{{ __('Day') }}",
                                timeGridWeek: "{{ __('Week') }}",
                                dayGridMonth: "{{ __('Month') }}",
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
                var url = "{{url('/buffer-time')}}";

                $.ajax({
                    url: url,
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
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
            window.location.href = "{{ url('/meeting-upcoming') }}";
        }

        function showCompleted() {
            window.location.href = "{{ url('/meeting-completed') }}";
        }

        function leads() {
            window.location.href = "{{ url('/lead') }}";
        }
        jQuery(function() {
            $('div#toggleDiv').click(function(e) {
                e.preventDefault();
                $('div.optionsContainer').toggle('show');
            })
        })
    </script>
    @endpush