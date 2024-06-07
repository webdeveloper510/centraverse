<?php 

$event = App\Models\Meeting::find($id);
// $paidamount = App\Models\PaymentLogs::where('event_id',$id)->get();
$bill = App\Models\Billing::where('event_id',$event->id)->first();
// $total = 0;
// foreach ($paidamount as $key => $value) {
//    $total += $value->amount;
// }
$totalpaid = 0;
if(\App\Models\PaymentLogs::where('event_id',$event->id)->exists()){
    $pay = App\Models\PaymentLogs::where('event_id',$event->id)->get();
    $deposit = App\Models\Billing::where('event_id',$event->id)->first();
    foreach($pay as $p){
    $totalpaid += $p->amount;
    }
}
$info = App\Models\PaymentInfo::where('event_id',$event->id)->get();
$latefee = 0;
$adjustments = 0;
foreach($info as $inf){
$latefee += $inf->latefee;
$adjustments += $inf->adjustments;
}
?>
<?php if($event->status == 3): ?>
<div class="row">
    <div class="col-lg-12">
        <div id="notification" class="alert alert-success mt-1">Link copied to clipboard!</div>
        <?php echo e(Form::open(array('route' => ['billing.sharepaymentlink', urlencode(encrypt($event->id))],'method'=>'post','enctype'=>'multipart/form-data'))); ?>


        <div class="">
            <div class="row form-group">
                <div class="col-md-6">
                    <label class="form-label"><?php echo e(__('Name')); ?></label>

                    <input type="text" name="name" class="form-control" value="<?php echo e($event->name); ?>" readonly>

                </div>
                <div class="col-md-6"> <label class="form-label"><?php echo e(__('Email')); ?></label>

                    <input type="text" name="email" class="form-control" value="<?php echo e($event->email); ?>">
                    <span id="email-error" class="error-message" style="display: none; color: red;"></span>

                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="amount" class="form-label">Contract Amount</label>
                    <input type="number" name="amount" class="form-control" value="<?php echo e($event->total); ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label for="deposit" class="form-label">Deposits</label>
                    <input type="number" name="deposit" value="<?php echo e($bill->deposits); ?>" class="form-control">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="adjustment" class="form-label">Adjustments</label>
                    <input type="number" name="adjustment" class="form-control" min="0" value="0">
                </div>
                <div class="col-md-6">
                    <label for="latefee" class="form-label">Late fee(if Any)</label>
                    <input type="number" name="latefee" class="form-control" min="0" value="0">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="paidamount" class="form-label">Total Paid</label>
                    <input type="number" name="paidamount" class="form-control" value="<?php echo e($totalpaid +$bill->deposits); ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label for="balance" class="form-label">Balance</label>
                    <input type="number" name="balance" class="form-control">
                </div>
            </div>
           
            <div class="row form-group">
                <div class="col-6 need_full">
                    <div class="form-group">
                        <?php echo e(Form::label('amountcollect',__('Collect Amount'),['class'=>'form-label'])); ?>

                        <?php echo e(Form::number('amountcollect',null,array('class'=>'form-control','required'))); ?>

                        <span id="amountcollect-error" class="error-message" style="display: none; color: red;"></span>

                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12">
                    <label class="form-label"> <?php echo e(Form::label('notes',__('Notes'),['class'=>'form-label'])); ?> </label>
                    <textarea name="notes" id="notes" cols="30" rows="5" class='form-control'
                        placeholder='Enter Notes'></textarea>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-toggle="tooltip" onclick="getDataUrlAndCopy(this)"
                data-url="<?php echo e(route('billing.getpaymentlink',urlencode(encrypt($id)))); ?>" title='Copy To Clipboard'>
                <i class="ti ti-copy"></i>
            </button>
            <?php echo e(Form::submit(__('Share via mail'),array('class'=>'btn btn-primary'))); ?>

        </div>
    </div>

    <?php echo e(Form::close()); ?>

</div>
</div>
<?php else: ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                Contract must be approved by customer/admin before any further payment .
                <a href="<?php echo e(route('meeting.index')); ?>">
                    <i class="fas fa-external-link-alt " style=" float: inline-end;"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<style>
#notification {
    display: none;
}
</style>
<script>
$(document).ready(function() {
    var amount = parseFloat($("input[name='amount']").val()) || 0;
    var deposits = parseFloat($("input[name='deposit']").val()) || 0;
    var latefee = <?php echo $latefee; ?>;
    var adjustment = <?php echo $adjustments; ?>;
    var amttobepaid = parseFloat($("input[name='paidamount']").val()) || 0;
    var balance = amount + latefee - adjustment - amttobepaid ;
    // console.log(deposits,'33453453',balance)
    $("input[name='amountcollect']").attr('max', balance);
    $("input[name='balance']").val(balance);
})
$(" input[name='latefee'], input[name='adjustment']")
    .keyup(function() {
        $("input[name='balance']").empty();
        var amount = parseFloat($("input[name='amount']").val()) || 0;
        var deposits = parseFloat($("input[name='deposit']").val()) || 0;
        var amttobepaid = parseFloat($("input[name='paidamount']").val()) || 0;
        var latefee =<?php echo $latefee; ?>;
        var adjustments = <?php echo $adjustments; ?>;
        var newlatefee = parseFloat($("input[name='latefee']").val()) || 0;
        var newadjustments = parseFloat($("input[name='adjustment']").val()) || 0;
        var ad = adjustments + newadjustments;
        var late = latefee + newlatefee;
        var balance = amount + late - ad - amttobepaid;
        // Assuming you want to store the balance in an input field with name 'balance'
        $("input[name='amountcollect']").attr('max', balance);
        $("input[name='balance']").val(balance);
        console.log('total', balance,ad,late);
});

// function getDataUrlAndCopy(button) {
//     // Get the URL from the data attribute of the button
//     var dataurl = button.getAttribute('data-url');

//     // Perform your validation here
//     var isValid = validateForm(); // Replace with your validation logic

//     if (isValid) {
//         var amount = $('input[name="amount"]').val();
//         var adjustment = $('input[name="adjustment"]').val();
//         var latefee = $('input[name="latefee"]').val();
//         var deposit = $('input[name="deposit"]').val();
//         var notes = $('input[name="notes"]').val();
//         var amountcollect = $('input[name="amountcollect"]').val();
//         var balance = $('input[name="balance"]').val();


//         $.ajax({
//             url: '<?php echo e(route("billing.addpayinfooncopyurl",$event->id)); ?>',
//             type: 'POST',
//             data: {
//                 "url": url,
//                 "_token": "<?php echo e(csrf_token()); ?>",
//                 "amount": amount,
//                 "deposit": deposit,
//                 "adjustment": adjustment,
//                 "latefee": latefee,
//                 "notes": notes,
//                 "amountcollect": amountcollect,
//                 "balance": balance
//             },
//             success: function(response) {
//                 // Handle success response
//                 copyToClipboard(dataurl);

//                 console.log(response);
//             },
//             error: function(xhr, status, error) {
//                 // Handle error response
//                 console.error(xhr.responseText);
//             }
//         });
//         // If validation passes, copy the URL to the clipboard

//     } else {
//         var errorMessageSpan = document.getElementById('error-message');
//         errorMessageSpan.innerHTML = 'The field is required';
//         errorMessageSpan.style.display = 'inline'; // Make the error message visible
         
//         // If validation fails, show an error message or perform any other action
//         // alert('Validation failed!'); // Example of an alert message
//     }
// }
function getDataUrlAndCopy(button) {
    // Get the URL from the data attribute of the button
    var dataurl = button.getAttribute('data-url');

    // Perform your validation here
    var isValid = validateForm(); // Replace with your validation logic

    // Clear any previous error messages
    $('.error-message').hide().html('');
    var email = $('input[name="email"]').val();
    // Validate each input field
    var amount  =  $('input[name="amount"]').val();
    var latefee =$('input[name="latefee"]').val();
    var adjustment = $('input[name="adjustment"]').val();
    var deposit = $('input[name="deposit"]').val();
    var notes   = $('input[name="notes"]').val();
    var amountcollect = $('input[name="amountcollect"]').val();
    var balance = $('input[name="balance"]').val();

    var a=  $("input[name='amountcollect']").attr('max', balance);


    var validationPassed = true;

  
    if (!email) {
        $('#email-error').html('Email is required').show();
        validationPassed = false;
    }
 if (!amountcollect || parseFloat(amountcollect) > parseFloat(balance)) {
    $('#amountcollect-error').html('Amount to collect is required and must be less than or equal to balance due').show();
    validationPassed = false;
}

    if (validationPassed) {
        $.ajax({
            url: '<?php echo e(route("billing.addpayinfooncopyurl",$event->id)); ?>',
            type: 'POST',
            data: {
                "url": dataurl,
                "_token": "<?php echo e(csrf_token()); ?>",
                "amount": amount,
                "deposit": deposit,
                "adjustment": adjustment,
                "latefee": latefee,
                "notes": notes,
                "amountcollect": amountcollect,
                "balance": balance
            },
            success: function(response) {
                // Handle success response
                copyToClipboard(dataurl);
                console.log(response);
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    } else {
        // If validation fails, show a general error message if needed
        $('#general-error').html('Please correct the errors above').show();
    }
}



function validateForm() {
    var name = document.getElementsByName('name')[0].value;
    var email = document.getElementsByName('email')[0].value;
      var balance = $('input[name="balance"]').val();
    var amountcollect = document.getElementsByName('amountcollect')[0].value;
    $("input[name='amountcollect']").attr('max', balance);


    if (name.trim() === '' || email.trim() === '' || amountcollect.trim() == '') {
        return false;
    }
    return true;
}

function copyToClipboard(text) {
    /* Create a temporary input element */
    var tempInput = document.createElement("input");

    /* Set the value of the input element to the text to be copied */
    tempInput.value = text;

    document.body.appendChild(tempInput);

    /* Select the text in the input element */
    tempInput.select();

    /* Copy the selected text to the clipboard */
    document.execCommand("copy");

    /* Remove the temporary input element from the DOM */
    document.body.removeChild(tempInput);
    showNotification();

    /* Hide the notification after 2 seconds (adjust as needed) */
    setTimeout(hideNotification, 2000);
}

function showNotification() {
    var notification = document.getElementById('notification');
    notification.style.display = 'block';
}

function hideNotification() {
    var notification = document.getElementById('notification');
    notification.style.display = 'none';
}
</script><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/billing/paylink.blade.php ENDPATH**/ ?>