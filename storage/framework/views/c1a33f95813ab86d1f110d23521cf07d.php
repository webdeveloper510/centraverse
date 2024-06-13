<?php 
 $logo=\App\Models\Utility::get_file('uploads/logo/');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Bond 1786 - Invoice</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        color: #333;
        margin: 20px;
    }

    .img-section {
        width: 60%;
        margin: 0 auto;

        text-align: center;
    }

    .img-section img {
        width: 30%;
        max-width: 150px;
    }

    .img-section span {
        font-size: small;
        color: #aab0b6;
    }

    .header,
    {
        text-align: center;
        margin-bottom: 20px;
        margin-top: 10px;
    }
    .footer{
        text-align: center;
        margin-bottom: 20px;
        margin-top: 10px;
        padding:10px;
        background-color: #dbdbdb;
    }

    .header h5,
    .footer h5 {
        margin: 0;
        font-size: 18px;
    }

    .header span,
    .footer span {
        font-size: 14px;
    }

    .details dl {
        margin: 0;
    }

    .details span {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .body-section {
        padding: 16px;
        border: 1px solid gray;
    }

    .details {
        font-size: 15px;
        text-align: justify;
    }


    .table-container {
        margin-top: 20px;
    }

    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    thead {
        background: linear-gradient(141.55deg, #48494B 3.46%, #48494B 99.86%), #48494B !important;
        color: white;
        text-align: center;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 8px;
        font-size: 13px;
    }
    </style>
</head>

<body>
    <div class="img-section">
        <img src="<?php echo e(Storage::url('uploads/logo/logo-light.png')); ?>" alt="Logo">
    </div>
    <!-- <hr> -->

    <div class="header">
        <h5>The Bond 1786 - Invoice</h5>
        <!-- <span>Venue Rental & Banquet Event Order</span> -->
    </div>
    <hr>

    <div class="details">
        <dl>
            <span><b>Transaction Id:</b> <?php echo e($paymentlog->transaction_id); ?></span>
            <span><b>Name:</b> <?php echo e($event->name); ?></span>
            <span><b>Date:</b> <?php echo e(\Carbon\Carbon::parse($paymentlog->created_at)->format('M d, Y')); ?></span>
            <span><b>Email Address:</b><?php echo e($event->email  ?? '--'); ?></span>
        </dl>
    </div>
    <hr>
   
    <table class="table" style="    table-layout: fixed;">
        <thead>
            <tr>
                <th colspan="4">Event Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">Event Type</td>
                <td colspan="2"><?php echo e($event->type); ?></td>
            </tr>
            <tr>
                <td colspan="2">Date of Event</td>
                <td colspan="2"><?php echo e(\Carbon\Carbon::parse($event->start_date)->format('M d, Y')); ?></td>
            </tr>
            <tr>
                <td colspan="2">No. of guests</td>
                <td colspan="2"><?php echo e($event->guest_count); ?></td>
            </tr>
            <tr>
                <td colspan="2">Venue</td>
                <td colspan="2"><?php echo e($event->venue_selection); ?></td>
            </tr>
            <tr>
                <td colspan="2">Function</td>
                <td colspan="2"><?php echo e($event->function); ?></td>
            </tr>

        </tbody>
    </table>

    <div class="header">
        <h5>Billing Details</h5>
    </div>
    <table class="table-bordered" style="    table-layout: fixed;">
    <thead>
            <tr>
                <th colspan="2"> Description</th>
                <th > Cost</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td colspan="2" class="text-right"><b>Total Amount</b></td>
                <td> <b>$<?php echo e($event['total']); ?></b></td>
            </tr>
            <tr>
                <td colspan="2" class="text-right"><b>Adjustments</b></td>
                <td> <b><?php echo e(($paymentinfo->adjustments == 0)? '--' :'$'.$paymentinfo->adjustments); ?> </b></td>
            </tr>
            <tr>
                <td colspan="2" class="text-right"><b>Late Fee(If any)</b></td>
                <td><b><?php echo e(($paymentinfo->latefee == 0)? '--' : '$'.$paymentinfo->latefee); ?></b></td>
            </tr>

            <tr>
                <td colspan="2" class="text-right"><b>Amount Collected</b></td>
                <td> <b>$<?php echo e($paymentlog->amount); ?> </b></td>
            </tr>
            <tr>
                <td colspan="2" class="text-right"><b>Balance Due</b></td>
                <td> <b>$<?php echo e($event->total - $totalpaid - $deposit - $adjustments + $latefee); ?> </b></td>
            </tr>
        </tbody>
    </table>
    <br>
    <h4 class="heading">Payment Mode: <?php echo e(ucfirst($paymentinfo->modeofpayment)); ?></h4>
    
    <div class="footer">
        <p>&copy; The Bond 1786. All rights reserved.

        </p>
    </div>
    </div>

</body>

</html><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/billing/mail/inv.blade.php ENDPATH**/ ?>