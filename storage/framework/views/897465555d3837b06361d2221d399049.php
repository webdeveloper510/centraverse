<?php
$event = App\Models\Meeting::find($id);
$payurl =route('billing.getpaymentlink',urlencode(encrypt($id)))
?>


Dear <?php echo e($event->name); ?>,<br>


<b>Click the link below to pay:</b><br>
<p><?php echo e($payurl); ?></p>

Thank you for your time and collaboration.<br>
Best regards,
<?php /**PATH /home/crmcentraverse/public_html/resources/views/billing/mail/payment.blade.php ENDPATH**/ ?>