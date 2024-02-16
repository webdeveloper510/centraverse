@extends('layouts.admin')
@section('page-title')
{{ __('HTML Mail') }}
@endsection
@section('title')
{{ __('HTML mail') }}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
<li class="breadcrumb-item">{{ __('HTML Mail') }}</li>

@endsection
@section('content')
<script src="https://editor.unlayer.com/embed.js"></script>
<div class="container-field">
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush sidebar-nav nav-pills nav-stacked" id="menu">
                    <a href="#useradd-1" class="list-group-item list-group-item-action">
                        <span class="fa-stack fa-lg pull-left"><i class="ti ti-mail"></i></span>
                        <span class="dash-mtext">{{ __('HTML Mail') }} </span></a>
                </div>
            </div>
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="editor" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script-page')
<script>
    $(document).ready(function() {
        var unlayer = $('#editor-container').unlayer({
            apiKey: '1JIEPtRKTHWUcY5uMLY4TWFs2JHUbYjAcZIyd6ubblfukgU6XfAQkceYXUzI1DpR',
        });
    });
    unlayer.init({
        appearance: {
            panels: {
            tools: {
                dock: 'left'
            }
            }
        },
        id: 'editor',
        projectId: 119381,
    })
</script>
@endpush