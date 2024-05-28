<?php

$bill = App\Models\Billing::where('event_id',$event->id)->first();
$totalpaid = 0;
if(\App\Models\PaymentLogs::where('event_id',$event->id)->exists()){
    $pay = App\Models\PaymentLogs::where('event_id',$event->id)->get();
    $deposit = App\Models\Billing::where('event_id',$event->id)->first();
    foreach($pay as $p){
    $totalpaid += $p->amount;
    }
}
$info = App\Models\PaymentInfo::where('event_id',$event->id)->get();
$total = 0;
$latefee = 0;
$adjustments = 0;
foreach($info as $inf){
$latefee += $inf->latefee;
$adjustments += $inf->adjustments;
}
?>
@if($event->status == 3)
@if(($totalpaid + $bill->deposits +$adjustments - $latefee) == $event->total )
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <dl class="row">
                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Type')}}</span></dt>
                        <dd class="col-md-6 need_half"><span class="">{{ $event->type }}</span></dd>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Customer Name')}}</span></dt>
                        <dd class="col-md-6 need_half"><span class="">{{ $event->name }}</span></dd>
                        
                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Billing Amount')}}</span></dt>
                        <dd class="col-md-6 need_half"><span class="">${{ number_format($event->total) }}</span></dd>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Late Fee')}}</span></dt>
                        <dd class="col-md-6 need_half"><span class="">{{($latefee == 0) ? '--': '$'.number_format($latefee) }}</span></dd>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Adjustments')}}</span></dt>
                        <dd class="col-md-6 need_half"><span class="">{{ ($adjustments == 0) ? '--': '$'.number_format($adjustments) }}</span></dd>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Amount Due')}}</span></dt>
                        <dd class="col-md-6 need_half"><span class="">{{ ($event->total -($totalpaid + $bill->deposits + $adjustments - $latefee) == 0) ? ' -- ': '$'.number_format($event->total -($totalpaid + $bill->deposits + $adjustments - $latefee)) }}</span></dd>
                        <!-- <dt class="col-md-6 need_half"><span class="h6  mb-0">{{__('Paid Amount')}}</span></dt> -->
                        <!-- <dd class="col-md-6 need_half"><span class="">{{ (($totalpaid + $bill->deposits) == 0) ? ' -- ': '$'.number_format($totalpaid + $bill->deposits) }}</span></dd> -->
                    </dl>
                </div>
                <div class="w-100 text-end pr-2">
                        @can('Manage Payment')
                        <div class="action-btn bg-warning ms-2">
                            <a href="{{ route('billing.estimateview',urlencode(encrypt($event->id)))}}"> 
                            <button  data-bs-toggle="tooltip"title="{{ __('View Invoice') }}" class="btn btn-sm btn-secondary btn-icon m-1">
                            <i class="fa fa-print"></i></button>
                        </a>
                        </div>
                        @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@else
{{Form::open(array('route' => ['billing.paymentinfoupdate', urlencode(encrypt($event->id))],'method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('amount',__('Contract Amount'),['class'=>'form-label']) }}
            {{Form::number('amount',$event->total,array('class'=>'form-control','placeholder'=>__('Enter Amount'),'required'=>'required','readonly'))}}
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('date',__('Contract Date'),['class'=>'form-label']) }}
            <input type="date" name="date" id="date" class="form-control"
                value="{{$event->start_date ?? date('Y-m-d')}}">
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('deposits',__('Deposits on Account'),['class'=>'form-label']) }}
            {{Form::number('deposits', $bill->deposits ,array('class'=>'form-control','placeholder'=>__('Enter Deposits'),'readonly'))}}
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('latefee',__('Late Fee'),['class'=>'form-label']) }}
            {{Form::number('latefee',0, array('class'=>'form-control','placeholder'=>__('Enter Late Fee')))}}
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('adjustments',__('Adjustments'),['class'=>'form-label']) }}
            {{Form::number('adjustments',0,array('class'=>'form-control','placeholder'=>__('Enter Adjustments')))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('amountpaid',__('Total Paid'),['class'=>'form-label']) }}
            {{Form::number('amountpaid',$totalpaid +$bill->deposits ,array('class'=>'form-control','placeholder'=>__('Enter Amount Paid'),'readonly'))}}
        </div>
    </div>

    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('balance',__('Balance Due'),['class'=>'form-label']) }}
            {{Form::number('balance',null ,array('class'=>'form-control','placeholder'=>__('Enter Balance Due'),'readonly'))}}
        </div>
    </div>
    <div class="col-6 nee.d_full">
        <div class="form-group">
            {{Form::label('amountcollect',__('Collect Amount'),['class'=>'form-label']) }}
            {{Form::number('amountcollect',null,array('class'=>'form-control','required'))}}
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            {{Form::label('mode',__('Mode of Payment'),['class'=>'form-label']) }}
            <select name="mode" id="mode" class='form-select' required>
                <option value="">Please select</option>
                <option value="online"
                    <?php echo isset($payment->modeofpayment) ?($payment->modeofpayment == 'online') ?'selected' :'' : ''?>>
                    Online</option>
                <option value="credit"
                    <?php  echo isset($payment->modeofpayment) ?($payment->modeofpayment == 'credit') ?'selected' :'' : ''?>>
                    Credit</option>
                <option value="cash"
                    <?php echo isset($payment->modeofpayment) ?($payment->modeofpayment == 'cash') ?'selected' :'': '' ?>>
                    Cash</option>
                <option value="check"
                    <?php  echo isset($payment->modeofpayment) ?($payment->modeofpayment == 'check') ?'selected' :'' : ''?>>
                    Cheque</option>
            </select>
            <!-- <div class="mt-4"> -->
            <span class="msg" style="color:#5e7ebd !important"></span>
            <!-- </div> -->
        </div>
    </div>
    <div class="col-12 ">
        <div class="form-group">
            {{Form::label('reference',__('Payment Reference'),['class'=>'form-label']) }}
            {{Form::text('reference',$payment->reference ?? '',array('class'=>'form-control','placeholder'=>__('Enter Reference Id ')))}}
        </div>
    </div>

    <div class="col-12">
        <div class="form-group">
            {{Form::label('notes',__('Notes'),['class'=>'form-label']) }}
            <textarea name="notes" id="notes" cols="30" rows="5" class='form-control'
                placeholder='Enter Notes'></textarea>
        </div>
    </div>
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
</div>
@endif
@else
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                Contract must be approved by customer/admin before any further payment .
            </div>
        </div>
    </div>
</div>
@endif

<script>
$('#mode').change(function() {
    var selected = $(this).val();
    if (selected == 'credit') {
        $('#reference').removeAttr('required');
    } else {
        setTimeout(function() {
            $('#reference').attr('required', 'required');
        }, 100);
    }
});
</script>
<script>
jQuery(function() {
    var amount = parseFloat($("input[name='amount']").val()) || 0;
    var deposits = parseFloat($("input[name='deposits']").val()) || 0;
    var latefee = parseFloat($("input[name='latefee']").val()) || 0;
    var adjustments = parseFloat($("input[name='adjustments']").val()) || 0;
    var other = parseFloat($("input[name='other']").val()) || 0;
    var amountpaid =  parseFloat($("input[name='amountpaid']").val()) || 0;;
    var balance = amount + latefee - adjustments- amountpaid ;
    $("input[name='balance']").val(balance);
    $("input[name='amountcollect']").attr('max', balance);
    $("input[name='amount'],input[name='deposits'], input[name='latefee'], input[name='adjustments'], input[name='amountpaid'],input[name='other']")
        .keyup(function() {
            $("input[name='balance']").empty();
            var amount = parseFloat($("input[name='amount']").val()) || 0;
            var deposits = parseFloat($("input[name='deposits']").val()) || 0;
            var latefee = parseFloat($("input[name='latefee']").val()) || 0;
            var adjustments = parseFloat($("input[name='adjustments']").val()) || 0;
            var balance = amount + latefee - adjustments - amountpaid;
            $("input[name='amountcollect']").attr('max', balance);
            $("input[name='balance']").val(balance);
            console.log('total', balance);
        });
    $('select[name = "mode"]').change(function() {
        $('.msg').html('');
        $('input[name="reference"]').removeAttr('required');
        var value = $(this).val();
        if (value == 'credit') {
            $('.msg').html('Pay Amount after form submission')
        } else {
            $('input[name="reference"]').attr('required');
        }
    })
});
</script>