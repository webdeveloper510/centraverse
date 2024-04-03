<?php   
$event = App\Models\Meeting::find($id);
$paidamount = App\Models\PaymentLogs::where('event_id',$id)->get();
$total = 0;
foreach ($paidamount as $key => $value) {
   $total += $value->amount;
}
?>
<div class="row">
    <div class="col-lg-12">
        <div id="notification" class="alert alert-success mt-1">Link copied to clipboard!</div>
        {{Form::open(array('route' => ['billing.sharepaymentlink', urlencode(encrypt($event->id))],'method'=>'post','enctype'=>'multipart/form-data'))}}

        <div class="">
            <dl class="row">
                <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Name')}}</span></dt>
                <dd class="col-md-6">
                    <input type="text" name="name" class="form-control" value="{{$event->name}}">
                </dd>
                <dt class="col-md-6"><span class="h6 text-md mb-0">{{__('Email')}}</span></dt>
                <dd class="col-md-6">
                    <input type="text" name="email" class="form-control" value="{{$event->email}}">
                </dd>
            </dl>
            <div class="row form-group">
                <div class="col-md-12">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount" class="form-control" value="{{$event->total}}" readonly>
                </div>
                <!-- <div class="col-md-6">
                    <label for="deposit" class="form-label">Deposits</label>
                    <input type="number" name="deposit" class="form-control">
                </div> -->
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="adjustment" class="form-label">Adjustments</label>
                    <input type="number" name="adjustment" class="form-control" min="0">
                </div>
                <div class="col-md-6">
                    <label for="latefee" class="form-label">Late fee(if Any)</label>
                    <input type="number" name="latefee" class="form-control" min="0">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                    <label for="paidamount" class="form-label">Paid Amount</label>
                    <input type="number" name="paidamount" class="form-control" value="{{$total}}" readonly>
                </div>
                <div class="col-md-6">
                    <label for="balance" class="form-label">Balance</label>
                    <input type="number" name="balance" class="form-control">
                </div>
            </div>
            <div class="row form-group">
            <div class="col-6">
            {{Form::label('adjustmentnotes',__('Adjustment Notes'),['class'=>'form-label']) }}
            {{Form::text('adjustmentnotes',$payment->adjustmentnotes ?? '',array('class'=>'form-control','placeholder'=>__('Enter Adjustment Notes')))}}
    </div>
    <div class="col-6">
            {{Form::label('notes',__('Notes'),['class'=>'form-label']) }}
            <textarea name="notes" id="notes" cols="30" rows="5" class='form-control'
                placeholder='Enter Notes'></textarea>
    </div>
            </div>
   
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-toggle="tooltip" onclick="getDataUrlAndCopy(this)"
                    data-url="{{route('billing.getpaymentlink',urlencode(encrypt($id)))}}" title='Copy To Clipboard'>
                    <i class="ti ti-copy"></i>
                </button>
                {{Form::submit(__('Share via mail'),array('class'=>'btn btn-primary'))}}
            </div>
        </div>
        
        {{Form::close()}}
    </div>
</div>
<style>
#notification {
    display: none;
}
</style>
<script>
$(document).ready(function() {
    var amount = parseFloat($("input[name='amount']").val()) || 0;
    var latefee = parseFloat($("input[name='latefee']").val()) || 0;
    var adjustments = parseFloat($("input[name='adjustment']").val()) || 0;
    var amountpaid = parseFloat($("input[name='paidamount']").val()) || 0;

    var balance = amount + latefee - adjustments - amountpaid;
    // Assuming you want to store the balance in an input field with name 'balance'
    $("input[name='balance']").val(balance);
})

$(" input[name='latefee'], input[name='adjustment']")
    .keyup(function() {
        $("input[name='balance']").empty();
        var amount = parseFloat($("input[name='amount']").val()) || 0;
        var latefee = parseFloat($("input[name='latefee']").val()) || 0;
        var adjustments = parseFloat($("input[name='adjustment']").val()) || 0;
        var amountpaid = parseFloat($("input[name='paidamount']").val()) || 0;

        var balance = amount + latefee - adjustments - amountpaid;
        // Assuming you want to store the balance in an input field with name 'balance'
        $("input[name='balance']").val(balance);

        console.log('total', balance);
    });

function getDataUrlAndCopy(button) {
    var dataUrl = button.getAttribute('data-url');
    copyToClipboard(dataUrl);
    // alert("Copied the data URL: " + dataUrl);
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
</script>