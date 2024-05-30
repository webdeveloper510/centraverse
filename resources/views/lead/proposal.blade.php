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
    <title>Proposal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo-img {
            width: 100px;
        }

        h4, h5 {
            color: #063806;
        }

        .table thead th {
            background-color: #d3ead3;
            text-align: center;
            font-weight: bold;
        }

        .table tbody td {
            text-align: center;
        }

        .table tfoot td {
            font-weight: bold;
            background-color: #f0f0f0;
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
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row card p-4">
            <div class="col-md-12">
                <form method="POST" action="{{ route('lead.proposalresponse', urlencode(encrypt($lead->id))) }}" id='formdata'>
                    @csrf
                    <input type="hidden" name="proposal" value="{{ $_GET['prop'] ?? '' }}">
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <div class="img-section">
                                <img class="logo-img" src="{{ Storage::url('uploads/logo/3_logo-light.png') }}" alt="Logo">
                            </div>
                        </div>
                        <div class="col-md-8 mt-5">
                            <h4>The Bond 1786 - Proposal</h4>
                            <h5>Venue Rental & Banquet Event - Estimate</h5>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <dl>
                                <span>{{ __('Name') }}: {{ $lead->name }}</span><br>
                                <span>{{ __('Phone & Email') }}: {{ $lead->phone }} , {{ $lead->email }}</span><br>
                                <span>{{ __('Address') }}: {{ $lead->lead_address }}</span><br>
                                <span>{{ __('Event Date') }}: {{ \Carbon\Carbon::parse($lead->start_date)->format('d M, Y') }}</span>
                            </dl>
                        </div>
                        <div class="col-md-6 text-right">
                            <dl>
                                <span>{{ __('Primary Contact') }}: {{ $lead->name }}</span><br>
                                <span>{{ __('Phone') }}: {{ $lead->phone }}</span><br>
                                <span>{{ __('Email') }}: {{ $lead->email }}</span><br>
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
                                        <td>{{ \Carbon\Carbon::parse($lead->start_date)->format('d M, Y') }}</td>
                                        <td>
                                            @if($lead->start_time == $lead->end_time)
                                                --
                                            @else
                                                {{ date('h:i A', strtotime($lead->start_time)) }} - {{ date('h:i A', strtotime($lead->end_time)) }}
                                            @endif
                                        </td>
                                        <td>{{ $lead->venue_selection }}</td>
                                        <td>{{ $lead->type }}</td>
                                        <td>{{ $lead->function }}</td>
                                        <td>{{ $lead->guest_count }}</td>
                                        <td>{{ $lead->rooms }}</td>
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
                                        <th>Name : {{ ucfirst($lead->name) }}</th>
                                        <th colspan="2"></th>
                                        <th colspan="3">Date: {{ date("d/m/Y") }}</th>
                                        <th>Event: {{ ucfirst($lead->type) }}</th>
                                    </tr>
                                    <tr style="background-color:#063806;">
                                        <th>Description</th>
                                        <th colspan="2">Additional</th>
                                        <th>Cost</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Venue Rental</td>
                                        <td colspan="2"></td>
                                        <td>${{ $billing['venue_rental']['cost'] ?? 0 }}</td>
                                        <td>{{ $billing['venue_rental']['quantity'] ?? 1 }}</td>
                                        <td>${{ $total[] = ($billing['venue_rental']['cost'] ?? 0) * ($billing['venue_rental']['quantity'] ?? 1) }}</td>
                                        <td>{{ $lead->venue_selection }}</td>
                                    </tr>
                                    <tr>
                                        <td>Brunch / Lunch / Dinner Package</td>
                                        <td colspan="2"></td>
                                        <td>${{ $billing['food_package']['cost'] ?? 0 }}</td>
                                        <td>{{ $billing['food_package']['quantity'] ?? 1 }}</td>
                                        <td>${{ $total[] = ($billing['food_package']['cost'] ?? 0) * ($billing['food_package']['quantity'] ?? 1) }}</td>
                                        <td>{{ $lead->function }}</td>
                                    </tr>
                                    <tr>
                                        <td>Hotel Rooms</td>
                                        <td colspan="2"></td>
                                        <td>${{ $billing['hotel_rooms']['cost'] ?? 0 }}</td>
                                        <td>{{ $billing['hotel_rooms']['quantity'] ?? 1 }}</td>
                                        <td>${{ $total[] = ($billing['hotel_rooms']['cost'] ?? 0) * ($billing['hotel_rooms']['quantity'] ?? 1) }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Bar Package</td>
                                        <td colspan="2"></td>
                                        <td>${{ $billing['bar_package']['cost'] ?? 0 }}</td>
                                        <td>{{ $billing['bar_package']['quantity'] ?? 1 }}</td>
                                        <td>${{ $total[] = ($billing['bar_package']['cost'] ?? 0) * ($billing['bar_package']['quantity'] ?? 1) }}</td>
                                        <td>{{ $lead->bar }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td colspan="2"></td>
                                        <td colspan="2"></td>
                                        <td>${{ array_sum($total) }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Sales, Occupancy Tax (7%)</td>
                                        <td colspan="2"></td>
                                        <td colspan="2"></td>
                                        <td>${{ 7 * array_sum($total) / 100 }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Service Charges & Gratuity (20%)</td>
                                        <td colspan="2"></td>
                                        <td colspan="2"></td>
                                        <td>${{ 20 * array_sum($total) / 100 }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="background-color:#ffff00;">Grand Total / Estimated Total</td>
                                        <td colspan="2"></td>
                                        <td colspan="2"></td>
                                        <td>${{ $grandtotal = array_sum($total) + 20 * array_sum($total) / 100 + 7 * array_sum($total) / 100 }}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-5 mb-3">
                        <div class="col-md-12">
                       
                            <p>This proposal will be valid for 7 days from the date above. We require 30% of the estimated total as a deposit to secure the date, space, and time for your event. The next payment of 30% is due 6 months before the event date, with the final 40% due 7 days before your event date.</p>
                        </div>
                    </div>

                    <div class="row mt-5 mb-3">
                        <div class="col-md-12 text-center">
                            <h5>Authorization & Signature</h5><br>
                            <label for="signature" class="form-label">Please sign below:</label>

                            <div class="signature-section">
                                <canvas id="signature" class="signature-canvas"></canvas>
                            </div>
                            <button type="button" class="btn btn-secondary mt-2" onclick="clearSignature()">Clear</button>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                        
                        </div>
                    </div>

                    <div class="row mt-5 mb-3">
                        <div class="col-md-12 text-center">
                            <h5>Comments</h5>
                            <div class="form-group">
                                <textarea class="form-control" id="comments" name="comments" rows="4" placeholder="Enter any additional comments here..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12 text-center">
                        <!-- <button class="btn btn-success" style="float:right;margin-top:-40px">Submit</button> -->
                            <button class="btn btn-success btn-lg mr-2">Accept</button>
                            <button type="button" class="btn btn-danger btn-lg" onclick="window.print()">Decline</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function clearSignature() {
            var canvas = document.getElementById('signature');
            var ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        document.addEventListener("DOMContentLoaded", function () {
            var canvas = document.getElementById('signature');
            var ctx = canvas.getContext('2d');
            var isDrawing = false;
            var signature64 = document.getElementById('signature64');

            canvas.addEventListener('mousedown', function (e) {
                isDrawing = true;
                ctx.beginPath();
                ctx.moveTo(e.offsetX, e.offsetY);
            });

            canvas.addEventListener('mousemove', function (e) {
                if (isDrawing) {
                    ctx.lineTo(e.offsetX, e.offsetY);
                    ctx.stroke();
                }
            });

            canvas.addEventListener('mouseup', function () {
                isDrawing = false;
                signature64.value = canvas.toDataURL();
            });

            canvas.addEventListener('mouseout', function () {
                isDrawing = false;
            });
        });
    </script>
</body>

</html>
