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

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="img-section" style="width:30%; margin: 0 auto;display:flex;text-align: center;">
                    <img class="logo-img" src="<?php echo e(URL::asset('storage/uploads/logo/3_logo-light.png')); ?>"
                        style="width:40%;">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="text-align: center;">
                <span>The Bond 1786</span><br>
                <span>Venue Rental Proposal & Banquet Event Order</span>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-6">
                <dl>
                    <span><?php echo e(__('Name')); ?>: <?php echo e($lead->name); ?></span><br>
                    <span><?php echo e(__('Phone & Email')); ?>: <?php echo e($lead->phone); ?> , <?php echo e($lead->email); ?></span><br>
                    <span><?php echo e(__('Address')); ?>: <?php echo e($lead->lead_address); ?></span><br>
                    <span><?php echo e(__('Event Date')); ?>:<?php echo e(\Carbon\Carbon::parse($lead->start_date)->format('d M, Y')); ?></span>
                </dl>
            </div>

        </div>
        <hr>
        <div class="row mb-4">
            <div class="col-md-12">
                <table class="table table-bordered" style="width:100%">
                    <thead>
                        <tr style="background-color:#d3ead3; text-align:center">
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
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <h5 class="headings"><b>Billing Summary - ESTIMATE</b></h5>
                <table class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th
                                style="text-align:left; font-size:13px;text-align:left; padding:5px 5px; margin-left:5px;">
                                Name : <?php echo e(ucfirst($lead->name)); ?></th>
                            <th colspan="2" style="padding:5px 0px;margin-left: 5px;font-size:13px"></th>
                            <th colspan="3" style="text-align:left;text-align:left; padding:5px 5px; margin-left:5px;">
                                Date:<?php echo date("d/m/Y"); ?> </th>
                            <th style="text-align:left; font-size:13px;padding:5px 5px; margin-left:5px;">
                                Event: <?php echo e(ucfirst($lead->type)); ?></th>
                        </tr>
                        <tr style="background-color:#d3ead3; text-align:center">
                            <th>Description</th>
                            <th colspan="2"> Additional</th>
                            <th>Cost</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Venue Rental</td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>

                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                $<?php echo e($billing['venue_rental']['cost'] ?? 0); ?>

                            </td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                <?php echo e($billing['venue_rental']['quantity'] ?? 1); ?>

                            </td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                $<?php echo e($total[] = ($billing['venue_rental']['cost']?? 0)  * ($billing['venue_rental']['quantity'] ?? 1)); ?>

                            </td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                <?php echo e($lead->venue_selection); ?></td>
                        </tr>

                        <tr>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Brunch / Lunch /
                                Dinner Package</td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                $<?php echo e($billing['food_package']['cost'] ?? 0); ?></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                <?php echo e($billing['food_package']['quantity'] ?? 1); ?>

                            </td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                $<?php echo e($total[] =($billing['food_package']['cost'] ?? 0) * ($billing['food_package']['quantity'] ?? 1)); ?>

                            </td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                <?php echo e($lead->function); ?></td>

                        </tr>

                        <tr>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Hotel Rooms</td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                $<?php echo e($billing['hotel_rooms']['cost'] ?? 0); ?>

                            </td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                <?php echo e($billing['hotel_rooms']['quantity'] ?? 1); ?>

                            </td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">

                                $<?php echo e($total[] = ($billing['hotel_rooms']['cost'] ?? 0) *  ($billing['hotel_rooms']['quantity'] ?? 1)); ?>



                            </td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
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
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">$<?php echo e(array_sum($total)); ?>

                            </td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                        </tr>
                        <tr>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Sales, Occupancy
                                Tax</td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"> </td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                $<?php echo e(7* array_sum($total)/100); ?>

                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td
                                style="text-align:left;text-align:left; padding:5px 5px; margin-left:5px;font-size:13px;">
                                Service Charges & Gratuity</td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                $<?php echo e(20 * array_sum($total)/100); ?>

                            </td>

                            <td></td>
                        </tr>
                        <tr>
                            <td>-</td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"> </td>

                            <td></td>
                        </tr>
                        <tr>
                            <td style="background-color:#ffff00; padding:5px 5px; margin-left:5px;font-size:13px;">
                                Grand Total / Estimated Total</td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                $<?php echo e($grandtotal= array_sum($total) + 20* array_sum($total)/100 + 7* array_sum($total)/100); ?>

                            </td>

                            <td></td>
                        </tr>
                        <tr>
                            <td style="background-color:#d7e7d7; padding:5px 5px; margin-left:5px;font-size:13px;">
                                Deposits on file</td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td colspan="3"
                                style="background-color:#d7e7d7;padding:5px 5px; margin-left:5px;font-size:13px;">No
                                Deposits yet
                            </td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                        </tr>
                        <tr>
                            <td
                                style="background-color:#ffff00;text-align:left; padding:5px 5px; margin-left:5px;font-size:13px;">
                                balance due</td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td colspan="3"
                                style="padding:5px 5px; margin-left:5px;font-size:13px;background-color:#9fdb9f;">
                                $<?php echo e($grandtotal= array_sum($total) + 20* array_sum($total)/100 + 7* array_sum($total)/100); ?>


                            </td>
                            <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                        </tr>
                    </tbody>
                </table>

              <p><b>Customer Comments/Notes: <?php echo e($proposal->notes); ?></b></p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6" style="float:left;width:50%;">
                <strong>Authorized Signature:</strong> <br>
                <img src="<?php echo e($base64Image); ?>" style="width:30%; border-bottom:1px solid black;">
            </div>
            <div class="col-md-6">
                <strong style="margin-top:10px;">Signature:</strong><br>
                <img src="<?php echo e(@$sign); ?>" style="width:30%; border-bottom:1px solid black;">
            </div>
        </div>
    </div>
</body><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/lead/signed_proposal.blade.php ENDPATH**/ ?>