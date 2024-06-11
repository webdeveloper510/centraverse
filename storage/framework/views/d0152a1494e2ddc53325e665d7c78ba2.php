<?php echo $__env->make('partials.admin.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style>
.container.mt-5 {
    max-width: 1111px;
}
</style>
<?php
$billing = App\Models\ProposalInfo::where('lead_id',$lead->id)->orderby('id','desc')->first();
if(isset($billing) && !empty($billing)){
    $billing= json_decode($billing->proposal_info,true);
}
$selectedvenue = explode(',', $lead->venue_selection);
$settings = App\Models\Utility::settings();
$imagePath = public_path('upload/signature/autorised_signature.png');
$imageData = base64_encode(file_get_contents($imagePath));
$base64Image = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . $imageData;

    $bufferedDate = \Carbon\Carbon::parse($lead->start_date)->subDays($settings['buffer_day']);
    $currentDate = \Carbon\Carbon::now();
    $finalDate = $bufferedDate->lt($currentDate) ? $currentDate : $bufferedDate;




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Agreement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        /* font-size: 12px; */
        color: #333;
        margin: 20px;
    }

    .container {
        background-color: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 1000px;
    }

    .logo-img {
        width: 100px;
    }

    

    .table thead th {
        background: linear-gradient(141.55deg, #48494B 3.46%, #48494B 99.86%), #48494B !important;
        color: white;
        text-align: center;
        font-weight: bold;
    }

    .table tbody td {
        text-align: center;
    }

    .table tfoot td {
        font-weight: bold;
        background-color: #dbdbdb;
    }

    .signature-canvas {
        border: 1px solid #333;
        border-radius: 8px;
        width: 50%;
        height: 165px;
    }

    .btn {
        border-radius: 20px;
    }

    .btn-success {
        background-color: #063806;
        border-color: #063806;
    }

    .btn-danger {
        background-color: #d9534f;
        border-color: #d43f3a;
    }

    .form-label {
        font-weight: bold;
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
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row card p-4">
            <div class="col-md-12">
                <form method="POST" action="<?php echo e(route('lead.proposalresponse', urlencode(encrypt($lead->id)))); ?>"
                    id='formdata'>
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="proposal" value="<?php echo e($_GET['prop'] ?? ''); ?>">
                    <div class="row">
                        <div class="img-section">
                            <img src="<?php echo e(Storage::url('uploads/logo/logo-light.png')); ?>" alt="Logo">
                        </div>
                        <!-- <hr> -->

                        <div class="header">
                            <h5><b>The Bond 1786 - Proposal</b></h5>
                            <span>Venue Rental & Banquet Event Order</span>
                        </div>
                        <hr>
                        
                        <div class="row mt-3">
                            <div class="col-md-12 ">
                                <dl>
                                    <span><b><?php echo e(__('Name')); ?></b>: <?php echo e($lead->name); ?></span><br>
                                    <span><b><?php echo e(__('Phone & Email')); ?></b>: <?php echo e($lead->phone); ?> ,
                                        <?php echo e($lead->email); ?></span><br>
                                    <span><b><?php echo e(__('Address')); ?></b>: <?php echo e($lead->lead_address); ?></span><br>
                                    <span><b><?php echo e(__('Event Date')); ?></b>:
                                        <?php echo e(\Carbon\Carbon::parse($lead->start_date)->format('d M, Y')); ?></span>
                                </dl>
                            </div>

                        </div>
                        <hr>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <table class="table table-bordered">
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
                                        <tr>
                                            <td><?php echo e(\Carbon\Carbon::parse($lead->start_date)->format('d M, Y')); ?></td>
                                            <td>
                                                <?php if($lead->start_time == $lead->end_time): ?>
                                                --
                                                <?php else: ?>
                                                <?php echo e(date('h:i A', strtotime($lead->start_time))); ?> -
                                                <?php echo e(date('h:i A', strtotime($lead->end_time))); ?>

                                                <?php endif; ?>
                                            </td>
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
                                <h5><b>Billing Summary - ESTIMATE</b></h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name : <?php echo e(ucfirst($lead->name)); ?></th>
                                            <th colspan="3">Date: <?php echo e(date("d/m/Y")); ?></th>
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
                                            <td>$<?php echo e($billing['venue_rental']['cost'] ?? 0); ?></td>
                                            <td><?php echo e($billing['venue_rental']['quantity'] ?? 1); ?></td>
                                            <td>$<?php echo e($total[] = ($billing['venue_rental']['cost'] ?? 0) * ($billing['venue_rental']['quantity'] ?? 1)); ?>

                                            </td>
                                            <td><?php echo e($billing['venue_rental']['notes']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Brunch / Lunch / Dinner Package</td>
                                            <td>$<?php echo e($billing['food_package']['cost'] ?? 0); ?></td>
                                            <td><?php echo e($billing['food_package']['quantity'] ?? 1); ?></td>
                                            <td>$<?php echo e($total[] = ($billing['food_package']['cost'] ?? 0) * ($billing['food_package']['quantity'] ?? 1)); ?>

                                            </td>
                                            <td><?php echo e($billing['food_package']['notes']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Hotel Rooms</td>
                                            <td>$<?php echo e($billing['hotel_rooms']['cost'] ?? 0); ?></td>
                                            <td><?php echo e($billing['hotel_rooms']['quantity'] ?? 1); ?></td>
                                            <td>$<?php echo e($total[] = ($billing['hotel_rooms']['cost'] ?? 0) * ($billing['hotel_rooms']['quantity'] ?? 1)); ?>

                                            </td>
                                            <td><?php echo e($billing['hotel_rooms']['notes']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Bar Package</td>
                                            <td>$<?php echo e($billing['bar_package']['cost'] ?? 0); ?></td>
                                            <td><?php echo e($billing['bar_package']['quantity'] ?? 1); ?></td>
                                            <td>$<?php echo e($total[] = ($billing['bar_package']['cost'] ?? 0) * ($billing['bar_package']['quantity'] ?? 1)); ?>

                                            </td>
                                            <td><?php echo e($billing['bar_package']['notes']); ?></td>
                                        </tr>
                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <td>Total</td>
                                            <td colspan="2"></td>
                                            <td>$<?php echo e(array_sum($total)); ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Sales, Occupancy Tax (7%)</td>
                                            <td colspan="2"></td>
                                            <td>$<?php echo e(7 * array_sum($total) / 100); ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Service Charges & Gratuity (20%)</td>
                                            <td colspan="2"></td>
                                            <td>$<?php echo e(20 * array_sum($total) / 100); ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td >Grand Total / Estimated Total</td>
                                            <td colspan="2"></td>
                                            <td>$<?php echo e($grandtotal = array_sum($total) + 20 * array_sum($total) / 100 + 7 * array_sum($total) / 100); ?>

                                            </td>
                                            <td></td>
                                        </tr>
</tfoot>
                                </table>
                            </div>
                        </div>

                      

                        <div class="row mt-5 mb-3">
                            <div class="col-md-12 text-center">
                                <h5>Authorization & Signature</h5><br>
                                <label for="signature" class="form-label">Please sign below:</label>

                                <div class="signature-section">
                                    <canvas id="signature" class="signature-canvas"></canvas>
                                </div>
                                <button type="button" class="btn btn-secondary mt-2"
                                    onclick="clearSignature()">Clear</button>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>

                            </div>
                        </div>

                        <div class="row mt-5 mb-3">
                            <div class="col-md-12 text-center">
                                <h5>Comments</h5>
                                <div class="form-group">
                                    <textarea class="form-control" id="comments" name="comments" rows="4"
                                        placeholder="Enter any additional comments here..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-12 text-center">
                                <!-- <button class="btn btn-success" style="float:right;margin-top:-40px">Submit</button> -->
                                <button class="btn btn-success btn-lg mr-2">Accept</button>
                                <button type="button" class="btn btn-danger btn-lg"
                                    onclick="window.print()">Print</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('libs/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>

    <script>
    function clearSignature() {
        var canvas = document.getElementById('signature');
        var ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
    document.addEventListener("DOMContentLoaded", function() {
        var canvas = document.getElementById('signature');
        var ctx = canvas.getContext('2d');
        var isDrawing = false;
        var signature64 = document.getElementById('signature64');

        canvas.addEventListener('mousedown', function(e) {
            isDrawing = true;
            ctx.beginPath();
            ctx.moveTo(e.offsetX, e.offsetY);
        });

        canvas.addEventListener('mousemove', function(e) {
            if (isDrawing) {
                ctx.lineTo(e.offsetX, e.offsetY);
                ctx.stroke();
            }
        });

        canvas.addEventListener('mouseup', function() {
            isDrawing = false;
            signature64.value = canvas.toDataURL();
        });

        canvas.addEventListener('mouseout', function() {
            isDrawing = false;
        });
    });
    </script>
</body>

</html>
<?php echo $__env->make('partials.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/lead/proposal.blade.php ENDPATH**/ ?>