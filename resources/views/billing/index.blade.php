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
@section('action-btn')
    @can('Create Meeting')
        <div class="col-12 text-end mt-3">
            <a href="{{ route('billing.create') }}"> 
                <button  data-bs-toggle="tooltip"title="{{ __('Create') }}" class="btn btn-sm btn-primary btn-icon m-1">
                <i class="ti ti-plus"></i></button>
            </a>
        </div>
    @endcan
@endsection
@section('filter')
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table id="datatable" class="table datatable align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">{{ __('Name') }}</th>
                                    <th scope="col" class="sort" data-sort="status">{{ __('Event') }}</th>
                                    <th scope="col" class="sort" data-sort="completion">{{ __('Date Start') }}</th>
                                    <th scope="col" class="sort" data-sort="completion">{{ __('Payment Status') }}</th>
                                    <!-- <th scope="col" class="text-end">{{ __('Action') }}</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($billing as $bill)
                                    <tr>
                                        <td>
                                            <a href="" data-size="md"
                                                data-title="{{ __('Billing Details') }}" class="action-item text-primary">
                                                {{ ucfirst(App\Models\Meeting::where('id',$bill->event_id)->pluck('name')->first())}}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="budget">{{App\Models\Meeting::where('id',$bill->event_id)->pluck('type')->first()}}</span>
                                        </td>
                                        <td>
                                            <span class="budget">{{App\Models\Meeting::where('id',$bill->event_id)->pluck('start_date')->first()}}</span>
                                        </td>
                                        <td>
                                        @if($bill->status == 0)
                                            <span class="badge bg-info p-2 px-3 rounded">{{ __(\App\Models\Billingdetail::$status[$bill->status]) }}</span>
                                        @elseif($bill->status == 1)
                                        <span class="badge bg-warning p-2 px-3 rounded">{{ __(\App\Models\Billingdetail::$status[$bill->status]) }}</span>
                                        @elseif($bill->status == 2)
                                        <span class="badge bg-success p-2 px-3 rounded">{{ __(\App\Models\Billingdetail::$status[$bill->status]) }}</span>
                                        @endif
                                    </td>
                                        <!-- <td class="text-end">
                                            <div class="action-btn bg-danger ms-2">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['billing.destroy', $bill->id]]) !!}
                                                <a href="#!"
                                                    class="mx-3 btn btn-sm   align-items-center text-white show_confirm"
                                                    data-bs-toggle="tooltip" title='Delete'>
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                                {!! Form::close() !!}
                                            </div>
                                        </td> -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection