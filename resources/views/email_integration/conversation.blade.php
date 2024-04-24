@extends('layouts.admin')
@section('page-title')
{{__('Emails')}}
@endsection
@section('title')
<div class="page-header-title">
    {{__('Email Communication')}}
</div>
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Home')}}</a></li>
<li class="breadcrumb-item"><a href="{{ route('email.index') }}">{{__('Emails')}}</a></li>
<li class="breadcrumb-item">{{__('Communication')}}</li>

@endsection
@section('action-btn')

@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <div id="email-conversations" style=" padding: 25px;">
                                        @foreach($emailCommunications as $communication)
                                        <div class="conversation mb-3 border p-3 rounded" style="cursor: pointer;">
                                            <strong>{{ ucfirst($communication->subject) }}</strong>
                                            <span style="float:right;"><b>Sent at:</b>
                                                {{ $communication->created_at->format('M d, Y H:i A') }}
                                            </span>
                                        </div>
                                        <div class="email-details" style="display: none;">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <p class="card-text"><strong>To:</strong>
                                                        {{ $communication->email }}</p>
                                                    <p class="card-text"><strong>Message:</strong>
                                                      {{ $communication->content }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        @endforeach
                                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Get all conversation elements
var conversationThreads = document.querySelectorAll('.conversation');

// Attach click event listener to each conversation thread
conversationThreads.forEach(function(thread) {
    thread.addEventListener('click', function() {
        // Toggle visibility of the email details
        var emailDetails = this.nextElementSibling;
        emailDetails.style.display = (emailDetails.style.display === 'none') ? 'block' : 'none';
    });
});
</script>

@endsection