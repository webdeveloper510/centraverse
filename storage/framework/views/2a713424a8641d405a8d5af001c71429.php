<?php
$total = [];
$bar_pck = json_decode($event['bar_package'], true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Summary -Estimate</title>
</head>

<body>
    <h2>Billing Summary -Estimate</h2>
    <table style="width:100%">
        <thead>
            <tr>
                <th style="text-align:left; font-size:13px;text-align:left; padding:5px 5px; margin-left:5px;">Name : <?php echo e($event['name']); ?></th>
                <th colspan="2" style="padding:5px 0px;margin-left :5px;font-size:13px"></th>
                <th colspan="3" style="text-align:left;text-align:left; padding:5px 5px; margin-left:5px;">Date:<?php echo date("d/m/Y"); ?> </th>
                <th style="text-align:left; font-size:13px;padding:5px 5px; margin-left:5px;">Event: <?php echo e($event['type']); ?></th>
            </tr>
            <tr style="background-color:#063806;">
                <th style="color:#ffffff; font-size:13px;text-align:left; padding:5px 5px; margin-left:5px;">Description</th>
                <th colspan="2" style="color:#ffffff; font-size:13px;padding:5px 5px; margin-left:5px;"></th>
                <th style="color:#ffffff; font-size:13px;padding:5px 5px;margin-left: 5px;font-size:13px">Cost</th>
                <th style="color:#ffffff; font-size:13px;padding:5px 5px;margin-left: 5px;font-size:13px">Quantity</th>
                <th style="color:#ffffff; font-size:13px;padding:5px 5px;margin-left :5px;font-size:13px">Total Price</th>
                <th style="color:#ffffff; font-size:13px;padding:5px 5px;margin-left :5px;font-size:13px">Notes</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Venue Rental</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>

                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($billing_data['venue_rental']['cost']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['venue_rental']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($total[] = $billing_data['venue_rental']['cost'] * $billing_data['venue_rental']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['venue_rental']['notes']); ?></td>
            </tr>

            <tr>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Brunch / Lunch / Dinner Package</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>

                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($billing_data['food_package']['cost']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['food_package']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($total[] =$billing_data['food_package']['cost'] * $billing_data['food_package']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['food_package']['notes']); ?></td>
            </tr>
            <tr>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Bar Package</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($billing_data['bar_package']['cost']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['bar_package']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($total[] =$billing_data['bar_package']['cost'] * $billing_data['bar_package']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['bar_package']['notes']); ?></td>
            </tr>
            <tr>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Hotel Rooms</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;"></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($billing_data['hotel_rooms']['cost']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['hotel_rooms']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($total[] =$billing_data['hotel_rooms']['cost'] * $billing_data['hotel_rooms']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['hotel_rooms']['notes']); ?></td>
            </tr>
            <tr>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Tent, Tables, Chairs, AV Equipment</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($billing_data['equipment']['cost']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['equipment']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($total[] =$billing_data['equipment']['cost'] * $billing_data['equipment']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['equipment']['notes']); ?></td>
            </tr>
            <?php if(!$billing_data['setup']['cost'] == ''): ?>
            <tr>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Welcome / Rehearsal / Special Setup</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px"></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($billing_data['setup']['cost']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['setup']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($total[] =$billing_data['setup']['cost'] * $billing_data['setup']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['setup']['notes']); ?></td>
            </tr>
            <?php endif; ?>
            <tr>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Special Requests / Others</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($billing_data['special_req']['cost']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['special_req']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($total[] =$billing_data['special_req']['cost'] * $billing_data['special_req']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['special_req']['notes']); ?></td>

            </tr>
            <tr>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Additional Items</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($billing_data['additional_items']['cost']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['additional_items']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($total[] =$billing_data['additional_items']['cost'] * $billing_data['additional_items']['quantity']); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"><?php echo e($billing_data['additional_items']['notes']); ?></td>

            </tr>
            <tr>
                <td>-</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td colspan="3" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>

                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
            </tr>
            <tr>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Total</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e(array_sum($total)); ?></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
            </tr>
            <tr>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Sales, Occupancy Tax</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"> </td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e(7* array_sum($total)/100); ?></td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align:left;text-align:left; padding:5px 5px; margin-left:5px;font-size:13px;">Service Charges & Gratuity</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e(20 * array_sum($total)/100); ?></td>

                <td></td>
            </tr>
            <tr>
                <td>-</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>

                <td></td>
            </tr>
            <tr>
                <td style="background-color:#ffff00; padding:5px 5px; margin-left:5px;font-size:13px;">Grand Total / Estimated Total</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($grandtotal= array_sum($total) + 20* array_sum($total)/100 + 7* array_sum($total)/100); ?></td>

                <td></td>
            </tr>
            <tr>
                <td style="background-color:#d7e7d7; padding:5px 5px; margin-left:5px;font-size:13px;">Deposits on file</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td colspan="2" style="background-color:#d7e7d7;padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e($deposit= $billing->deposits); ?></td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
            </tr>
            <tr>
                <td style="background-color:#ffff00;text-align:left; padding:5px 5px; margin-left:5px;font-size:13px;">balance due</td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                <td colspan="3" style="padding:5px 5px; margin-left:5px;font-size:13px;background-color:#9fdb9f;">$<?php echo e($grandtotal - $deposit); ?></td>
                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
            </tr>
        </tbody>
    </table>
</body>
</html><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/billing/estimateview.blade.php ENDPATH**/ ?>