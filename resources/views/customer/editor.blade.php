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
                        <div id="editor-container"  style="height: 700px;"></div>
                        <button class="save">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script-page')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>

<script src="https://editor.unlayer.com/embed.js"></script>
<script>
    $(document).ready(function() {
        var unlayer = $('#editor-container').unlayer({
            apiKey: '1JIEPtRKTHWUcY5uMLY4TWFs2JHUbYjAcZIyd6ubblfukgU6XfAQkceYXUzI1DpR',
        });
    });
            unlayer.init({
        id: 'editor-container',
        projectId: 119381,
        displayMode: 'email'
        })
        $('.save').click(function(){
            unlayer.exportHtml(function(data) {
            var json = data.design; // design json
            var html = data.html; // final html
            console.log(html);
            // generatePDF(html);
            })
            function generatePDF(value) {
                html2pdf(value, {
                    margin: 10,
                    filename: 'template.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                    pagebreak: { before: '.break-page' }
                })
                .then(() => {
                  
                    console.log('PDF generated successfully');
                })
                .catch((error) => {
                    console.error('Error generating PDF:', error);
                });
            }

        })
</script>
@endpush