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
                                    <input type='text' id='autocomplete' name="type" class="form-control" required>
                                    <ul id="autocomplete-suggestions" class="list-group"></ul>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Select Recipients</label>
                                    <input type='text' name="recipients" class="form-control" id="recipients" placeholder="Please Select Recipient" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type='text' name="title" class="form-control" id="abc" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <label for="type">Notify as:</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="email" value="email" name="notify[1][]">
                                    <label class="form-check-label" for="email">Email</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="text" value="text" name="notify[1][]">
                                    <label class="form-check-label" for="text">Text</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="editor" style="height:500px;display:none"></div>

            </div>
        </div>
    </div>
</div>
{{Form::close()}}
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
                        <a href="#" data-url="{{route('campaign.existinguser')}}" data-size="lg" data-ajax-popup="true" data-bs-toggle="tooltip" data-title="{{__('User List')}}" title="{{__('Select Reciients')}}" class="btn btn-primary btn-icon m-1 close" style="float: right;">{{__('Existing Lead')}}</a>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-icon m-1" style="float: left;" class="form-control">
                            Upload User List</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="formatting">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Email Formatting</h5>
                <button type="button" class="close btn btn-primary" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6  mt-4">
                        <input type="radio" name="format" id="format" class="form-check-input " value="html" style="display: none;">
                        <label for="format" class="form-check-label">
                            <img src="{{asset('assets/images/html-formatter.svg')}}" alt="Uploaded Image" class="img-thumbnail formatter" data-bs-toggle="tooltip" title="HTML Mail">
                        </label>
                        <h4>HTML Mail</h4>
                    </div>
                    <div class="col-6  mt-4">
                        <input type="radio" name="format" id="txt" class="form-check-input " value="text" style="display: none;">
                        <label for="txt" class="form-check-label">
                            <img src="{{asset('assets/images/text.svg')}}" alt="Uploaded Image" class="img-thumbnail formatter" data-bs-toggle="tooltip" title="Text Mail">
                        </label>
                        <h4>Text Mail</h4>

                    </div>
                    <!-- <div class="col-md-12"style="display:flex"> -->
                    <!-- <div class="form-group formatter"> -->
                    <!-- <img src="{{asset('assets/images/html-formatter.svg')}}" alt="formatter" id="formatter"> -->
                    <!-- <h5>HTML MAIL</h5>   -->
                    <!-- </div> -->
                    <!-- <div class="form-group formatter">

            <img src="{{asset('assets/images/text.svg')}}" alt="formatter" id="text-icon">
            <h5>TEXT MAIL</h5>
                </div> -->
                    <!-- <button class="btn btn-primary btn-icon m-1" style="float: left;"class="form-control">
                Upload User List</button> -->
                    <!-- </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css-page')
<style>
    div#myModal {
        position: absolute;
    }

    .formatter {
        background: #e3e8ef;
        width: 18%;
        padding: 10px;
        border-radius: 7px;
    }

    #formatter {
        width: 80px;
        height: 80px;
    }

    img#text-icon {
        background: #e3e8ef;
        width: 80px;
        height: 80px;
        padding: 8px;
        border-radius: 7px;
    }

    .selected-image {
        border: 2px solid #3498db;
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.5);
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .selected-image:hover {
        border-color: #2980b9;
        box-shadow: 0 0 15px rgba(41, 128, 185, 0.8);
    }
</style>
@endpush
@push('script-page')
<script>
    $('input[name="format"]').change(function() {
        $('.formatter').removeClass('selected-image');
        if ($(this).is(':checked')) {
            var imageId = $(this).attr('id');
            $('label[for="' + imageId + '"] img').addClass('selected-image');
        }
        $('input[name="format"]').removeAttr('checked');
        $(this).attr('checked', 'checked');
            $('label[for="' + $(this).attr('id') + '"] img').addClass('selected-image');
    });
</script>
<script>
    $("input[type='checkbox']").click(function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
        var val = $(this).val();
        if (val == 'email') {
            $("#formatting").css("display", "block");
            // $('#editor').show();
        } else {
            // $('#editor').hide();
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
                $('#autocomplete-suggestions').on('click', 'li', function() {
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
            $("#formatting").css("display", "none");
        });

        // Close the popup if the overlay is clicked
        $(window).click(function(event) {
            if (event.target.id === "myModal") {
                $("#myModal").css("display", "none");
            }
        });
    });
</script>
@endpush