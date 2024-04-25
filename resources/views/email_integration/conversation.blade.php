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
                                    <div class="chat-container" style="    padding: 35px;">
                                        @foreach($emailCommunications as $key => $communication)
                                        <div class="row mb-3">
                                            @if($key % 2 == 0)
                                            <div class="col-md-6">
                                                <div class="conversation border p-3 rounded" style="cursor: pointer;">
                                                    <strong>Subject: </strong>{{ ucfirst($communication->subject) }}
                                                    <span style="float:right;"><b>Sent:</b>
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
                                                                @if($communication->attachments != '')
                                                                <p class="card-text"><strong>Attachments:</strong>
                                                             <a href="{{ Storage::url('app/public/Proposal_attachments/' . $communication->lead_id . '/' . $communication->attachments) }}
" download>{{ $communication->attachments }}</a>   </p>  
@endif 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="col-md-6  offset-md-6">
                                                <div class="proposal-notes border p-3 rounded">
                                                    <strong>Customer Response:</strong>
                                                    
                                                        @foreach($proposal as $prop)
                                                        {{$prop->notes}}
                                                        <span style="float:right;"><b>Recieved:</b>
                                                       {{ $prop->created_at->format('M d, Y H:i A') }}</span>
                                                        @endforeach
                                                </div>
                                            </div>
                                            @endif
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