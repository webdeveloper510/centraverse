<h6>Billing Summary -Estimate</h6>
                <table>
                    <thead>
                        <tr>
                            <th style="text-align:left; font-size:13px;text-align:left; padding:5px 5px; margin-left:5px;">Name : {{$event['name']}}</th>
                            <th colspan = "2" style="padding:5px 0px;margin-left :5px;font-size:13px"></th>
                            <th colspan = "3"  style="text-align:left;text-align:left; padding:5px 5px; margin-left:5px;">Date:<?php echo date("d/m/Y"); ?> </th>
                            <th  style="text-align:left; font-size:13px;padding:5px 5px; margin-left:5px;">Event: {{$event['type']}}</th>
                        </tr>
                        <tr style="background-color:#063806;">
                            <th style="color:#ffffff; font-size:13px;text-align:left; padding:5px 5px; margin-left:5px;">Description</th>
                            <th colspan = "2" style="color:#ffffff; font-size:13px;padding:5px 5px; margin-left:5px;">Additional</th>
                            <th  style="color:#ffffff; font-size:13px;padding:5px 5px;margin-left: 5px;font-size:13px">Cost</th>
                            <th  style="color:#ffffff; font-size:13px;padding:5px 5px;margin-left: 5px;font-size:13px">Quantity</th>
                            <th  style="color:#ffffff; font-size:13px;padding:5px 5px;margin-left :5px;font-size:13px">Total Price</th>
                            <th style="color:#ffffff; font-size:13px;padding:5px 5px;margin-left :5px;font-size:13px">Notes</th>
                        </tr>
                    </thead>
                    <tbody>    
                        <tr>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Venue Rental</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">{{$billing_data['venue_rental']['cost']}}</td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">{{$billing_data['venue_rental']['quantity']}}</td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">{{$event['venue_selection']}}</td>
                        </tr>
                        
                        <tr>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Brunch / Lunch / Dinner Package</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">{{$event['guest_count']}}</td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">{{$event['function']}}</td>
                        </tr>
                        <tr>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Bar Package</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">{{$event['guest_count']/2}}</td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">{{$event['bar']}}</td>
                        </tr>
                        <tr>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Hotel Rooms</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">{{$event['rooms']}}</td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                        </tr>
                        <tr>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Tent, Tables, Chairs, AV Equipment</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">{{$event['guest_count']}}</td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Chairs</td>
                        </tr>
                        <tr>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Welcome / Rehearsal / Special Setup</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;font-size:13px"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">1</td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                        </tr>
                        <tr>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Special Requests / Others</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">1</td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Bartender Fee</td>
                            
                        </tr>
                        <tr>
                            <td>-</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td colspan = "3" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                        </tr>
                        <tr>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Total</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td colspan = "3" style="padding:5px 5px; margin-left:5px;font-size:13px;">$</td>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                        </tr>
                        <tr>
                            <td style="padding:5px 5px; margin-left:5px;font-size:13px;">Sales, Occupancy Tax</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td colspan = "3" style="padding:5px 5px; margin-left:5px;font-size:13px;"> $</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align:left;text-align:left; padding:5px 5px; margin-left:5px;font-size:13px;">Service Charges & Gratuity</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td colspan = "3" style="padding:5px 5px; margin-left:5px;font-size:13px;">$</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>-</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td colspan = "3" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="background-color:#ffff00; padding:5px 5px; margin-left:5px;font-size:13px;">Grand Total / Estimated Total</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td colspan = "3" style="padding:5px 5px; margin-left:5px;font-size:13px;">$</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="background-color:#d7e7d7; padding:5px 5px; margin-left:5px;font-size:13px;">Deposits on file</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td colspan = "3" style="background-color:#d7e7d7;padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td></td>
                        </tr> <tr>
                            <td style="background-color:#ffff00;text-align:left; padding:5px 5px; margin-left:5px;font-size:13px;">balance due</td>
                            <td colspan = "2" style="padding:5px 5px; margin-left:5px;font-size:13px;"></td>
                            <td colspan = "3" style="padding:5px 5px; margin-left:5px;font-size:13px;background-color:#9fdb9f;">$</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>