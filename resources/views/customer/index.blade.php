@extends('layouts.admin')
@section('page-title')
{{ __('Campaign') }}
@endsection
@section('title')
{{ __('Campaign') }}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
<li class="breadcrumb-item">{{ __('Campaign') }}</li>

@endsection
@section('content')
<link rel="stylesheet" href="https://editor.unlayer.com/embed.css">
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
<script src="https://editor.unlayer.com/embed.js"></script>
{{ Form::open(array('route' => 'customer.sendmail','method' =>'post')) }}
<!-- <div class="main-div">
    <div class="row mt-3">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-2">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#useradd-1" class="list-group-item list-group-item-action">{{ __('Campaign') }} <div
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
                        
                    </div>
                    
                    <div class="container">
                    <div id="editor" style ="height:500px !important ;display:none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="container-field">
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
                    <a href="#useradd-1" class="list-group-item list-group-item-action">
                        <span class="fa-stack fa-lg pull-left"><i class="ti ti-calendar"></i></span>
                        <span class="dash-mtext">{{ __('Campaign') }} </span></a>
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
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{Form::close()}}
@endsection
@push('script-page')
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
                url: "{{route('auto.campaign_type')}}",
                data: {
                    "type": value,
                    "_token": "{{ csrf_token() }}",
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
@endpush