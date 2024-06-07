<?php

$bill = App\Models\Billing::where('event_id',$event->id)->first();
$totalpaid = 0;
if(\App\Models\PaymentLogs::where('event_id',$event->id)->exists()){
    $pay = App\Models\PaymentLogs::where('event_id',$event->id)->get();
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
<?php if($event->status == 3): ?>
<?php if(($totalpaid + $bill->deposits  +$adjustments -$latefee) >= $event->total): ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <dl class="row">
                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Type')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e($event->type); ?></span></dd>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Customer Name')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e($event->name); ?></span></dd>
                        
                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Billing Amount')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class="">$<?php echo e(number_format($event->total)); ?></span></dd>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Late Fee')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e(($latefee == 0) ? '--': '$'.number_format($latefee)); ?></span></dd>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Adjustments')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e(($adjustments == 0) ? '--': '$'.number_format($adjustments)); ?></span></dd>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Amount Due')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e(($event->total - ($totalpaid + $bill->deposits +$adjustments - $latefee) == 0)?'--':'$'.number_format($event->total - ($totalpaid + $bill->deposits +$adjustments - $latefee))); ?></span></dd>
                        <!-- <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Paid Amount')); ?></span></dt> -->
                        <!-- <dd class="col-md-6 need_half"><span class=""><?php echo e((($totalpaid + $bill->deposits) == 0) ? ' -- ': '$'.number_format($totalpaid + $bill->deposits)); ?></span></dd> -->
                    </dl>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<?php echo e(Form::open(array('route' => ['billing.paymentinfoupdate', urlencode(encrypt($event->id))],'method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="row">
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('amount',__('Contract Amount'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('amount',$event->total,array('class'=>'form-control','placeholder'=>__('Enter Amount'),'required'=>'required','readonly'))); ?>

        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('date',__('Contract Date'),['class'=>'form-label'])); ?>

            <input type="date" name="date" id="date" class="form-control"
                value="<?php echo e($event->start_date ?? date('Y-m-d')); ?>">
        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('deposits',__('Deposits on Account'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('deposits', $bill->deposits ,array('class'=>'form-control','placeholder'=>__('Enter Deposits'),'readonly'))); ?>

        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('latefee',__('Late Fee'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('latefee',0, array('class'=>'form-control','placeholder'=>__('Enter Late Fee')))); ?>

        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('adjustments',__('Adjustments'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('adjustments',0,array('class'=>'form-control','placeholder'=>__('Enter Adjustments')))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('amountpaid',__('Total Paid'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('amountpaid',$totalpaid +$bill->deposits ,array('class'=>'form-control','placeholder'=>__('Enter Amount Paid'),'readonly'))); ?>

        </div>
    </div>

    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('balance',__('Balance Due'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('balance',null ,array('class'=>'form-control','placeholder'=>__('Enter Balance Due'),'readonly'))); ?>

        </div>
    </div>
    <div class="col-6 nee.d_full">
        <div class="form-group">
            <?php echo e(Form::label('amountcollect',__('Collect Amount'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('amountcollect',null,array('class'=>'form-control','required'))); ?>

        </div>
    </div>
    <div class="col-6 need_full">
        <div class="form-group">
            <?php echo e(Form::label('mode',__('Mode of Payment'),['class'=>'form-label'])); ?>

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
                    Check</option>
            </select>
            <!-- <div class="mt-4"> -->
            <span class="msg" style="color:#5e7ebd !important"></span>
            <!-- </div> -->
        </div>
    </div>
    <div class="col-12 ">
        <div class="form-group">
            <?php echo e(Form::label('reference',__('Payment Reference'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('reference',$payment->reference ?? '',array('class'=>'form-control','placeholder'=>__('Enter Reference Id ')))); ?>

        </div>
    </div>

    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('notes',__('Notes'),['class'=>'form-label'])); ?>

            <textarea name="notes" id="notes" cols="30" rows="5" class='form-control'
                placeholder='Enter Notes'></textarea>
        </div>
    </div>
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

</div>
<?php endif; ?>
<?php else: ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                Contract must be approved by customer/admin before any further payment .
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

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
    var latefee = <?php echo $latefee; ?>;;
    var adjustments = <?php echo $adjustments; ?>;
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
            var latefee =<?php echo $latefee; ?>;
            var adjustments = <?php echo $adjustments; ?>;
            var newlatefee = parseFloat($("input[name='latefee']").val()) || 0;
            var newadjustments = parseFloat($("input[name='adjustments']").val()) || 0;
            var ad = adjustments + newadjustments;
            var late = latefee + newlatefee;
            var balance = amount + late - ad - amountpaid;
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
</script><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/billing/pay-info.blade.php ENDPATH**/ ?>