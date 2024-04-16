<?php
$url = route('meeting.signedagreement',urlencode(encrypt($meeting->id)));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agreement</title>
</head>
<body>
Dear <?php echo e($meeting->name); ?>,<br>

<p><?php echo e($content); ?></p><br>

<b>Click the link below to sign the agreement:</b><br>
<p><?php echo e($url); ?></p>

Thank you for your time and collaboration.<br>
Best regards,
</body>
</html><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/meeting/agreement/mail.blade.php ENDPATH**/ ?>