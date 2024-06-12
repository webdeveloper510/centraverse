<?php
$billing = App\Models\ProposalInfo::where('lead_id',$lead->id)->orderby('id','desc')->first();
if(isset($billing) && !empty($billing)){
    $billing= json_decode($billing->proposal_info,true);
}
$selectedvenue = explode(',', $lead->venue_selection);
$imagePath = public_path('upload/signature/autorised_signature.png');
$imageData = base64_encode(file_get_contents($imagePath));
$base64Image = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;
if(isset($proposal) && ($proposal['image'] != null)){
    $signed = base64_encode(file_get_contents($proposal['image']));
    $sign = 'data:image/' . pathinfo($proposal['image'], PATHINFO_EXTENSION) . ';base64,' . $signed;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal</title>
</head>
<style>
body {
    font-family: Arial, sans-serif;
    font-size: 12px;
    color: #333;
    margin: 20px;
}

.img-section {
    width: 60%;
    margin: 0 auto;
    /* display: flex; */
    /* flex-direction: column; */
    /* align-items: center; */
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
.footer {
    text-align: center;
    margin-bottom: 20px;
    margin-top: 10px;
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

/* .details {
        margin-top: 20px;
    } */
.details p {
    font-size: 15px;
    text-align: justify;
}

.details b {
    color: #333;
}

.table-container {
    margin-top: 20px;
}

table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
    margin-bottom: 20px;
    table-layout: fixed;
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
    word-wrap: break-word;
    white-space: normal;
    /* overflow: hidden; */
    /* text-overflow: ellipsis; */
}

.billing thead {
    background-color: #1c232f;
}

.billing thead th {
    color: #fff;
}

.billing tfoot tr {
    background-color: #dbdbdb;
    ;
}

.billing tfoot td {
    font-weight: bold;
}

.total-row {
    background-color: #dcdaeb;
}

.balance-due {
    background-color: #dcdaeb;
    font-weight: bold;
}


.table-container {
    margin-top: 30px;
    /* page-break-inside: avoid; */
}

.main-div {
    margin-top: 20px;
    page-break-inside: avoid;
}

.signature {
    width: 45%;
    text-align: center;
}



@media print {
    .table-container {
        /* page-break-inside: avoid; */
    }

    .main-div {
        page-break-inside: avoid;
    }
}
</style>
<body>

    <div class="img-section">
        <img src="<?php echo e(Storage::url('uploads/logo/logo-light.png')); ?>" alt="Logo">
    </div>
    <!-- <hr> -->

    <div class="header">
        <h5>The Bond 1786 - Proposal</h5>
        <span>Venue Rental & Banquet Event Order</span>
    </div>
    <hr>
    <div class="details">
        <dl>
            <span><b><?php echo e(__('Name')); ?>:</b> <?php echo e($lead->name); ?></span>
            <span><b><?php echo e(__('Phone & Email')); ?>:</b> <?php echo e($lead->phone); ?> , <?php echo e($lead->email); ?></span>
            <span><b><?php echo e(__('Address')); ?>:</b> <?php echo e($lead->lead_address); ?></span>
            <span><b><?php echo e(__('Event Date')); ?>:</b><?php echo e(\Carbon\Carbon::parse($lead->start_date)->format('d M, Y')); ?></span>
        </dl>
    </div>

    <!-- <hr> -->

    <table class="table">
        <thead>
            <tr>
                <th>Event Date</th>
                <th>Time</th>
                <th>Venue</th>
                <th>Event</th>
                <th>Function</th>
                <th>Guest Count</th>
                <th>Room</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align:center">

                <td>
                    <?php echo e(\Carbon\Carbon::parse($lead->start_date)->format('d M, Y')); ?>

                </td>

                <td>
                    <?php if($lead->start_time == $lead->end_time): ?>
                    --
                    <?php else: ?>
                    <?php echo e(date('h:i A', strtotime($lead->start_time))); ?> -
                    <?php echo e(date('h:i A', strtotime($lead->end_time))); ?>

                    <?php endif; ?></td>
                <td><?php echo e($lead->venue_selection); ?></td>
                <td><?php echo e($lead->type); ?></td>
                <td><?php echo e($lead->function); ?></td>
                <td><?php echo e($lead->guest_count); ?></td>
                <td><?php echo e($lead->rooms); ?></td>

            </tr>
        </tbody>
    </table>
    <div class="table-container " style="  table-layout: fixed;">
        <div class="header">
            <h5>Billing Summary</h5>
        </div>
        <hr>
        <table class="billing">
            <thead>
                <tr>
                    <th colspan="2">Name: <?php echo e(ucfirst($lead->name)); ?></th>
                    <th colspan="2">Date: <?php echo date("d/m/Y"); ?></th>
                    <th>Event: <?php echo e(ucfirst($lead->type)); ?></th>
                </tr>
                <tr>
                    <th>Description</th>
                    <th>Cost</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Venue Rental</td>

                    <td>$<?php echo e($billing['venue_rental']['cost']); ?></td>
                    <td><?php echo e($billing['venue_rental']['quantity']); ?></td>
                    <td>$<?php echo e($total[] = $billing['venue_rental']['cost'] * $billing['venue_rental']['quantity']); ?>

                    </td>
                    <td><?php echo e($billing['venue_rental']['notes']); ?></td>
                </tr>
                <tr>
                    <td>Brunch / Lunch / Dinner Package</td>

                    <td>$<?php echo e($billing['food_package']['cost']); ?></td>
                    <td><?php echo e($billing['food_package']['quantity']); ?></td>
                    <td>$<?php echo e($total[] = $billing['food_package']['cost'] * $billing['food_package']['quantity']); ?>

                    </td>
                    <td><?php echo e($billing['food_package']['notes']); ?></td>
                </tr>
                <tr>
                    <td>Bar Package</td>

                    <td>$<?php echo e($billing['bar_package']['cost']); ?></td>
                    <td><?php echo e($billing['bar_package']['quantity']); ?></td>
                    <td>$<?php echo e($total[] = $billing['bar_package']['cost']* $billing['bar_package']['quantity']); ?>

                    </td>
                    <td><?php echo e($billing['bar_package']['notes']); ?></td>
                </tr>
                <tr>
                    <td>Hotel Rooms</td>

                    <td>$<?php echo e($billing['hotel_rooms']['cost']); ?></td>
                    <td><?php echo e($billing['hotel_rooms']['quantity']); ?></td>
                    <td>$<?php echo e($total[] = $billing['hotel_rooms']['cost'] * $billing['hotel_rooms']['quantity']); ?>

                    </td>
                    <td><?php echo e($billing['hotel_rooms']['notes']); ?></td>
                </tr>

            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="3">Total</td>
                    <td colspan="2">$<?php echo e(array_sum($total)); ?></td>
                </tr>
                <tr>
                    <td colspan="3">Sales, Occupancy Tax</td>
                    <td colspan="2">$<?php echo e(7 * array_sum($total) / 100); ?></td>
                </tr>
                <tr>
                    <td colspan="3">Service Charges & Gratuity</td>
                    <td colspan="2">$<?php echo e(20 * array_sum($total) / 100); ?></td>
                </tr>
                <tr class="total-row">
                    <td colspan="3">Grand Total / Estimated Total</td>
                    <td colspan="2">
                        $<?php echo e($grandtotal = array_sum($total) + 20 * array_sum($total) / 100 + 7 * array_sum($total) / 100); ?>

                    </td>
                </tr>
                <tr class="total-row">
                    <td colspan="3">Deposits on file</td>
                    <td colspan="2"><?php echo e(__('No Deposits yet')); ?></td>
                </tr>
                <tr class="balance-due">
                    <td colspan="3">Balance Due</td>
                    <td colspan="2">$<?php echo e($grandtotal); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <br>

    <div class="header">
        <h5>Customer Comments/Notes</h5>
    </div>
    <hr>
    <div class="details">
        <p> <?php echo e(isset($proposal) ? $proposal->notes : ''); ?>

        </p>
    </div>

    <div class="main-div">
        <div class="row">
            <div class="col-md-6" style="float:left;width:50%;">
                <strong>Authorized Signature:</strong> <br>
                <img src="<?php echo e($base64Image); ?>" style="width:50%; margin-top:5px;border-bottom:1px solid black;">
            </div>
        </div>
        <div class="col-md-6" style="float:right;width:50%">
            <strong>Customer's Signature:</strong><br>
            <img src="<?php echo e(@$sign); ?>" style="width:50%; border-bottom:1px solid black;margin-top:5px"><br>
           <p style="float:right"> <b><?php echo e(isset($sign)?__('Signed By:') . $lead['name'] : ''); ?></b></p>
        </div>
    </div>
</body><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/lead/signed_proposal.blade.php ENDPATH**/ ?>