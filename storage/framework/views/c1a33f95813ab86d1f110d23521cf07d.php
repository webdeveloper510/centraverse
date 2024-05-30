<?php 
 $logo=\App\Models\Utility::get_file('uploads/logo/');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Bond 1786</title>
    <style>
    body {
        background-color: #F6F6F6;
        margin: 0;
        padding: 0;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0;
        padding: 0;
    }

    p {
        margin: 0;
        padding: 0;
    }

    .container {
        width: 100%;
        margin-right: auto;
        margin-left: auto;
    }

    .brand-section {
        background-color:#d3ead3;
        padding: 10px 40px;
        text-align:center;
    }

    .logo {
        width: 50%;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .col-6 {
        width: 50%;
        flex: 0 0 auto;
    }

    .text-white {
        color: #fff;
    }

    .company-details {
        float: right;
        text-align: right;
    }

    .body-section {
        padding: 16px;
        /* border: 1px solid gray; */
    }

    .heading {
        font-size: 20px;
        margin-bottom: 08px;
    }

    .sub-heading {
        color: #262626;
        margin-bottom: 05px;
    }

    table {
        background-color: #fff;
        width: 100%;
        border-collapse: collapse;
    }

    table thead tr {
        border: 1px solid #111;
        background-color:#d3ead3
    }

    table td {
        vertical-align: middle !important;
        text-align: center;
    }

    table th,
    table td {
        padding-top: 08px;
        padding-bottom: 08px;
    }

    .table-bordered {
        box-shadow: 0px 0px 5px 0.5px gray;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6;
    }

    .text-right {
        text-align: end;
    }

    .w-20 {
        width: 20%;
    }

    .float-right {
        float: right;
    }

    .image {
        text-align: center;
    }
   
    </style>
</head>

<body>
    <div class="image">
        <img src="<?php echo e($logo.'3_logo-light.png'); ?>" alt="<?php echo e(config('app.name', 'The Bond 1786')); ?>"
            class="logo logo-lg nav-sidebar-logo" height="auto" style="width:10%;" />
    </div>
    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    <h1>The Bond 1786</h1>
                </div>

            </div>
        </div>

        <div class="body-section">
            <div class="row">
            <h3 class="heading">Contact Details</h3>
             
                <table class="table-bordered">
               
                <tbody>
                    <tr>
                        <td colspan="2">Name</td>
                        <td><?php echo e($event->name); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Email Address</td>
                        <td><?php echo e($event->email); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Address</td>
                        <td><?php echo e($event->lead_address); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Phone Number</td>
                        <td><?php echo e($event->phone); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Transaction Id</td>
                        <td><?php echo e($paymentlog->transaction_id); ?></td>
                    </tr>
                </tbody>
            </table>

            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">Event Details</h3>
            <br>
            <table class="table-bordered"> 
                <tbody>
                    <tr>
                        <td colspan="2">Event Type</td>
                        <td><?php echo e($event->type); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Date of Event</td>
                        <td><?php echo e(\Carbon\Carbon::parse($event->start_date)->format('M d, Y')); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">No. of guests</td>
                        <td><?php echo e($event->guest_count); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Venue</td>
                        <td><?php echo e($event->venue_selection); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Function</td>
                        <td><?php echo e($event->function); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="body-section">
            <h3 class="heading">Billing Details</h3>
            <br>
            <table class="table-bordered">
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
                        <td colspan="2" class="text-right"><b>Paid Amount</b></td>
                        <td> <b>$<?php echo e($totalpaid + $deposit); ?> </b></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right"><b>Balance Due</b></td>
                        <td> <b>$<?php echo e($event->total - $totalpaid - $deposit - $adjustments + $latefee); ?> </b></td>
                    </tr>
                </tbody>
            </table>
            <h6 class="heading">Payment Status: Paid</h6>
            <h6 class="heading">Payment Mode: <?php echo e(ucfirst($paymentinfo->modeofpayment)); ?></h6>
        </div>
        <div class="body-section">
            <p>&copy; The Bond 1786. All rights reserved.
            </p>
        </div>
    </div>

</body>

</html><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/billing/mail/inv.blade.php ENDPATH**/ ?>