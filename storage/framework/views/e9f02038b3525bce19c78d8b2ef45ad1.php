<?php
$proposalUrl = route('lead.signedproposal',urlencode(encrypt($lead->id)));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal</title>
</head>
<body>
Dear <?php echo e($lead->name); ?>,<br>

<p><?php echo e($content); ?></p>

<b>Click the link below to see the Lead details/proposal with estimated billing - </b><br>
<p><?php echo e($proposalUrl); ?></p>
Thank you for your time and collaboration.
With regards
</body>
</html><?php /**PATH /home/crmcentraverse/public_html/resources/views/lead/mail/view.blade.php ENDPATH**/ ?>