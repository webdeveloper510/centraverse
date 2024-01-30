<div class="row">
    <div class="col-lg-12">
            <div class="">
           <?php echo e(Form::model($lead, ['route' => ['lead.pdf', urlencode(encrypt($lead->id))], 'method' => 'POST'])); ?>

                <dl class="row">
                    <input type = "hidden" name="meeting" value = "<?php echo e($lead->id); ?>"  >
                    <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Name')); ?></span></dt>
                    <dd class="col-md-6"> 
                        <input type = "text" name="name" class="form-control" value = "<?php echo e($lead->name); ?>" readonly >
                    </dd>
                    <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Email')); ?></span></dt>
                    <dd class="col-md-6">
                        <input type = "text" name="email" class="form-control" value = "<?php echo e($lead->email); ?>" >
                    </dd>
                    <div class= "row section">
                        <div class= "col-md-6">
                            <button type="button" class = "btn btn-success " onclick="getDataUrlAndCopy(this)" data-url = "<?php echo e(route('lead.signedproposal',urlencode(encrypt($lead->id)))); ?>" title = 'Copy Link'> 
                               Copy to Clipboard <i class="ti ti-copy"></i>
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

<style>
      .row.section {
   margin: 10px;
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
    </script><?php /**PATH /home/crmcentraverse/public_html/centraglobe/main-file/resources/views/lead/share_proposal.blade.php ENDPATH**/ ?>