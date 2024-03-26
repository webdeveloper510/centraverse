@extends('layouts.admin')
@section('page-title')
    {{ __('Event') }}
@endsection
@section('title')
    {{ __('Event') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Event') }}</li>
@endsection
@section('action-btn')
    @can('Create Meeting')
        <div class="col-12 text-end mt-3">
            <a href="{{ route('meeting.create',['meeting',0]) }}"> 
                <button  data-bs-toggle="tooltip"title="{{ __('Create') }}" class="btn btn-sm btn-primary btn-icon m-1">
                <i class="ti ti-plus"></i></button>
            </a>
        </div>
    @endcan
@endsection
@section('filter')
@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="card" id ="useradd-1">
                        <div class="card-body table-border-style">
                            <div class="table-responsive overflow_hidden">
                                <table id="datatable" class="table datatable align-items-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="sort" data-sort="name">{{ __('Event') }}</th>
                                            <th scope="col" class="sort" data-sort="status">{{ __('Status') }}</th>
                                            <th scope="col" class="sort" data-sort="completion">{{ __('Date Start') }}</th>
                                            <th scope="col" class="sort" data-sort="completion">{{ __('Event') }}</th>
                                            <th scope="col" class="sort" data-sort="completion">{{ __('Assigned Staff') }}</th>
                                            @if (Gate::check('Show Meeting') || Gate::check('Edit Meeting') || Gate::check('Delete Meeting'))
                                                <th scope="col" class="text-end">{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($meetings as $meeting)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('meeting.edit', $meeting->id) }}" data-size="md"
                                                        data-title="{{ __('Event Details') }}" class="action-item text-primary">
                                                        @if($meeting->attendees_lead != 0)
                                                    {{ucfirst(\App\Models\Lead::where('id',$meeting->attendees_lead)->pluck('leadname')->first())}} 
                                                @else
                                                {{ucfirst($meeting->eventname)}}
                                                @endif
                                                </a>
                                                </td>
                                                <td>
                                                    @if ($meeting->status == 0)
                                                        <span class="badge bg-info p-2 px-3 rounded">{{ __(\App\Models\Meeting::$status[$meeting->status]) }}</span>
                                                    @elseif($meeting->status == 1)
                                                        <span class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Meeting::$status[$meeting->status]) }}</span>
                                                    @elseif($meeting->status == 2)
                                                        <span class="badge bg-success p-2 px-3 rounded">{{ __(\App\Models\Meeting::$status[$meeting->status]) }}</span>
                                                    @elseif($meeting->status == 3)
                                                        <span class="badge bg-success p-2 px-3 rounded">{{ __(\App\Models\Meeting::$status[$meeting->status]) }}</span>
                                                    @elseif($meeting->status == 4)
                                                        <span class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Meeting::$status[$meeting->status]) }}</span>
                                                    @elseif($meeting->status == 5)
                                                        <span class="badge bg-danger p-2 px-3 rounded">{{ __(\App\Models\Meeting::$status[$meeting->status]) }}</span>
                                                    
                                                        @endif
                                                </td>
                                                <td>
                                                    <span class="budget">{{ \Auth::user()->dateFormat($meeting->start_date) }}</span>
                                                </td>
                                                <td>
                                                    <span class="budget">{{ $meeting->type }}</span>
                                                </td>
                                            
                                                <td>
                                                    <span class="budget">{{ App\Models\User::where('id',$meeting->user_id)->pluck('name')->first() }}</span>
                                                </td>
                                                @if (Gate::check('Show Meeting') || Gate::check('Edit Meeting') || Gate::check('Delete Meeting'))
                                                    <td class="text-end">
                                                    @if($meeting->status == 0 )
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" data-size="md"
                                                            data-url="{{ route('meeting.share', $meeting->id) }}"
                                                            data-ajax-popup="true" data-bs-toggle="tooltip"
                                                            data-title="{{ __('Event Details') }}"title="{{ __('Share') }}"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-share"></i>
                                                        </a>
                                                    </div>
                                                    @elseif($meeting->status == 1 ||$meeting->status == 4)
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" data-size="md"
                                                            data-title="{{ __('Agreement') }}"title="{{ __('Agreement Sent') }}"
                                                            data-bs-toggle="tooltip"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-clock"></i>
                                                        </a>
                                                    </div>
                                                    @elseif($meeting->status == 2 ||$meeting->status == 3)
                                                    <div class="action-btn bg-primary ms-2">
                                                            <a href="{{route('meeting.review',urlencode(encrypt($meeting->id)))}}" data-size="md"
                                                                data-title="{{ __('Agreement') }}"title="{{ __('Review Agreement') }}"
                                                                data-bs-toggle="tooltip"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                                <i class="fa fa-pen"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                    @if(App\Models\Billing::where('event_id',$meeting->id)->exists())

                                                    <div class="action-btn bg-success ms-2">
                                                        <a href="{{route('meeting.agreement',urlencode(encrypt($meeting->id))) }}" 
                                                        data-bs-toggle="tooltip"
                                                            data-title="{{__('Agreement')}}"title="{{__('View Agreement')}}" 
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white">
                                                            <i class="ti ti-receipt"></i>
                                                        </a>
                                                    </div>
                                                    
                                                        @endif
                                                        @can('Show Meeting')
                                                            <div class="action-btn bg-warning ms-2">
                                                                <a href="#" data-size="md"
                                                                    data-url="{{ route('meeting.show', $meeting->id) }}"
                                                                    data-ajax-popup="true" data-bs-toggle="tooltip"
                                                                    data-title="{{ __('Event Details') }}"title="{{ __('Quick View') }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                                    <i class="ti ti-eye"></i>
                                                                </a>
                                                            </div>
                                                        @endcan
                                                        @can('Edit Meeting')
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="{{ route('meeting.edit', $meeting->id) }}"
                                                                    class="mx-3 btn btn-sm d-inline-flex align-items-center text-white"
                                                                    data-bs-toggle="tooltip" data-title="{{ __('Details') }}"
                                                                    title="{{ __('Edit') }}"><i class="ti ti-edit"></i></a>
                                                            </div>
                                                        @endcan
                                                        @can('Delete Meeting')
                                                            <div class="action-btn bg-danger ms-2">
                                                                {!! Form::open(['method' => 'DELETE', 'route' => ['meeting.destroy', $meeting->id]]) !!}
                                                                <a href="#!"
                                                                    class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
                                                                    data-bs-toggle="tooltip" title='Delete'>
                                                                    <i class="ti ti-trash"></i>
                                                                </a>
                                                                {!! Form::close() !!}
                                                            </div>
                                                        @endcan
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script-page')
    <script>
        $(document).on('change', 'select[name=parent]', function() {

            var parent = $(this).val();

            getparent(parent);
        });

        function getparent(bid) {

            $.ajax({
                url: '{{ route("meeting.getparent") }}',
                type: 'POST',
                data: {
                    "parent": bid,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    console.log(data);
                    $('#parent_id').empty();
                    {{-- $('#parent_id').append('<option value="">{{__('Select Parent')}}</option>'); --}}

                    $.each(data, function(key, value) {
                        $('#parent_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
    </script>
@endpush