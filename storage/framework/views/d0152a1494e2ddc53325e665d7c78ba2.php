<?php 
  $selectedvenue= explode(',',$lead->venue_selection);
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
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <title>Proposal</title>
</head>

<body>
    <div class="container">
        <div class = "row">
            <div class= "col-md-12">
                <form method= "POST" action = "<?php echo e(route('lead.proposalresponse',urlencode(encrypt($lead->id)))); ?>" id = 'formdata'>
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="img-section">
                                    <img class="logo-img" src="<?php echo e(URL::asset('storage/uploads/logo/logo.png')); ?>" style="width:12%; margin:30px auto;display:flex;">
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-12" style = "text-align: center;">
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
                            
                            <div class="col-md-6" style = "text-align: end;">
                                <dl>
                                    <span ><?php echo e(__('Primary Contact')); ?>: <?php echo e($lead->name); ?></span><br>
                                    <span ><?php echo e(__('Phone')); ?>: <?php echo e($lead->phone); ?></span><br>
                                    <span ><?php echo e(__('Email')); ?>: <?php echo e($lead->email); ?></span><br>
                                </dl>
                            </div>     
                        </div>
                    <hr>
                        <div class="row" >
                            <div class="col-md-6" >
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
                        <div class = "row mb-4"> 
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
                                            <td >Start Date:<?php echo e(\Carbon\Carbon::parse($lead->start_date)->format('d M, Y')); ?> <br>
                                            End Date: <?php echo e(\Carbon\Carbon::parse($lead->end_date)->format('d M, Y')); ?></td>
                                            <td  >Start Time:<?php echo e(date('h:i A', strtotime($lead->start_time))); ?> <br>
                                            End time:<?php echo e(date('h:i A', strtotime($lead->end_time))); ?></td>
                                            <td ><?php echo e($lead->venue_selection); ?></td>
                                            <td ><?php echo e($lead->type); ?></td>
                                            <td ><?php echo e($lead->function); ?></td>
                                            <td ><?php echo e($lead->rooms); ?></td>
                                            <td >Exp</td>
                                            <td >GTD</td>
                                            <td >Set</td> 
                                            <td >RENTAL</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mb-4" >
                            <div class="col-md-6" style="width:50%; border:1px solid black;">
                                <p class="mt-5"style="text-align:center;border:1px solid black; padding:10px;font-weight:bold;">Menu Selections</p>  
                                <table border ="1">
                                    <thead>
                                        <tr>
                                            <th style="font-size:13px;font-weight:300;padding:10px 25px;">Start:<?php echo e(date('h:i A', strtotime($lead->start_time))); ?></th>
                                            <th style="font-size:13px;font-weight:300;padding:0px 25px;">End: <?php echo e(date('h:i A', strtotime($lead->end_time))); ?> </th>
                                            <th style="font-size:13px;font-weight:300;padding:10px 25px;">Function : <?php echo e($lead->function); ?></th>
                                        </tr>
                                    </thead>
                                    </tbody>  
                                </table>          
                                <!-- <div class="text" style="border:1px solid black;"> 
                                    <p style="text-align:center;height:6%;"> </p>
                                </div> -->
                                <p class="mt-5" style="text-align:center; border:1px solid black;padding:5px;font-weight:bold;">Audio Visual Requirements
                                Miscellaneous</p>
                            </div>
                            <div class="col-md-6" style="border:1px solid black; width:50%;text-align:center;">
                                <p class="mt-5" style="text-align:center;border:1px solid black; padding:10px;font-weight:bold;">Setup Requirements</p>
                                <!-- <div class="text" style="border:1px solid black;height:6%;"> 
                                    <p style="text-align:center;"> TBD</p>
                                </div> -->
                                <p style="text-align:center; border:1px solid black;padding:10px;font-weight:bold;">Entertainment, Décor and<br>
                                Miscellaneous</p>
                                <!-- <div class="text" style="border:1px solid black;"> 
                                    <p style="text-align:center;height:3%;"> </p>
                                </div> -->
                                <p class="mt-5" style="text-align:center; border:1px solid black;padding:5px;font-weight:bold;">Audio Visual Requirements</p>
                                <!-- <div class="text" style="border:1px solid black;"> 
                                    <p style="text-align:center;height:2%;"> </p>
                                </div> -->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text">This contract defines the terms and conditions under which Lotus Estate, LLC dba The Bond 1786, (hereinafter referred to as The Bond or The
                                    Bond 1786), and <b><?php echo e($lead->name); ?></b>(hereafter referred to as the Customer) agree to the Customer’s use of The Bond 1786 facilities on <b><?php echo e(\Carbon\Carbon::parse($lead->start_date)->format('d M, Y')); ?></b>
                                    (reception/event date). This contract constitutes the entire agreement between the parties and becomes binding upon the signature of
                                    both parties. The contract may not be amended or changed unless executed in writing and signed by The Bond 1786 and the Customer.
                                </p>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-md-12">
                                    <h6 >Venue Selected</h6>
                                    <p><?php echo e($lead->venue_selection); ?></p><br><br>
                                    <h6 > Hotel Rooms Required: </h6> <?php echo e($lead->rooms); ?>

                                    <p class="text">
                                            The venue/s described above has been reserved for you for the date and time stipulated. Please note that the hours assigned to your event include all set-up and
                                            all clean-up, including the set-up and clean-up of all subcontractors that you may utilize. It is understood you will adhere to and follow the terms of this Agreement,
                                            and you will be responsible for any damage to the premises and site, including the behavior of your guests, invitees, agents, or sub-contractors resulting from your
                                            use of venue/s.
                                        </p>
                                    <h6  >Rental Deposit and Payment Agreement</h6>
                                        <p class="text">
                                            The total cost for use of The Bond 1786 and its facilities described in this contract is listed above. To reserve services on the
                                            date/s requested, The Bond 1786 requires this contract be signed by Customer and an <b> initial payment of $3,000</b> be deposited.
                                            The balance is due prior to the event date. Deposits and payments will be made at the time of signing of the Contract. Payments
                                            can be made by cash, Bank checks (made payable to <b>The Bond 1786</b>), on the schedule noted below. A receipt from The Bond
                                            1786 will be provided for each.
                                        </p>
                                    <!-- <h6  >Billing Summary</h6> -->
                                
                                
                                    <h3 style = "text-align:center">TERMS AND CONDITIONS</h3>
                                    <h6  >FOOD AND ALCOHOLIC BEVERAGES and 3RD PARTY / ON-SITE VENDORS</h6>
                                    <p class="text">
                                            The Client and their guests agree to not bring in any unauthorized food or beverage into The Bond 1786. The Establishment does not allow outside alcoholic beverages, unless agreed with the Terms. Catering service is available at a cost; please see your
                                            Coordinator for menu selections. The Coordinator / Owner reserves the right to approve all vendors providing services to the event to include food, 
                                            audio/visual, and merchandise.
                                    </p>
                                    <p class="text">It is understood and agreed that the Customer may serve beverages containing alcohol (including but not limit to beer, wine, champagne, mixed drinks 
                                    with liquor, etc., by way of example) hereinafter call “Alcohol”, upon the following terms and conditions:
                                    </p>
                                    <ul>
                                        <li> A copy of Liquor License/Permit must be on records at the Establishment before any alcohol can be served at your event, by a 3 rd Party Vendor.</li>
                                        <li>A food waiver must be on file for all outside food brought to the Establishment.</li> 
                                        <li>Under NO circumstances shall Client(s) sell or attempt to sell any Alcohol to anyone.</li>
                                        <li>Customer shall not permit any person under the age of twenty-one (21) to consume alcohol regardless of whether the person is accompanied by a parent or guardian.</li>
                                        <li>Customer hereby agrees to use their best efforts to ensure that Alcohol will not be served to anyone who is intoxicated or appears to be intoxicated.</li>
                                        <li>Customer hereby expressly grants to The Bond 1786, at The Bond’s sole discretion and option, to instruct the security officer(s) to remove any person(s) from the Venue, if in the opinion of The Bond 1786 representative in charge, the licensed
                                        and bonded Bartender and/or the security officer(s) the person(s) is intoxicated, unruly or could present a danger to themselves or others, and/or the Venue.</li>
                                        <li>Customer hereby agrees to be liable and responsible for all act(s) and actions of every kind and nature for each person in attendance at Customer’s function or event.</li>
                                        <li>Caterers: No caterer can be used without prior approval of The Bond 1786. Each caterer approved should be familiar with The Bond 1786 venues, rules, and regulations.</li>
                                        <li>Each one of these caterers will have to carry required liability insurance for The Bond.</li>
                                        <li>If Customer requests a different food service company, they must be pre-approved by The Bond 1786 and meet their rules and regulations.</li>
                                        <li>Your catering company is responsible for the set-up, break-down and clean-up of the catered site. Please allow appropriate time for break-down and clean-up to meet the contracted timelines.</li>
                                        <li>All event trash must be disposed of in the designated areas at the conclusion of the event.</li>
                                        <li>ALL vendors must adhere to the terms of our guidelines, and it is the Customer’s responsibility to share these guidelines with them.</li>
                                        <li>Usage of cooking equipment such as fryers are allowed, with proper safety precautions, DOH certifications and requirements fully satisfied. The areas these can be used should be pre-evaluated and approved, along with the provisions for oil
                                        disposal.</li>
                                        <li>All food brought into the Establishment must be prepared and ready for reheat with chafing dish and sterno / Gas fuel.</li>
                                        <li>Food and beverage must be contained in your contracted event space only and should not be brought into the lobby or other Establishment public space.</li>
                                    </ul> 
                                    <h6  >CANCELLATION POLICY & DATE CHANGES:</h6>
                                    <p class="text"><b>Small & Private Events -</b> A written cancellation request must be received by The Bond sales office no later than 30 days prior to contracted event date to avoid 
                                    forfeit of deposit or payment toward expected revenue. Cancellations received after this time will incur a charge in the amount of the contracted revenue. 
                                    100% of expected revenue is not refundable if cancellation is made between 1-29 days prior to event date. Company or individual contracting the event will be 
                                    assessed this charge through either a deduction from the prepayment or charge credit card on file, whichever applies. If cash payment, you will be invoiced for
                                    any cancellation fees. Events that are booked within the 29-day period cannot be cancelled and are non-refundable, unless agreed upon and approved during the 
                                    booking of the Event.</p>
                                    
                                    <b>Large Events & Weddings -</b>
                                    <p>
                                    1. Changes:  In the unlikely event the Customer is required to change the date of the event or Wedding, every effort will be made by The Bond 1786 to transfer reservations to support the new date.  The Customer agrees that in the event of a date change, any expenses including, but not limited to, deposits, and fees that are non-refundable, and non-transferable are the sole responsibility of Customer.  The Customer further understands that last minute changes can impact the quality of the event, and that The Bond 1786 is not responsible for these compromises in quality. 
                                    
                                    2. Cancellation:  In the event customer cancels the event, customer shall notify The Bond 1786 immediately in writing or by email.  Once cancelled, the Customer shall be responsible for agreed liquidated damages as follows.  The parties agree that the liquidated damages are reasonable. 
                                    </p>
                                    <ul>
                                        <li> In the event Customer cancels the event more than one year prior to the event, Customer shall forfeit to The Bond 1786 as liquidated damages one-half (1/2) of deposit.</li>
                                        <li>In the event customer cancels the event less than one year but not more than six months prior to the event, Customer shall forfeit to The Bond 1786 as liquidated damages the entire deposit. </li>
                                        <li> In the event Customer cancels the event less than six (6) months but more than three (3) months prior to the event, Customer shall forfeit to The Bond 1786 as liquidated damages fifty percent (50 %) of the rental fee. </li>
                                        <li> In the event customer cancels the event less than three (3) months prior to the event, Customer shall forfeit to The Bond 1786 as liquidated damages the entire rental fee. </li>
                                    </ul>
                                    <h6  > GUARANTEE NUMBER OF GUESTS: </h6>
                                    <p class="text">The (GTD) guaranteed count will be the assumed as the minimum billable count, however the final guaranteed number of guests is due (7) seven working days prior to
                                    the start of your event. Should the final guarantee not be received (7) seven working days prior to the above event(s), the basis for the final billing calculation will 
                                    be the above contracted GTD (guaranteed) number of guests, or the actual number of guests attending the event, whichever is higher.  </p>
                                    
                                    <h6  >SET-UP & EVENT SET-UP LIMITATIONS:</h6> <p>Any space / room set up changes made on the day of the event will be charged a $500 fee. Additional time required above 
                                    the contracted time will be charged a $250 per hour fee. Client may bring their own linen, decorations, and equipment but must be approved by the Coordinator / Owner first.
                                    Upgrade tablecloth, chair cover, audio-visual is available at a cost; please see your Coordinator for options. Usage of other event space or Establishment public space must
                                    be under contract or usage is chargeable and must be approved by the Coordinator / Owner. </p> 
                                    <ul>
                                        <li>All property belonging to Customer, Customer’s invitees, guests, agents and sub-contractors, and all equipment shall be delivered, set-up and removed on the day of the event. 
                                        Should the Customer need earlier access for set-up purposes, this can be arranged for an additional fee.  The Customer is ultimately responsible for property belonging to the 
                                        Customer’s invitees, guests, agents, and sub-contractors. 
                                        </li>
                                        <li>Rental items must be scheduled for pick-up no later than within 24 hours of the conclusion of the Event.</li>
                                        <li>Alcohol service must stop no later than 11:00 PM (or maximum of 5-hours if occurring sooner).</li>
                                        <li>Music (DJ or live music) must stop no later than 11:00 PM</li>
                                        <li>All guests must be off The Bond 1786 premises no later than midnight the day of the event (except clean-up crew, with all clean-ups to be done by 1:00 am).</li>
                                    </ul>
                                    <h6  >FINAL PAYMENT & PAYMENT POLICY:</h6><p> 100% of expected / outstanding balance payment is due 14 days prior to event date. The Establishment will terminate the contract 
                                    if payment is not received by contracted due date. If deposit or full payment is not received as required by contracted date, the contract will be canceled. For check payment 
                                    please send payment to: The Bond 1786, (3, Hudson Street, Warrensburg, NY 12885). Rooms must be paid for before entry is granted unless alternative payment arrangements have been
                                    pre-established for event payment. </p>
                            
                                    <h6  >DAMAGES:</h6><p> The individual signing this agreement will be responsible for damage to or loss of revenue by the Establishment due to activities of the guests under this contract, 
                                    including but not limited to the building, Establishment equipment, decorations, fixtures, furniture, and refunds due to the negligence of your guests. The deposit which is typically 
                                    applied towards the total bills of the organized event, however in case of settlement of damages, the deposit may be applied towards the total damages, including the use of the Credit 
                                    Card on file, should there be a remaining balance due to The Bond 1786.  </p>
                                    
                                    <h6  >COMPLIANCE WITH LAWS:</h6> <p>You will comply with all applicable local and national laws, codes, regulations, ordinances, and rules with respect to your obligations under 
                                    this Agreement and the services to be provided by you hereunder, including but not limited to any laws and regulations governing event organizers. You represent, warrant, and agree 
                                    that you, are currently, and will continue to be for the term of this Agreement, in compliance with all applicable local, state, federal regulations or laws. </p>
                                    
                                    <h6  >INDEMNIFICATION:</h6><p> To the extent permitted by law, you agree to protect, indemnify, defend and hold harmless the Establishment, Lotus Estate, LLC dba The Bond 1786 
                                    and the owner of the Establishment, and each of their respective employees and agents against all claims, losses or damages to persons or property, governmental charges or fines,
                                    and costs including reasonable attorneys' fees arising out of or connected with the provision of goods and services and your group's use of Establishment's premises hereunder and your
                                    provision of services except to the extent that such claims arise out of the negligence or willful misconduct of the Establishment, or its employees or agents acting within the scope 
                                    of their authority. You further agree to obtain and keep in force General Liability Insurance covering your contractual obligations hereunder with limits of not less than $1,000,000 per
                                    occurrence and provide the Establishment with proof of insurance with Establishment named as additional insured and a certificate holder. The Establishment reserves the right to require 
                                    client to provide security services for the event at client cost.  </p>
                                    
                                    
                                    <h6  >RESPONSIBILITY AND SECURITY</h6>
                                    <p class="text">
                                    The Bond 1786 does not accept any responsibility for damage to or loss of any articles or property left at The Bond 1786 prior to, during, or after the event.  
                                    The Customer(s) agrees to be responsible for any damage done to The Bond 1786 Complex by the Customer(s), his or her guests, invitees, employees, or other agents under the Customer(s) 
                                    control.  Further, The Bond 1786 shall not be liable for any loss, damage or injury of any kind or character to any person or property caused by or arising from an act or omission of the 
                                    Customer(s), or any of his or her guests, invitees, employees or other agents from any accident or casualty occasioned by the failure of the Customer(s) to maintain the premises in a 
                                    safe condition or arising from any other cause,  The Customer(s), as a material part of the consideration of this agreement, hereby waives on its behalf all claims and demands against 
                                    The Bond 1786 for any such loss, damage, or injury of claims and demands against The Bond 1786 for any such loss, damage, or injury of the Customer(s), and hereby agrees to indemnify
                                    and hold The Bond 1786 free and harmless from all liability of any such loss, damage or injury to his or her persons, and from all costs and expenses arising there from, including but
                                    not limited to attorney fees. </p>
                                    
                                    <h6  >EXCUSE OF PERFORMANCE (Force Majeure) </h6>
                                    <p class="text">The performance of this agreement by The Bond 1786 is subject to acts of God, war, government regulations or advisory, disaster, fire, accident, or other casualty,
                                    strikes or threats of strikes, labor disputes, civil disorder, acts and/or threats of terrorism, or curtailment of transportation services or facilities, or similar cause 
                                    beyond the control of The Bond.  Should the event be cancelled through a Force Majeure event, all fees paid by Customer to The Bond 1786 will be returned to Customer within 
                                    thirty (30) days or The Bond 1786 will allow for the event to be rescheduled, pending availability, with no penalty, and there shall be no further liability between the parties. </p>
                                    
                                    <h6  >SEVERABILITY</h6> 
                                    <p class="text">If any provisions of this Agreement shall be held to be invalid or unenforceable for any reason, the remaining provisions shall continue to be valid and enforceable.
                                    If a court finds that any provision of this Agreement is invalid or unenforceable, but that by limiting such provision it would become valid and enforceable, then such provision 
                                    shall be deemed to be written, construed, and enforced as so limited. </p>
                                    
                                    <h6  >INSURANCE</h6> 
                                    <p class="text">The Bond 1786 shall carry liability and other insurance in such dollar amount as deemed necessary by The Bond 1786 to protect itself against any claims arising from any
                                    officially scheduled activities during the event/program period(s). Any third-party suppliers/vendors used or contracted by Customer shall carry liability and other necessary 
                                    insurance in the amount of no less than One Million Dollars ($1,000,000) to protect itself against any claims arising from any officially scheduled activities during the 
                                    event/program period(s); and to indemnify The Bond 1786 which shall be named as an additional insured for the duration of this Contract. </p>
                                    
                                    
                                    
                                    <h6  >CONDITIONS of USE</h6> 
                                    <p class="text">Renter’s activities during the Rental Period must be compatible with use of the building/grounds and activities in areas adjacent to the Rental Space and building.  
                                    This includes but is not limited to playing loud music or making any noise at a level that is not reasonable under the circumstances.  Smoking is not permitted anywhere in the 
                                    buildings.  The Rental Space must be cleaned and returned in a condition at the end of an event to a reasonable appearance as it was prior to the rental.  Customer is responsible 
                                    for the removal of all decorations and trash from the property or placed in a dumpster provided on site.   </p>
                                    
                                    <h6  >RESERVATION OF RIGHTS</h6> 
                                    <p class="text">The Bond 1786 reserves the right to cancel agreements for non-payment or for non-compliance with any of the Rules and Conditions of Usage set forth in the Agreement.  
                                    The rights of The Bond 1786 as set-forth in this Agreement are in addition to any rights or remedies which may be available to The Bond 1786 at law or equity. 
                                    </p>
                                    <h6  >JURISDICTION & ATTORNEY’S FEES</h6>
                                    <p class="text">The Parties agree that this Agreement will be governed by the laws of the County of Warren in the State of New York.  The Parties consent to the exclusive jurisdiction of 
                                    and venue in Warren County, New York and the parties expressly consent to personal jurisdiction and venue in said Court. The parties agree that in the event of a breach of this 
                                    Agreement or any dispute arises in any way relating to this Agreement, the prevailing party in any arbitration or court proceeding will be entitled to recover an award of its 
                                    reasonable attorney’s fees, costs and pre and post judgment interest.</p>
                                    <h6  >RULES AND CONTIONS FOR USAGE</h6> 
                    
                                    <h6  >CANDLES:</h6>  <p>The use of any type of flame is prohibited in all buildings and throughout the site.  The new “flameless candles” which are battery operated are permitted 
                                    for use.  </p>
                    
                                    <h6>CHILDREN:</h6> <p>  There have been times we have had guests at the complex whose children were not properly supervised.  Children under the age of 18 are your complete responsibility.  
                                    Please know where your children are always and make certain that they clearly understand The Rules (They are not permitted near the pond). </p> 
                    
                                    <h6  >CONTACT PERSON:</h6>   <p> You must designate one individual as your Contact Person.  This must not be someone heavily involved in the activities of the day, as they will be too
                                    busy to effectively communicate with our on-site coordinator should problems/concerns/questions.  (When questions arise, do not designate any member of your bridal party, 
                                    photographer, caterer, florist, or musician as your liaison). </p>
                    
                                    <h6  >DELIVERIES / DELIVERY TRUCKS:</h6>   <p>There is a size limit to the height and length of vehicles entering the complex due to the damage inflicted to our trees. 
                                    Please coordinate limits with us.  We will need to know the delivery dates and times of any rentals, so we can meet them and show them where to drop their rentals. </p>
                    
                                    <h6  >DECORATIONS:</h6>   <p>Only pushpins and drafting tape may be used to affix decorations and/or signs.  Any other decorations, signage, electrical configurations, or
                                    construction must be pre-approved by The Bond.  Decorations may not be hung from light fixtures.  All decorations must be removed without leaving damages directly
                                    following the departure of the last guest unless special arrangements have been made between the Customer(s) and the venue.   
                                    ALL DECORATIONS MUST BE APPROVED BY The Bond 1786. The Customer is responsible for all damages to The Bond 1786 Venues and surround site.  It is the Customer’s responsibility to 
                                    remove all decorations and return Venue to the condition in which it was received. </p>
                    
                                    <h6  >EVENT ENDING TIME:</h6> <p> All events must end by 11:00 PM to comply with Township/County sound ordinances and to allow for clean-up and closure of the site by 1:00 AM.  </p>
                    
                                    <h6  >GARBAGE DISPOSAL:</h6>   <p>Trash disposal, other than the garbage disposal of items generated by the caterer, is your responsibility.  Immediately following the event, 
                                    please have your Clean-up Committee take a few minutes to walk all the areas of the building and property that have been utilized for the event and pick-up any refuse that may
                                    have been dropped or blown around.  This trash may be placed into The Bond 1786 dumpsters. Customer shall be responsible for returning the Venue (and site if applicable) to the 
                                    condition in which it was provided to them.  All property belonging to Customer, Customer’s invitees, guests, agents, and sub-contractors, shall be removed by the end of the 
                                    rental period.  All property remaining on the premises beyond the end of the rental agreement will be removed by The Bond 1786 at The Customers cost.  Should the Customer 
                                    need special consideration for the removal of property beyond the rental period, this can be arranged prior to the beginning of the event for an additional fee.  
                                    The Bond 1786 is not responsible for any property left behind by Customer, Customer’s guests, invitees, agents, and sub-contractors. </p>
                    
                                    <h6  >GUESTS:</h6>   <p>Please keep in mind when inviting Guests to your event, that you are inviting them to our home.  We will expect visitors to conduct themselves in a mature, 
                                    responsible, and respectful manner. </p>
                    
                                    <h6  >HAIR & MAKE-UP</h6> 
                                    <p class="text">The Customer may provide their own Hair and Make-up staff. That staff will be provided an adequate space with outlets to carry out their role. This designated space will be at
                                    the discretion of The Bond unless prior arrangements have been and approved by The Bond.</p>
                    
                                    <h6>HANDICAP ACCOMMODTIONS:</h6>   <p>We provide level-designated parking, ramped walkways throughout the property along with suitable restroom facilities.  Motorized and transport 
                                    chairs can easily navigate the grounds.  All venues on the property are handicapped accessible. </p>
                    
                                    <h6  >MUSIC AND ENTERTAINMENT:</h6>   Although music (both live and recorded) is permitted, the music must be contained at an acceptable sound level so as not to disturb the local surrounding area.  The Bond 1786 event coordinator will help to establish acceptable sound levels.  Any complaints from neighbors or other parties may require the levels to be reduced further.  The Bond 1786 reserves the right to require Customer(s) to cease the music it deems inappropriate, in its sole discretion.  The Bond 1786 also reserves the right to require the Customer(s) to lower the sound level or cease playing music, in its sole discretion. 
                    
                                    <h6  >PARKING:</h6>   Parking is available at the designated areas on the East side of the complex (gravel and grass areas).  Persons shall pull into the cables that identify parking locations.  Handicap accessible parking spaces are provided at the posted areas adjacent to the sidewalks.  Parking is not permitted on the main street (Hudson Street) or any access drive to a venue building. Establishment parking space for Establishment’s guests takes priority. Parking for event guest is based on availability, but plenty of alternative parking spaces are available. The Establishment is not responsible for any damages, theft, or towing. Any special Parking space requirements must be approved by the Establishment Staff prior to your event, applicable parking charges may apply. 
                    
                                    <h6  >PETS:</h6>   Sorry, absolutely no pets allowed.  However, a family pet involved in an event will be considered. 
                    
                                    <h6  >PHOTOGRAPHY:</h6>   The many natural settings around The Bond 1786 were maintained and developed for the enjoyment of all events.  We reserve the right for each Customer the opportunity to use any area of the complex for wedding/reception photograph sessions.  All times for utilization of different areas at The Bond 1786 will be coordinated with the schedule for each venue’s Customer.  We also reserve the right to use any photographs or other media reproductions of an event in our publicity and advertising materials.  
                    
                                    <h6  >RENTAL SPACE CHANGES:</h6>   Any contents or furniture movement must be pre-approved by The Bond.  It is the Customer’s responsibility to restore all areas to their original appearance.  Placements of tables, tents, live music, catering equipment, etc., must also be approved by The Bond 1786planning staff. 
                    
                                    <h6  >SIGNAGE:</h6>   You may post your group’s sign or hang balloons at the front entrance on Hudson Street, but please do NOT attach anything to or cover up our entrance sign, or nail or screw anything to the trees. 
                    
                                    <h6  >SMOKING: </h6>  The Bond 1786is a non-smoking facility.  Ash-buckets will be provided, and smoking permitted in the designated areas only.   
                    
                                    <h6  >CATERING:</h6>   The catering service areas in each of the venues are not intended to be used as a kitchen for meal preparation.  
                    
                                    <h6  >WEATHER:</h6>    The weather is usually suitable for outside events from May 15 until October 15. Since most of our venues are booked-up for events in advance, please be advised that unless you reserve the Main Building or the Wedding Tent or one of the other venues at the time you schedule the main reception hall, we may not have any additional indoor facilities available to serve as a “weather back-up plan”.  Should there be inclement weather on your reserved day, we will approve your last-minute rental of tents, canopies, or heaters, provided they are set-up at an acceptable location. 
                    
                                    <h6  >WEDDING TENT / ARBOR:</h6>   The Gazebo and Arbors may be used as wedding sites and for pictures (Chairs required for a wedding ceremony are to be provided and set-up by The Bond 1786 based on the standard rental policy).  If the Venue has already been rented as a venue for a different group, then special permission must be granted to utilize the Tent for another party’s ceremony.   Pictures are permitted to be taken at the Gazebos and Arbor sites by all parties but shall be coordinated for use between all site venues. 
                    
                                    <h6  >WEDDING CEREMONIES:</h6> Wedding ceremonies may be held in the Reception Venue for no additional charge.  Additional fees may apply for reset of room from ceremony to reception.  Customer is responsible for providing ceremony coordinator, officiate, ceremony music and sound system. 
                    
                                    <h6  >WEDDING REHEARSAL:</h6>   In order to not conflict with other venue rentals, rehearsals are planned for Thursday evenings (unless a different date is approved).  The complex must be vacated after completing the rehearsal program.  The main event halls will not be available to decorate after the rehearsal. Alternative dates for Rehearsals may be held on-site.  These date and times are to be coordinated with and approved by The Event Coordinator at The Bond 1786. 
                    
                                    <h6  >LOGISTICAL PLANS:</h6>   The Bond 1786 planning team must review and approve all proposed logistical plans for the use of the premises a minimum of thirty (30) days prior to an event. 
                                    <h6  >EVENTS & WEDDING POLICY AND GUIDELINES AGREEMENT </h6>
                    
                                    I have read and understand the policies concerning events held at The Bond 1786.  I agree to uphold them and ensure that contractors and members of the event party, 
                                    will abide by the policies.  I understand it is my responsibility to inform the coordinator, florist, photographers, etc., that they must also conform to this set of guidelines. <br>
                    
                                    Please note that all prices are subject to 20% Service Charge and NYS 7.0% Sales Tax
                    
                                    <h6  >RESERVATION PROCESS</h6> 
                                    <p class="text">
                                    A rental contract must be signed, all pages initialed, as well as appropriate deposits submitted to confirm utilization of a The Bond 1786 Venue. <br><br>
                    
                                    A valid Credit Card is required to be on file for all events to guarantee payment of expenses in connection with this Agreement. Customer agrees 
                                    that any outstanding balance not received by the day of the event will be charged to the Credit Card on file. A Current Credit Card must be always communicated. 
                                    No Personal Checks are accepted for final payment. <br><br>
                                    The Rules and Conditions for Usage are incorporated herein and are made a part hereof. <br><br>
                    
                                    Please return signed contract with deposit no later than <b><?php echo e(\Carbon\Carbon::parse($lead->start_date)->format('d M, Y')); ?></b> or this contract is no longer valid.<br>
                                    </p>
                                
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6" >
                    <strong>Authorized Signature:</strong> <br>
                    <img src="<?php echo e($base64Image); ?>" style="width:30%; border-bottom:1px solid black;">
                </div>
                            <div class="col-md-6">
                                <strong> Signature:</strong>
                                <br>
                                <div id="sig" class="mt-3">
                                    <canvas id="signatureCanvas" width="200" height="200" required></canvas>
                                    <input type="hidden" name="imageData" id="imageData">
                                </div>
                                <button id="clearButton" class="btn btn-danger btn-sm mt-1">Clear Signature</button>
                            </div> 
                           
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3" > 
                                <button class="btn btn-success" style="float:right;margin-top:-40px">Submit</button>
                            </div> 
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
        <div id = "loader" style = "display:none">
            <img src = "<?php echo e(asset('assets/loader/loader.webp')); ?>"  >
        </div>
<style>
  
    #loader img {
            width: 120px;
    }
    #loader {
        display: block;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 35%;
        left: 40%;
        transform: translate(50px, 50px);
        z-index: 99999;
    }
    canvas#signatureCanvas {
        border: 1px solid black;
        width: 60%;
        height: 157px;
        border-radius: 8px;
    }
</style>
<?php echo $__env->make('partials.admin.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('partials.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
</script>
<script>
    $(document).ready(function () {
        $('#formdata').submit(function () {
            $("#loader").show(); 
        });
    });
</script><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/lead/proposal.blade.php ENDPATH**/ ?>