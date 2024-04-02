@php

$bill = App\Models\Billing::where('event_id',$event->id)->first();
$pay = App\Models\PaymentLogs::where('event_id',$event->id)->get();
$paymentinfo = App\Models\PaymentInfo::where('event_id',$event->id)->orderBy('id', 'desc')->first();
$aaaa = App\Models\PaymentInfo::where('event_id',$event->id)->get();
$total = 0;
foreach($pay as $p){
$total += $p->amount;
}
@endphp
@if($total != $event->total)
{{Form::open(array('route' => ['billing.paymentinfoupdate', urlencode(encrypt($event->id))],'method'=>'post','enctype'=>'multipart/form-data'))}}
<div class="row">
    <div class="col-6">
        <div class="form-group">
            {{Form::label('amount',__('Amount'),['class'=>'form-label']) }}
            {{Form::number('amount', $event->total + $bill->deposits,array('class'=>'form-control','placeholder'=>__('Enter Amount'),'required'=>'required','readonly'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('date',__('Date'),['class'=>'form-label']) }}
            <input type="date" name="date" id="date" class="form-control" value="{{$payment->date ?? date('Y-m-d')}}">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('deposits',__('Deposits on file'),['class'=>'form-label']) }}
            {{Form::number('deposits',$bill->deposits,array('class'=>'form-control','placeholder'=>__('Enter Deposits')))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('latefee',__('Late Fee'),['class'=>'form-label']) }}
            {{Form::number('latefee', $payment->latefee ?? 0 , array('class'=>'form-control','placeholder'=>__('Enter Late Fee')))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('adjustments',__('Adjustments'),['class'=>'form-label']) }}
            {{Form::number('adjustments',$payment->adjustments ?? 0 ,array('class'=>'form-control','placeholder'=>__('Enter Adjustments')))}}
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            {{Form::label('amountpaid',__('Paid Amount'),['class'=>'form-label']) }}
            {{Form::number('amountpaid',$total,array('class'=>'form-control','placeholder'=>__('Enter Amount Paid'),'readonly'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('amounttobepaid',__('Amount to be paid'),['class'=>'form-label']) }}
            {{Form::number('amounttobepaid',null,array('class'=>'form-control','placeholder'=>__('Enter Adjustments'),'readonly'))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('balance',__('Balance Due'),['class'=>'form-label']) }}
            {{Form::number('balance',null,array('class'=>'form-control','placeholder'=>__('Enter Balance Due'),'readonly'))}}
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            {{Form::label('mode',__('Mode of Payment'),['class'=>'form-label']) }}
            <select name="mode" id="mode" class='form-select'>
                <option value="online"
                    <?php echo isset($payment->modeofpayment) ?($payment->modeofpayment == 'online') ?'selected' :'' : ''?>>
                    Online</option>
                <option value="credit"
                    <?php  echo isset($payment->modeofpayment) ?($payment->modeofpayment == 'credit') ?'selected' :'' : ''?>>
                    Credit</option>
                <option value="cash"
                    <?php echo isset($payment->modeofpayment) ?($payment->modeofpayment == 'cash') ?'selected' :'': '' ?>>
                    Cash</option>
                <option value="cheque"
                    <?php  echo isset($payment->modeofpayment) ?($payment->modeofpayment == 'cheque') ?'selected' :'' : ''?>>
                    Cheque</option>
            </select>
            <div class="mt-4">
                <span class="msg text-primary"></span>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('reference',__('Payment Reference'),['class'=>'form-label']) }}
            {{Form::text('reference',$payment->reference ?? '',array('class'=>'form-control','placeholder'=>__('Enter Reference Id ')))}}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {{Form::label('adjustmentnotes',__('Adjustment Notes'),['class'=>'form-label']) }}
            {{Form::text('adjustmentnotes',$payment->adjustmentnotes ?? '',array('class'=>'form-control','placeholder'=>__('Enter Adjustment Notes')))}}
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
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    {{Form::submit(__('Save'),array('class'=>'btn btn-primary '))}}
</div>
@else
<div class="row">
    <div class="col-md-12">
        <dt class="col-md-6"><span class="h6  mb-0">{{__(' Amount')}}</span></dt>
        <dd class="col-md-6"><span class="">${{ $paymentinfo->amount }}</span></dd>
        <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Status')}}</span></dt>
        <dd class="col-md-6"><span class="text-md">
                @if($bill->status == 4)
                <span
                    class="badge bg-success p-2 px-3 rounded">{{__(\App\Models\Billing::$status[$bill->status]) }}</span>
                @endif
        </dd>
        <table class="table">
            <thead>
                <th>Date</th>
                <th>Mode Of Payment</th>
                <!-- <th>Amount Paid</th> -->
                <th>Late Fee</th>
                <th>Adjustments</th>
            </thead>
            <tbody>
                <tr>
                    @foreach($aaaa as $a)
                    <td>{{ \Auth::user()->dateFormat($paymentinfo->created_at)}}</td>
                    <td>{{ $paymentinfo->modeofpayment }}</td>
                    <!-- <td></td> -->
                    <td>{{ $paymentinfo->latefee }}</td>
                    <td>{{ $paymentinfo->adjustments }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
       
    </div>
</div>
@endif
{{Form::close()}}

<script>
jQuery(function() {
    var amount = parseFloat($("input[name='amount']").val()) || 0;
    var deposits = parseFloat($("input[name='deposits']").val()) || 0;
    var latefee = parseFloat($("input[name='latefee']").val()) || 0;
    var adjustments = parseFloat($("input[name='adjustments']").val()) || 0;
    var amountpaid = parseFloat($("input[name='amountpaid']").val()) || 0;

    var balance = amount - deposits + latefee - adjustments - amountpaid;
    var amounttobepaid = amount - deposits + latefee - adjustments;
    $("input[name='balance']").val(<?php echo $total - $event->total;?>);
    $("input[name='amounttobepaid']").val(amounttobepaid);
    $("input[name='amount'],input[name='deposits'], input[name='latefee'], input[name='adjustments'], input[name='amountpaid']")
        .keyup(function() {
            $("input[name='amounttobepaid']").empty();
            $("input[name='balance']").empty();
            var amount = parseFloat($("input[name='amount']").val()) || 0;
            var deposits = parseFloat($("input[name='deposits']").val()) || 0;
            var latefee = parseFloat($("input[name='latefee']").val()) || 0;
            var adjustments = parseFloat($("input[name='adjustments']").val()) || 0;
            var amountpaid = parseFloat($("input[name='amountpaid']").val()) || 0;

            var balance = amount - deposits + latefee - adjustments - amountpaid;
            var amounttobepaid = amount - deposits + latefee - adjustments;
            // Assuming you want to store the balance in an input field with name 'balance'
            $("input[name='balance']").val(balance);
            $("input[name='amounttobepaid']").val(amounttobepaid);

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