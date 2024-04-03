<?php   
$event = App\Models\Meeting::find($id);
?>
<div class="row">
    <div class="col-lg-12">
        <div id="notification" class="alert alert-success mt-1">Link copied to clipboard!</div>
        <div class="">
            <dl class="row">
                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Name')); ?></span></dt>
                <dd class="col-md-6">
                    <input type="text" name="name" class="form-control" value="<?php echo e($event->name); ?>">
                </dd>
                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Email')); ?></span></dt>
                <dd class="col-md-6">
                    <input type="text" name="email" class="form-control" value="<?php echo e($event->email); ?>">
                </dd>
            </dl>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-toggle="tooltip" onclick="getDataUrlAndCopy(this)"
                data-url="<?php echo e(route('billing.getpaymentlink',urlencode(encrypt($id)))); ?>"   title='Copy To Clipboard'>
                    <i class="ti ti-copy"></i>
                </button>
                <!-- <?php echo e(Form::submit(__('Share via mail'),array('class'=>'btn btn-primary'))); ?> -->
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
</div>
<style>
#notification {
    display: none;
}
</style>
<script>
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
</script><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/billing/paylink.blade.php ENDPATH**/ ?>