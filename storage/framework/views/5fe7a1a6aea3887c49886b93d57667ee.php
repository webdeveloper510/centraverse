
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Lead Information')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<div class="page-header-title">
    <?php echo e(__('Lead Information')); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('lead.index')); ?>"><?php echo e(__('Leads')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Lead Details')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php  
$converted_to_event = App\Models\Meeting::where('attendees_lead',$lead->id)->exists();
?>

<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table datatable" id="datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?></th>
                                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Event Name')); ?></th>
                                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Phone')); ?></th>
                                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Email')); ?></th>
                                                <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Address')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Status')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Type')); ?></th>
                                                <th scope="col" class="sort"><?php echo e(__('Converted to event')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo e(ucfirst($lead->name)); ?></td>
                                                <td><?php echo e(ucfirst($lead->company_name ?? '--')); ?></td>
                                                <td><?php echo e($lead->phone); ?></td>
                                                <td><?php echo e($lead->email ?? '--'); ?></td>
                                                <td><?php echo e($lead->address ?? '--'); ?></td>
                                                <td><?php echo e(__(\App\Models\Lead::$stat[$lead->lead_status])); ?></td>
                                                <td><?php echo e($lead->type); ?></td>
                                                <?php if(App\Models\Meeting::where('attendees_lead',$lead->id)->exists()): ?>
                                                <td> <span
                                                        class="badge bg-success p-2 px-3 rounded"><?php echo e(__('Yes')); ?></span>
                                                </td>
                                                <?php else: ?>
                                                <td> <span
                                                        class="badge bg-danger p-2 px-3 rounded"><?php echo e(__('No')); ?></span>
                                                </td>
                                                <?php endif; ?>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid xyz mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <h3 class="mt-3">Lead Details ( <?php echo e(ucfirst($lead->name)); ?> )</h3>
                                <div class=" mt-4">
                                    <hr>
                                    <dl class="row">
                                        <dt class="col-md-6 need_half"><span
                                                class="h6  mb-0"><?php echo e(__('Guest Count')); ?></span></dt>
                                        <dd class="col-md-6 need_half"><span class=""><?php echo e($lead->guest_count); ?></span>
                                        </dd>
                                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Venue ')); ?></span>
                                        </dt>
                                        <dd class="col-md-6 need_half"><span
                                                class=""><?php echo e($lead->venue_selection ??'--'); ?></span>
                                        </dd>
                                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Function')); ?></span>
                                        </dt>
                                        <dd class="col-md-6 need_half"><span class=""><?php echo e($lead->function ?? '--'); ?></span>
                                        </dd>
                                        <dt class="col-md-6 need_half"><span
                                                class="h6  mb-0"><?php echo e(__('Assigned User')); ?></span></dt>
                                        <dd class="col-md-6 need_half"><span class=""><?php if($lead->assigned_user != 0): ?>
                                                <?php echo e(App\Models\User::where('id', $lead->assigned_user)->first()->name); ?>

                                                <?php else: ?>
                                                --
                                                <?php endif; ?></span>
                                        </dd>
                                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Bar')); ?></span></dt>
                                        <dd class="col-md-6 need_half"><span class=""><?php echo e($lead->bar ?? '--'); ?></span>
                                        </dd>
                                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Package')); ?></span>
                                        </dt>
                                        <dd class="col-md-6 need_half"><span class="">
                                                <?php $package = json_decode($lead->func_package,true);
                                                            if(isset($package) && !empty($package)){
                                                                foreach ($package as $key => $value) {
                                                                    echo implode(',',$value);
                                                                } 
                                                            }else{
                                                                echo '--';
                                                            }
                                                            ?>
                                            </span></dd>
                                        <dt class="col-md-6 need_half"><span
                                                class="h6  mb-0"><?php echo e(__('Additional Items')); ?></span>
                                        </dt>
                                        <dd class="col-md-6 need_half"><span class="">
                                                <?php $additional = json_decode($lead->ad_opts,true);
                                                            if(isset($additional) && !empty($additional)){
                                                                foreach ($additional as $key => $value) {
                                                                    echo implode(',',$value);
                                                                } 
                                                            }else{
                                                                echo "--";
                                                            }
                                                                
                                                            ?>
                                            </span></dd>
                                        <dt class="col-md-6 need_half"><span
                                                class="h6  mb-0"><?php echo e(__('Description')); ?></span></dt>
                                        <dd class="col-md-6 need_half"><span
                                                class=""><?php echo e($lead->description ??' --'); ?></span></dd>
                                        <dt class="col-md-6 need_half"><span
                                                class="h6  mb-0"><?php echo e(__('Any Special Requests')); ?></span>
                                        </dt>
                                        <dd class="col-md-6 need_half"><span class=""><?php echo e($lead->spcl_req ?? '--'); ?></span>
                                        </dd>
                                        <dt class="col-md-6 need_half"><span
                                                class="h6  mb-0"><?php echo e(__('Proposal Response')); ?></span>
                                        </dt>
                                        <dd class="col-md-6 need_half"><span
                                                class=""><?php if(App\Models\Proposal::where('lead_id',$lead->id)->exists()): ?>
                                                <?php  $proposal = App\Models\Proposal::where('lead_id',$lead->id)->first()->notes; ?>

                                                <?php echo e($proposal); ?>

                                                <?php else: ?> --
                                                <?php endif; ?></span></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($converted_to_event): ?>
            <?php $eventdetails = App\Models\Meeting::where('attendees_lead',$lead->id)->first();?>
            <?php if($eventdetails): ?>
            <?php $existingbill = App\Models\Billing::where('event_id',$eventdetails->id)->exists();  ?>
            <div class="container-fluid xyz mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class=" mt-4">
                                    <dl class="row">
                                        <dt class="col-md-4 need_half"><span
                                                class="h6  mb-0"><?php echo e(__('Meal Preference')); ?></span></dt>
                                        <dd class="col-md-8 need_half"><span
                                                class=""><?php echo e($eventdetails->meal ?? '--'); ?></span></dd>

                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class=" mt-4">
                                    <dl class="row">
                                        <dt class="col-md-4 need_half"><span
                                                class="h6  mb-0"><?php echo e(__('Food Description')); ?></span></dt>
                                        <dd class="col-md-8 need_half"><span
                                                class=""><?php echo e($eventdetails->food_description ?? '--'); ?></span></dd>
                                    </dl>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class=" mt-4">
                                    <dl class="row">
                                        <dt class="col-md-4 need_half"><span
                                                class="h6  mb-0"><?php echo e(__('Bar Description ')); ?></span></dt>
                                        <dd class="col-md-8 need_half"><span
                                                class=""><?php echo e($eventdetails->bar_description ??'--'); ?></span>
                                        </dd>
                                    </dl>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body table-border-style">
                                <div class=" mt-4">
                                    <dl class="row">

                                        <dt class="col-md-4 need_half"><span class="h6  mb-3"><?php echo e(__('Set-up')); ?></span>
                                        </dt>
                                        <dd class="col-md-8 need_half"><span class="">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <th>Setups</th>
                                                    <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php $setups = App\Models\Setuplans::where('event_id',$eventdetails->id)->exists(); ?>

                                                        <?php if($setups): ?>
                                                        <?php $setupplanss = App\Models\Setuplans::where('event_id',$eventdetails->id)->get(); ?>

                                                        <?php $__currentLoopData = $setupplanss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $setup_plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php $setupname = explode('/', $setup_plan->setup_docs); ?>
                                                        <tr>
                                                            <td>Setup Plan <?php echo e($key + 1); ?></td>
                                                            <td>
                                                                <a href="<?php echo e(Storage::url('app/public/'.$setup_plan->setup_docs)); ?>"
                                                                    download
                                                                    style=" position: absolute;color: #1551c9 !important">
                                                                    View Document</a>
                                                            </td>
                                                            <td>
                                                                <!-- <button type="button" class="btn btn-danger remove-setup"
data-setup-id="<?php echo e($setup_plan->id); ?>">&times;</button> -->

                                                            </td>
                                                        </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>




                                            </span>

                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($existingbill): ?>
            <?php  
                                        $billdetails=  App\Models\Billing::where('event_id',$eventdetails->id)->first();
                                        $billing_data = unserialize($billdetails->data);    
                                        $total = [];
                                        $bar_pck = json_decode($eventdetails['bar_package'], true);
                                        if(App\Models\PaymentLogs::where('event_id',$eventdetails->id)->exists()){
                                            $payments = App\Models\PaymentLogs::where('event_id',$eventdetails->id)->orderBy('id','desc')->get();
                                            $payinfos = App\Models\PaymentInfo::where('event_id',$eventdetails->id)->get();
                                        }
                                        $beforedeposit = App\Models\Billing::where('event_id',$eventdetails->id)->first();
                                    ?>
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card shadow-sm">
                            <div class="card-body table-border-style">
                                <h3 class="mt-3 text-center">Billing Summary - Estimate</h3>
                                <div class="mt-4">
                                    <hr>
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Name: <?php echo e($eventdetails['name']); ?></th>
                                                <th colspan="2"></th>
                                                <th colspan="3">Bill created on: <?php echo date("d/m/Y"); ?></th>
                                                <th>Event: <?php echo e($eventdetails['type']); ?></th>
                                            </tr>
                                            <tr>
                                                <th>Description</th>
                                                <th colspan="2">&nbsp;</th>
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
                                                <td>$<?php echo e($billing_data['venue_rental']['cost']); ?></td>
                                                <td><?php echo e($billing_data['venue_rental']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] = $billing_data['venue_rental']['cost'] * $billing_data['venue_rental']['quantity']); ?>

                                                </td>
                                                <td><?php echo e($billing_data['venue_rental']['notes']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Brunch / Lunch / Dinner Package</td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e($billing_data['food_package']['cost']); ?></td>
                                                <td><?php echo e($billing_data['food_package']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] = $billing_data['food_package']['cost'] * $billing_data['food_package']['quantity']); ?>

                                                </td>
                                                <td><?php echo e($billing_data['food_package']['notes']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Bar Package</td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e($billing_data['bar_package']['cost']); ?></td>
                                                <td><?php echo e($billing_data['bar_package']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] = $billing_data['bar_package']['cost'] * $billing_data['bar_package']['quantity']); ?>

                                                </td>
                                                <td><?php echo e($billing_data['bar_package']['notes']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Hotel Rooms</td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e($billing_data['hotel_rooms']['cost']); ?></td>
                                                <td><?php echo e($billing_data['hotel_rooms']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] = $billing_data['hotel_rooms']['cost'] * $billing_data['hotel_rooms']['quantity']); ?>

                                                </td>
                                                <td><?php echo e($billing_data['hotel_rooms']['notes']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tent, Tables, Chairs, AV Equipment</td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e($billing_data['equipment']['cost']); ?></td>
                                                <td><?php echo e($billing_data['equipment']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] = $billing_data['equipment']['cost'] * $billing_data['equipment']['quantity']); ?>

                                                </td>
                                                <td><?php echo e($billing_data['equipment']['notes']); ?></td>
                                            </tr>
                                            <?php if(!$billing_data['setup']['cost'] == ''): ?>
                                            <tr>
                                                <td>Welcome / Rehearsal / Special Setup</td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e($billing_data['setup']['cost']); ?></td>
                                                <td><?php echo e($billing_data['setup']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] = $billing_data['setup']['cost'] * $billing_data['setup']['quantity']); ?>

                                                </td>
                                                <td><?php echo e($billing_data['setup']['notes']); ?></td>
                                            </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td>Special Requests / Others</td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e($billing_data['special_req']['cost']); ?></td>
                                                <td><?php echo e($billing_data['special_req']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] = $billing_data['special_req']['cost'] * $billing_data['special_req']['quantity']); ?>

                                                </td>
                                                <td><?php echo e($billing_data['special_req']['notes']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Additional Items</td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e($billing_data['additional_items']['cost']); ?></td>
                                                <td><?php echo e($billing_data['additional_items']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] = $billing_data['additional_items']['cost'] * $billing_data['additional_items']['quantity']); ?>

                                                </td>
                                                <td><?php echo e($billing_data['additional_items']['notes']); ?></td>
                                            </tr>
                                            <tr>
                                                <td>-</td>
                                                <td colspan="2"></td>
                                                <td colspan="3"></td>
                                                <td></td>
                                            </tr>
                                            <tr class="table-primary">
                                                <td>Total</td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e(array_sum($total)); ?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Sales, Occupancy Tax</td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e(7 * array_sum($total) / 100); ?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Service Charges & Gratuity</td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e(20 * array_sum($total) / 100); ?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>-</td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr class="table-success">
                                                <td>Grand Total / Estimated Total</td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e($grandtotal = array_sum($total) + 20 * array_sum($total) / 100 + 7 * array_sum($total) / 100); ?>

                                                </td>
                                                <td></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(isset($payments) && !empty($payments)): ?>
            <?php 
                                            $latefee = 0;
                                            $adj = 0;
                                            $collect_amount = 0;
                                            foreach($payinfos as $k=>$val){
                                                $latefee += $val->latefee;
                                                $adj += $val->adjustments;
                                                $collect_amount += $val->collect_amount;
                                            }

                                ?>
            <div class="col-lg-12">
                <div class="card" id="useradd-1">
                    <div class="card-body table-border-style">
                        <h3 class="mt-3 text-center">Transaction Summary</h3>

                        <div class="table-responsive overflow_hidden">
                            <table id="datatable" class="table datatable align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name"><?php echo e(__('Created On')); ?></th>
                                        <th scope="col" class="sort" data-sort="status"><?php echo e(__('Name')); ?></th>
                                        <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Transaction Id')); ?>

                                        </th>
                                        <th><?php echo e(__('Invoice')); ?></th>
                                        <!-- <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Mode of Payment')); ?></th> -->
                                        <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Event Amount')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Amount Collected')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="completion"><?php echo e(__('Amount Due')); ?></th>


                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $payment->created_at)->format('M d, Y')); ?>

                                        </td>
                                        <td><?php echo e($payment->name_of_card); ?></td>
                                        <td><?php echo e($payment->transaction_id ?? '--'); ?></td>
                                        <td><a href="<?php echo e(Storage::url('app/public/Invoice/'.$payment->event_id.'/'.$payment->invoices)); ?>"
                                                download
                                                style="    color: #1551c9 !important;"><?php echo e(ucfirst($payment->invoices )); ?></a>
                                        </td>
                                        <!-- <td></td> -->
                                        <td>$<?php echo e($eventdetails->total); ?></td>
                                        <td>$<?php echo e($payment->amount); ?></td>
                                        <td><?php echo e('$'. ($payinfos[0]->deposits - $latefee + $adj + $collect_amount)); ?>

                                        </td>
                                    </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <hr>
                                    <tr style="    background: aliceblue;">
                                        <td></td>
                                        <!-- <td></td>
                                                                    <td></td><td></td><td></td> -->
                                        <td colspan='3'><b>Deposits on File:</b></td>
                                        <td colspan='3'>
                                            <?php echo e(($beforedeposit->deposits != 0)? '$'.$beforedeposit->deposits : '--'); ?>

                                        </td>
                                    </tr>
                                    <tr style="    background: darkgray;">
                                        <td></td>
                                        <!-- <td></td>
                                                                    <td></td><td></td><td></td> -->
                                        <td colspan='3'><b>Adjustments:</b></td>
                                        <td colspan='3'><?php echo e(($adj != 0)? '$'.$adj : '--'); ?></td>
                                    </tr>
                                    <tr style=" background: #c0e3c0;">
                                        <td></td>
                                        <td colspan='3'><b>Latefee:</b></td>
                                        <!-- <td></td>
                                                                    <td></td> -->
                                        <td colspan='3'><?php echo e(($latefee != 0) ? '$'. $latefee :'--'); ?></td>
                                        <!-- <td></td>
                                                                    <td></td> -->
                                    </tr>
                                    <tr style="    background: floralwhite;">
                                        <td></td>
                                        <!-- <td></td>
                                                                    <td></td><td></td><td></td> -->
                                        <td colspan='3'><b>Total Amount Recieved:</b></td>
                                        <td colspan='3'>
                                            <?php echo e(((isset($beforedeposit->deposits)? $beforedeposit->deposits : 0) + $collect_amount<=0) ?'--': '$'.((isset($beforedeposit->deposits)? $beforedeposit->deposits : 0)+ $collect_amount)); ?>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="container-fluid xyz mt-3">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body table-border-style">
                    <h3>Upload Documents</h3>
                    <?php echo e(Form::open(array('route' => ['lead.uploaddoc', $lead->id],'method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))); ?>

                    <label for="customerattachment">Attachment</label>
                    <input type="file" name="customerattachment" id="customerattachment" class="form-control" required>
                    <input type="submit" value="Submit" class="btn btn-primary mt-4" style="float: right;">
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body table-border-style">
                    <h3>Attachments</h3>
                    <div class="table-responsive ">
                        <table class="table table-bordered">
                            <thead>
                                <th>Attachment</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <!-- -------- check the xtension and if image use img tag otherwise
                                                         shoe the preview of doc uploaded-->
                                <?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(Storage::disk('public')->exists($doc->filepath)): ?>
                                <tr>
                                    <td><?php echo e($doc->filename); ?></td>
                                    <td><a href="<?php echo e(Storage::url('app/public/'.$doc->filepath)); ?>" download
                                            style="color: teal;" title="Download">View Document <i
                                                class="fa fa-download"></i></a>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<script>
$(document).ready(function() {
    $('#addnotes').on('submit', function(e) {
        e.preventDefault();
        var id = <?php echo  $lead->id; ?>;
        var notes = $('input[name="notes"]').val();
        var createrid = <?php echo Auth::user()->id ;?>;

        $.ajax({
            url: "<?php echo e(route('addleadnotes', ['id' => $lead->id])); ?>", // URL based on the route with the actual user ID
            type: 'POST',
            data: {
                "notes": notes,
                "createrid": createrid,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function(data) {
                location.reload();
            }
        });

    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/lead/leadinfo.blade.php ENDPATH**/ ?>