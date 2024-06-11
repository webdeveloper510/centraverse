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
    white-space: normal;
    overflow: hidden;
    text-overflow: ellipsis;

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
    margin-top: 10px;
    /* page-break-inside: avoid; */
}

</style>
<body>
<div class="img-section">
        <img src="{{ Storage::url('uploads/logo/logo-light.png') }}" alt="Logo">
    </div>
    <!-- <hr> -->

    <div class="header">
        <h5>The Bond 1786 - Proposal</h5>
        <span>Venue Rental & Banquet Event Order</span>
    </div>
    <hr>
<div class="table-container ">
    <div class="header">
        <h5>Billing Summary -Estimate</h5>
    </div>
    <!-- <hr> -->
    <table class="billing">
        <thead>
            <tr>
                <th colspan="2">Name: {{$event['name']}}</th>
                <th colspan="2">Date: <?php echo date("d/m/Y"); ?></th>
                <th>Event: {{$event['type']}}</th>
            </tr>
            <tr>
                <th>Description</th>
                <!-- <th colspan="2">Additional</th> -->
                <th>Cost</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Venue Rental</td>

                <td>${{$billing_data['venue_rental']['cost']}}</td>
                <td>{{$billing_data['venue_rental']['quantity']}}</td>
                <td>${{$total[] = $billing_data['venue_rental']['cost'] * $billing_data['venue_rental']['quantity']}}
                </td>
                <td>{{$billing_data['venue_rental']['notes']}}</td>
            </tr>
            <tr>
                <td>Brunch / Lunch / Dinner Package</td>

                <td>${{$billing_data['food_package']['cost']}}</td>
                <td>{{$billing_data['food_package']['quantity']}}</td>
                <td>${{$total[] = $billing_data['food_package']['cost'] * $billing_data['food_package']['quantity']}}
                </td>
                <td>{{$billing_data['food_package']['notes']}}</td>
            </tr>
            <tr>
                <td>Bar Package</td>

                <td>${{$billing_data['bar_package']['cost']}}</td>
                <td>{{$billing_data['bar_package']['quantity']}}</td>
                <td>${{$total[] = $billing_data['bar_package']['cost']* $billing_data['bar_package']['quantity']}}
                </td>
                <td>{{$billing_data['bar_package']['notes']}}</td>
            </tr>
            <tr>
                <td>Hotel Rooms</td>

                <td>${{$billing_data['hotel_rooms']['cost']}}</td>
                <td>{{$billing_data['hotel_rooms']['quantity']}}</td>
                <td>${{$total[] = $billing_data['hotel_rooms']['cost'] * $billing_data['hotel_rooms']['quantity']}}
                </td>
                <td>{{$billing_data['hotel_rooms']['notes']}}</td>
            </tr>
            <tr>
                <td>Tent, Tables, Chairs, AV Equipment</td>

                <td>${{$billing_data['equipment']['cost']}}</td>
                <td>{{$billing_data['equipment']['quantity']}}</td>
                <td>${{$total[] = $billing_data['equipment']['cost'] * $billing_data['equipment']['quantity']}}</td>
                <td>{{$billing_data['equipment']['notes']}}</td>
            </tr>
            @if(!$billing_data['setup']['cost'] == '')
            <tr>
                <td>Welcome / Rehearsal / Special Setup</td>

                <td>${{$billing_data['setup']['cost']}}</td>
                <td>{{$billing_data['setup']['quantity']}}</td>
                <td>${{$total[] = $billing_data['setup']['cost'] * $billing_data['setup']['quantity']}}</td>
                <td>{{$billing_data['setup']['notes']}}</td>
            </tr>
            @endif
            <tr>
                <td>Special Requests / Others</td>

                <td>${{$billing_data['special_req']['cost']}}</td>
                <td>{{$billing_data['special_req']['quantity']}}</td>
                <td>${{$total[] = $billing_data['special_req']['cost'] * $billing_data['special_req']['quantity']}}
                </td>
                <td>{{$billing_data['special_req']['notes']}}</td>
            </tr>
            <tr>
                <td>Additional Items</td>

                <td>${{$billing_data['additional_items']['cost']}}</td>
                <td>{{$billing_data['additional_items']['quantity']}}</td>
                <td>${{$total[] = $billing_data['additional_items']['cost'] * $billing_data['additional_items']['quantity']}}
                </td>
                <td>{{$billing_data['additional_items']['notes']}}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3">Total</td>
                <td colspan="2">${{array_sum($total)}}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3">Sales, Occupancy Tax</td>
                <td colspan="2">${{ 7 * array_sum($total) / 100 }}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3">Service Charges & Gratuity</td>
                <td colspan="2">${{ 20 * array_sum($total) / 100 }}</td>
                <td></td>
            </tr>
            <tr class="total-row">
                <td colspan="3">Grand Total / Estimated Total</td>
                <td colspan="2">
                    ${{ $grandtotal = array_sum($total) + 20 * array_sum($total) / 100 + 7 * array_sum($total) / 100 }}
                </td>
                <td></td>
            </tr>
            <tr class="total-row">
                <td colspan="3">Deposits on file</td>
                <td colspan="2">${{ $deposit = $billing->deposits }}</td>
                <td></td>
            </tr>
            <tr class="balance-due">
                <td colspan="3">Balance Due</td>
                <td colspan="2">${{ $grandtotal - $deposit }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>
</body>

</html>
