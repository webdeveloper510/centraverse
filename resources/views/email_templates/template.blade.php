@extends('layouts.admin')

@section('page-title')
    {{ __('Email Templates') }}
@endsection

@section('title')
    {{ __('Email Templates') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Email Templates') }}</li>
@endsection

@push('css-page')
    <link rel="stylesheet" href="{{ asset('css/summernote/summernote-bs4.css') }}">
@endpush

@push('script-page')
    <script src="{{ asset('css/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('js/plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        if ($(".pc-tinymce-2").length) {
            tinymce.init({
                selector: '.pc-tinymce-2',
                height: "400",
                content_style: 'body { font-family: "Inter", sans-serif; }'
            });
        }

        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
            });
        });

    </script>
@endpush
@section('content')
<div class="row">

        <div class="col-12">
            <div class="row">

            </div>
            <div class="card">
                <div class="card-body">

                    <div class="language-wrap">
                        <div class="row">
                            <div class="col-lg-12 col-md-9 col-sm-12 language-form-wrap">
                                {{ Form::model($currEmailTempLang, ['route' => ['email_template.update', $currEmailTempLang->parent_id], 'method' => 'PUT']) }}
                                <div class="row">
                                    <div class="form-group col-12">
                                        {{ Form::label('subject', __('Subject'), ['class' => 'form-control-label text-dark']) }}
                                        {{ Form::text('subject', null, ['class' => 'form-control font-style', 'required' => 'required']) }}
                                    </div>

                                    <div class="form-group col-md-6">
                                        {{ Form::label('name', __('Name'), ['class' => 'form-control-label text-dark']) }}
                                        {{ Form::text('name', $emailTemplate->name, ['class' => 'form-control font-style', 'disabled' => 'disabled']) }}
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{ Form::label('from', __('From'), ['class' => 'form-control-label text-dark']) }}
                                        {{ Form::text('from', $emailTemplate->from, ['class' => 'form-control font-style', 'required' => 'required']) }}
                                    </div>
                                    <div class="form-group col-12">
                                        {{ Form::label('content', __('Email Message'), ['class' => 'form-control-label text-dark']) }}
                                        {{ Form::textarea('content', $currEmailTempLang->content, ['class' => 'summernote', 'required' => 'required']) }}

                                    </div>


                                    <div class="col-md-12 text-end">
                                        {{ Form::hidden('lang', null) }}
                                        <input type="submit" value="{{ __('Save') }}"
                                            class="btn btn-print-invoice  btn-primary">
                                    </div>

                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection