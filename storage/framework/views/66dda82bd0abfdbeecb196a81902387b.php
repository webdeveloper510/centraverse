<?php
$selectedvenue = explode(',', $lead->venue_selection);
$settings = App\Models\Utility::settings();
$imagePath = public_path('upload/signature/autorised_signature.png');
$imageData = base64_encode(file_get_contents($imagePath));
$base64Image = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;
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
    <div class="container ">
        <div class="row card">
            <div class="col-md-12 ">
                <form method="POST" action="<?php echo e(route('lead.proposalresponse',urlencode(encrypt($lead->id)))); ?>"
                    id='formdata'>
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="img-section">
                                <img class="logo-img" src="<?php echo e(URL::asset('storage/uploads/logo/logo.png')); ?>"
                                    style="width:12%; margin:30px auto;display:flex;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                            <h4>The Bond 1786</h4>
                            <h4>Proposal</h4>
                            <h5>Venue Rental & Banquet Event - Estimate</h5>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <dl>
                                <span><?php echo e(__('Name')); ?>: <?php echo e($lead->name); ?></span><br>
                                <span><?php echo e(__('Phone & Email')); ?>: <?php echo e($lead->phone); ?> , <?php echo e($lead->email); ?></span><br>
                                <span><?php echo e(__('Address')); ?>: <?php echo e($lead->lead_address); ?></span><br>
                                <span><?php echo e(__('Event Date')); ?>:<?php echo e(\Carbon\Carbon::parse($lead->start_date)->format('d M, Y')); ?></span>
                            </dl>
                        </div>

                        <div class="col-md-6" style="text-align: end;">
                            <dl>
                                <span><?php echo e(__('Primary Contact')); ?>: <?php echo e($lead->name); ?></span><br>
                                <span><?php echo e(__('Phone')); ?>: <?php echo e($lead->phone); ?></span><br>
                                <span><?php echo e(__('Email')); ?>: <?php echo e($lead->email); ?></span><br>
                            </dl>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <dl>
                                <span><?php echo e(__('Deposit')); ?>:</span><br>
                                <span><?php echo e(__('Billing Method')); ?>:</span>
                            </dl>
                        </div>
                        <div class="col-md-6" style="text-align:end;">
                            <dl>
                                <span><?php echo e(__('Catering Service')); ?>: NA</span><br>
                            </dl>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <table border="1" style="width: 100%;">
                                <thead>
                                    <tr style="background-color:#d3ead3; text-align:center">
                                        <th>Event Date</th>
                                        <th>Time</th>
                                        <th>Venue</th>
                                        <th>Event</th>
                                        <th>Function</th>
                                        <th>Room</th>
                                        <td>Exp</td>
                                        <th>GTD</th>
                                        <th>Set</th>
                                        <th>RENTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="text-align:center">

                                        <td> <?php if($lead->start_date == $lead->end_date): ?>
                                            <?php echo e(\Carbon\Carbon::parse($lead->start_date)->format('d M, Y')); ?>

                                            <?php else: ?>
                                            <?php echo e(\Carbon\Carbon::parse($lead->start_date)->format('d M, Y')); ?> -
                                            <?php echo e(\Carbon\Carbon::parse($lead->end_date)->format('d M, Y')); ?>

                                            <?php endif; ?></td>

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
                                        <td><?php echo e($lead->rooms); ?></td>
                                        <td>Exp</td>
                                        <td>GTD</td>
                                        <td>Set</td>
                                        <td>RENTAL</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-12">
                        <h6 class="headings">Estimated Billing Summary</h6>
                            <table border="1" style="width:100%">
                                <thead>
                                    <tr>
                                        <th
                                            style="text-align:left; font-size:13px;text-align:left; padding:5px 5px; margin-left:5px;">
                                            Name : <?php echo e(ucfirst($lead->name)); ?></th>
                                        <th colspan="2" style="padding:5px 0px;margin-left: 5px;font-size:13px"></th>
                                        <th colspan="3"
                                            style="text-align:left;text-align:left; padding:5px 5px; margin-left:5px;">
                                            Date:<?php echo date("d/m/Y"); ?> </th>
                                        <th style="text-align:left; font-size:13px;padding:5px 5px; margin-left:5px;">
                                            Event: <?php echo e(ucfirst($lead->type)); ?></th>
                                    </tr>
                                    <tr style="background-color:#063806;">
                                        <th
                                            style="color:#ffffff; font-size:13px;text-align:left; padding:5px 5px; margin-left:5px;">
                                            Description</th>
                                        <th colspan="2"
                                            style="color:#ffffff; font-size:13px;padding:5px 5px; margin-left:5px;">
                                            Additional</th>
                                        <th
                                            style="color:#ffffff; font-size:13px;padding:5px 5px;margin-left :5px;font-size:13px">
                                            Cost</th>
                                        <th
                                            style="color:#ffffff; font-size:13px;padding:5px 5px;margin-left: 5px;font-size:13px">
                                            Quantity</th>
                                        <th
                                            style="color:#ffffff; font-size:13px;padding:5px 5px;margin-left :5px;font-size:13px">
                                            Total Price</th>
                                        <th
                                            style="color:#ffffff; font-size:13px;padding:5px 5px;margin-left :5px;font-size:13px">
                                            Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Venue Rental</td>
                                        <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>

                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                            <?php echo e($lead->venue_selection); ?></td>
                                    </tr>

                                    <tr>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Brunch / Lunch /
                                            Dinner Package</td>
                                        <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                           </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                            <?php echo e($lead->function); ?></td>

                                    </tr>
                                    <tr>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Bar Package</td>
                                        <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                          </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Hotel Rooms</td>
                                        <td colspan="2" style="padding:5px 5px; margin-left:5px;"></td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Tent, Tables,
                                            Chairs, AV Equipment</td>
                                        <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                          </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                                    </tr>

                                    <tr>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Welcome / Rehearsal
                                            / Special Setup</td>
                                        <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px"></td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                       </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Special Requests /
                                            Others</td>
                                        <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                          </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                            </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
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
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Sales, Occupancy
                                            Tax</td>
                                        <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                                        <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"> </td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
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
                                        </td>

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
                                        <td
                                            style="background-color:#ffff00; padding:5px 5px; margin-left:5px;font-size:13px;">
                                            Grand Total / Estimated Total</td>
                                        <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                                        <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                                        <td style="padding:5px 5px; margin-left:5px;font-size:13px;">
                                        </td>

                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="background-color:#d7e7d7; padding:5px 5px; margin-left:5px;font-size:13px;">
                                            Deposits on file</td>
                                        <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                                        <td colspan="2"
                                            style="background-color:#d7e7d7;padding:5px 5px; margin-left:5px;font-size:13px;">
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
                                            </td>
                                        <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                                    </tr>
                                </tbody>

                            </table>

                            <p class="text mt-2">
                                Please return signed contract with deposit no later than
                                <b><?php echo e(\Carbon\Carbon::parse($lead->start_date)->subDays($settings['buffer_day'])->format('d M, Y')); ?></b>
                                or this contract is no longer valid.<br>
                            </p>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Authorized Signature:</strong> <br>
                            <img src="<?php echo e($base64Image); ?>" style="width:30%; border-bottom:1px solid black;">
                        </div>
                        <div class="col-md-6">
                            <strong> Signature:</strong>
                            <br>
                            <div id="sig" class="mt-3">
                                <canvas id="signatureCanvas" width="300" class="signature-canvas"></canvas>
                                <input type="hidden" name="imageData" id="imageData">
                            </div>
                            <button type="button" id="clearButton" class="btn btn-danger btn-sm mt-1">Clear
                                Signature</button>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button class="btn btn-success" style="float:right;margin-top:-40px">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<style>
canvas#signatureCanvas {
    border: 1px solid black;
    width: 60%;
    height: 157px;
    border-radius: 8px;
}
</style>
<?php echo $__env->make('partials.admin.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var canvas = document.getElementById('signatureCanvas');
    var signaturePad = new SignaturePad(canvas);

    function clearCanvas() {
        signaturePad.clear();
    }
    document.getElementById('clearButton').addEventListener('click', function(e) {
        e.preventDefault();
        clearCanvas();
    });
    document.querySelector('form').addEventListener('submit', function() {
        if (signaturePad.points.length != 0) {
            document.getElementById('imageData').value = signaturePad.toDataURL();
        } else {
            document.getElementById('imageData').value = '';
        }
    });
});
</script><?php /**PATH /home/crmcentraverse/public_html/resources/views/lead/proposal.blade.php ENDPATH**/ ?>