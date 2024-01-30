<?php
$billing = App\Models\Billingdetail::where('event_id',$meeting->id)->exists();
?>
<?php if($billing): ?>
    <div class="row">
        <div class="col-lg-12">
                <div class="">
            <?php echo e(Form::model($meeting, ['route' => ['meeting.event_info', urlencode(encrypt($meeting->id))], 'method' => 'POST'])); ?>

                    <dl class="row">
                        <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Name')); ?></span></dt>
                        <dd class="col-md-6"> 
                            <input type = "text" name="name" class="form-control" value = "<?php echo e($meeting->name); ?>" readonly >
                        </dd>
                        <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Email')); ?></span></dt>
                        <dd class="col-md-6">
                            <input type = "text" name="email" class="form-control" value = "<?php echo e($meeting->email); ?>" >
                        </dd>
                        <div class= "row section">
                            <div class= "col-md-6">
                                <button type="button" class = " btn btn-success " onclick="getDataUrlAndCopy(this)" data-url = "<?php echo e(route('meeting.signedagreement',urlencode(encrypt($meeting->id)))); ?>" title = 'Copy Link'> 
                                Copy To Clipboard <i class="ti ti-copy"></i>
                             </button>                 
                            </div>
                            <div class= "col-md-6">
                              <?php echo e(Form::submit(__('Share via mail'),array('class'=>'btn btn-primary'))); ?> 
                            </div>
                        </div>
                    </dl>
                </div>
                <?php echo e(Form::close()); ?>

        </div>
    </div>
<?php else: ?>
    <div class = "alert alert-info">Firstly, Create Billing For this event!</div>
<?php endif; ?>
<style>
    /* input.btn.btn-primary {
    float: right;
    margin-top: 9px;
} */
    .section {
    /* width: 1200px; */
   margin:10px;
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
        }
    </script>

<?php /**PATH /home/crmcentraverse/public_html/centraglobe/main-file/resources/views/meeting/shareview.blade.php ENDPATH**/ ?>