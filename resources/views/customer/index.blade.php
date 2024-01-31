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
{{ Form::open(array('route' => 'customer.sendmail','method' =>'post')) }}
<div class="main-div">
    <div class="row mt-3">
        <div class="col-sm-10">
            <!-- <div class="form-group" > -->
            <select class="form-select" name="template">
                <option selected disabled>Select Template</option>
                @foreach($emailtemplates as $template)
                <option value="{{$template->id}}">{{$template->subject}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-2">
            <input type="submit" class="btn btn-primary" value="Send Email">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive overflow_hidden">
                        <table id="datatable" class="table align-items-center datatable">

                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th scope="col" class="sort" data-sort="username">{{ __('Customer Name') }}</th>
                                    <th scope="col" class="sort" data-sort="email">{{ __('Email') }}</th>
                                    <th scope="col" class="sort" data-sort="phone">{{ __('Phone') }}</th>
                                    <th scope="col" class="sort" data-sort="address">{{ __('Address') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="checkall" id="checkall" class="form-check-input">
                                    </td>
                                </tr>
                                @foreach($customers as $customer)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input align-middle ischeck" value="{{ $customer->email }}" name="customer[]">
                                    </td>
                                    <td>
                                        <span class="budget"><b>{{ ucfirst($customer->name) }}</b></span>
                                    </td>
                                    <td>
                                        <span class="budget">{{ $customer->email }}</span>
                                    </td>
                                    <td>.
                                        <span class="budget">{{$customer->phone}}</span>
                                    </td>
                                    <td>
                                        <span class="budget">{{$customer->lead_address}}</span>
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
{{Form::close()}}
@endsection
@push('script-page')
<script>
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