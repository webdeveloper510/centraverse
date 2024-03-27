@extends('layouts.admin')
@section('page-title')
{{ __('Billing') }}
@endsection
@section('title')
{{ __('Billing') }}
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
<li class="breadcrumb-item">{{ __('Billing') }}</li>
@endsection
@section('content')
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <div class="table-responsive overflow_hidden">
                                    <table id="datatable" class="table datatable align-items-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">{{ __('Name') }}</th>
                                                <th scope="col" class="sort" data-sort="status">{{ __('Event') }}</th>
                                                <th scope="col" class="sort" data-sort="completion">
                                                    {{ __('Event Date') }}</th>
                                                <th scope="col" class="sort" data-sort="completion">
                                                    {{ __('Payment Status') }}</th>
                                                <th scope="col" class="text-end">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($events as $event)
                                            <tr>
                                                <td>
                                                    <a href="" data-size="md" data-title="{{ __('Billing Details') }}"
                                                        class="action-item text-primary">
                                                        {{ ucfirst($event->name)}}
                                                    </a>
                                                </td>
                                                <td>
                                                    <span class="budget">{{ ucfirst($event->type)}}</span>
                                                </td>
                                                <td>
                                                    @if($event->start_date == $event->end_date)
                                                    <span
                                                        class="budget">{{\Auth::user()->dateFormat($event->start_date)}}</span>
                                                    @elseif($event->start_date != $event->end_date)
                                                    <span
                                                        class="budget">{{ Carbon\Carbon::parse($event->start_date)->format('M d')}}
                                                        - {{\Auth::user()->dateFormat($event->end_date)}}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(\App\Models\Billing::where('event_id',$event->id)->exists())
                                                    <?php $bill = \App\Models\Billing::where('event_id', $event->id)->pluck('status')->first() ?>
                                                    @if($bill == 1)
                                                    <span
                                                        class=" text-info">{{__(\App\Models\Billing::$status[$bill]) }}</span>
                                                    @elseif($bill == 2)
                                                    <span
                                                        class=" text-warning ">{{__(\App\Models\Billing::$status[$bill]) }}</span>
                                                    @else($bill == 3)
                                                    <span
                                                        class=" text-success">{{__(\App\Models\Billing::$status[$bill]) }}</span>
                                                    @endif
                                                    @else
                                                    <span
                                                        class=" text-danger ">{{__(\App\Models\Billing::$status[0]) }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    @if(!(\App\Models\Billing::where('event_id',$event->id)->exists()))

                                                    @can('Create Payment')
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" data-size="md"
                                                            data-url="{{ route('billing.create',['billing',$event->id]) }}"
                                                            data-bs-toggle="tooltip" title="{{__('Create')}}"
                                                            data-ajax-popup="true"
                                                            data-title="{{__('Billing Details')}}"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-plus"></i>
                                                        </a>
                                                    </div>
                                                    @endcan
                                                    @endif
                                                    @if(\App\Models\Billing::where('event_id',$event->id)->exists())
                                                    @can('Manage Payment')
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" data-size="md"
                                                            data-url="{{ route('billing.paymentinfo',$event->id) }}"
                                                            data-bs-toggle="tooltip" title="{{__('Payment Details')}}"
                                                            data-ajax-popup="true"
                                                            data-title="{{__('Payment Information')}}"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class=" fa fa-credit-card "></i>
                                                        </a>
                                                    </div>
                                                    @endcan
                                                    @can('Manage Payment')

                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="#" data-size="md"
                                                            data-url="{{ route('billing.show',$event->id) }}"
                                                            data-bs-toggle="tooltip" title="{{__('Quick View')}}"
                                                            data-ajax-popup="true"
                                                            data-title="{{__('Billing Details')}}"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>
                                                    @endcan
                                                    @endif
                                                    @can('Delete Payment')
                                                    <div class="action-btn bg-danger ms-2">
                                                        {!! Form::open(['method' => 'DELETE', 'route' =>
                                                        ['billing.destroy', $event->id]]) !!}

                                                        <a href="#!"
                                                            class="mx-3 btn btn-sm  align-items-center text-white show_confirm"
                                                            data-bs-toggle="tooltip" title='Delete'>
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                        {!! Form::close() !!}
                                                    </div>
                                                    @endcan
                                                </td>
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