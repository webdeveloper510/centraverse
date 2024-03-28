<?php
$bill = App\Models\Billing::where('event_id',$event->id)->first();
$pay =  App\Models\PaymentLogs::where('event_id',$event->id)->get();
$total = 0;
foreach($pay as $p){
    $total += $p->amount;
}
?>
<?php echo e(Form::open(array('route' => ['billing.paymentinfoupdate', $event->id],'method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('amount',__('Amount'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('amount', $event->total + $bill->deposits,array('class'=>'form-control','placeholder'=>__('Enter Amount'),'required'=>'required','readonly'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('date',__('Date'),['class'=>'form-label'])); ?>

            <input type="date" name="date" id="date" class="form-control" value="<?php echo e($payment->date ?? date('Y-m-d')); ?>">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('deposits',__('Deposits on file'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('deposits',$bill->deposits,array('class'=>'form-control','placeholder'=>__('Enter Deposits')))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('latefee',__('Late Fee'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('latefee', $payment->latefee ?? 0 , array('class'=>'form-control','placeholder'=>__('Enter Late Fee')))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('adjustments',__('Adjustments'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('adjustments',$payment->adjustments ?? 0 ,array('class'=>'form-control','placeholder'=>__('Enter Adjustments')))); ?>

        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('amountpaid',__('Paid Amount'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('amountpaid',$total,array('class'=>'form-control','placeholder'=>__('Enter Amount Paid'),'readonly'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('amounttobepaid',__('Amount to be paid'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('amounttobepaid',null,array('class'=>'form-control','placeholder'=>__('Enter Adjustments'),'readonly'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('balance',__('Balance Due'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('balance',null,array('class'=>'form-control','placeholder'=>__('Enter Balance Due'),'readonly'))); ?>

        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('mode',__('Mode of Payment'),['class'=>'form-label'])); ?>

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
            <?php echo e(Form::label('reference',__('Payment Reference'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('reference',$payment->reference ?? '',array('class'=>'form-control','placeholder'=>__('Enter Reference Id ')))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('adjustmentnotes',__('Adjustment Notes'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('adjustmentnotes',$payment->adjustmentnotes ?? '',array('class'=>'form-control','placeholder'=>__('Enter Adjustment Notes')))); ?>

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
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
    <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

</div>
<?php echo e(Form::close()); ?>

<script>
jQuery(function() {
    var amount = parseFloat($("input[name='amount']").val()) || 0;
    var deposits = parseFloat($("input[name='deposits']").val()) || 0;
    var latefee = parseFloat($("input[name='latefee']").val()) || 0;
    var adjustments = parseFloat($("input[name='adjustments']").val()) || 0;
    var amountpaid = parseFloat($("input[name='amountpaid']").val()) || 0;

    var balance = amount - deposits + latefee - adjustments - amountpaid;
    var amounttobepaid = amount -deposits + latefee - adjustments;

    $("input[name='balance']").val(balance);
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
            var amounttobepaid = amount -deposits + latefee -adjustments;
            // Assuming you want to store the balance in an input field with name 'balance'
            $("input[name='balance']").val(balance);
            $("input[name='amounttobepaid']").val(amounttobepaid);

            console.log('total', balance);
        });
        $('select[name = "mode"]').change(function(){
            $('.msg').html('');
            $('input[name="reference"]').removeAttr('required');
            var value = $(this).val();
            if(value == 'credit'){
                    $('.msg').html('Pay Amount after form submission')
            }else{
                    $('input[name="reference"]').attr('required');
            }
            alert($(this).val());
        })
});
</script><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/billing/pay-info.blade.php ENDPATH**/ ?>