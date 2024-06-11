<?php 
if(isset($event->func_package) && !empty($event->func_package)){
    $package = json_decode($event->func_package,true);
}
if(isset($event->ad_opts) && !empty($event->ad_opts)){
    $additional = json_decode($event->ad_opts,true);
}
if(isset($event->bar_package) && !empty($event->bar_package)){
    $bar = json_decode($event->bar_package,true);
}
if(App\Models\PaymentLogs::where('event_id',$event->id)->exists()){
    $payments = App\Models\PaymentLogs::where('event_id',$event->id)->orderBy('id','desc')->get();
    $payinfos = App\Models\PaymentInfo::where('event_id',$event->id)->get();
}
if(App\Models\Billing::where('event_id',$event->id)->exists()){
    $deposit = App\Models\Billing::where('event_id',$event->id)->first();
}
$files = Storage::files('app/public/Event/'.$event->id);
?>

<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Event Information')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Event Information')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Event Information')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <dl class="row ">
                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Event')); ?></span></dt>
                        <?php if($event->attendees_lead != 0): ?>
                        <dd class="col-md-6 need_half"><span
                                class=""><?php echo e(!empty($event->attendees_leads->leadname)?$event->attendees_leads->leadname:'--'); ?></span>
                        </dd>
                        <?php else: ?>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e($event->eventname); ?></span></dd>
                        <?php endif; ?>
                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Event Type')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e($event->type); ?></span></dd>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Date')); ?></span></dt>
                        <?php if($event->start_date == $event->end_date): ?>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e(\Auth::user()->dateFormat($event->start_date)); ?></span>
                        </dd>
                        <?php else: ?>
                        <dd class="col-md-6 need_half "><span class=""><?php echo e(\Auth::user()->dateFormat($event->start_date)); ?> -
                                <?php echo e(\Auth::user()->dateFormat($event->end_date)); ?></span></dd>
                        <?php endif; ?>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Time')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e(date('h:i A', strtotime($event->start_time))); ?> -
                                <?php echo e(date('h:i A', strtotime($event->end_time))); ?></span></dd>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Guest Count')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e($event->guest_count); ?></span></dd>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Venue')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php echo e($event->venue_selection); ?></span></dd>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Room')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php if($event->room != 0): ?><?php echo e($event->room); ?><?php else: ?> -- <?php endif; ?></span>
                        </dd>
                        <?php if(isset($package) && !empty($package)): ?>
                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Package')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php $__currentLoopData = $package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e(implode(',',$value)); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </span>
                        </dd>
                        <?php endif; ?>

                        <?php if(isset($additional) && !empty($additional)): ?>
                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Additional Items')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php $__currentLoopData = $additional; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e(implode(',',$value)); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </span>
                        </dd>
                        <?php endif; ?>
                        <?php if(isset($bar) && !empty($bar)): ?>
                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Bar Package')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class="">
                                <?php echo e(implode(',',$bar)); ?>

                            </span>
                        </dd>
                        <?php endif; ?>

                        <dt class="col-md-6 need_half"><span class="h6  mb-0"><?php echo e(__('Billing Amount')); ?></span></dt>
                        <dd class="col-md-6 need_half"><span class=""><?php if($event->total != 0): ?>$<?php echo e($event->total); ?><?php else: ?> Billing Not
                                Created <?php endif; ?></span>
</dd>
                            <hr class="mt-5">
                            <?php if(!empty($event->floor_plan)): ?>
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <h3><?php echo e(__('Setup')); ?></h3>
                                </div>
                            </div>
                            <hr>
                            <img src="<?php echo e($event->floor_plan); ?>" alt="" style="width: 40% ;" class="need_full">
                            <?php endif; ?>
                    </dl>
                    <?php $existingbill = App\Models\Billing::where('event_id',$event->id)->exists();  ?>
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
                                                        class=""><?php echo e($event->meal ?? '--'); ?></span></dd>

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
                                                        class=""><?php echo e($event->food_description ?? '--'); ?></span></dd>
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
                                                        class=""><?php echo e($event->bar_description ??'--'); ?></span>
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
                                                <?php $setups = App\Models\Setuplans::where('event_id',$event->id)->exists(); ?>

<?php if($setups): ?>
<?php $setupplanss = App\Models\Setuplans::where('event_id',$event->id)->get(); ?>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <th>Setups</th>
                                                    <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                      

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
                                                      
                                                    </tbody>
                                                </table>
                                                <?php else: ?>
                                                --
                                                <?php endif; ?>

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
                                        $billdetails=  App\Models\Billing::where('event_id',$event->id)->first();
                                        $billing_data = unserialize($billdetails->data);    
                                        $total = [];
                                        $bar_pck = json_decode($event['bar_package'], true);
                                        if(App\Models\PaymentLogs::where('event_id',$event->id)->exists()){
                                            $payments = App\Models\PaymentLogs::where('event_id',$event->id)->orderBy('id','desc')->get();
                                            $payinfos = App\Models\PaymentInfo::where('event_id',$event->id)->get();
                                        }
                                        $beforedeposit = App\Models\Billing::where('event_id',$event->id)->first();
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
                                                                <th>Name: <?php echo e($event['name']); ?></th>
                                                                <th colspan="2"></th>
                                                                <th colspan="3">Bill created on: <?php echo date("d/m/Y"); ?></th>
                                                                <th>Event: <?php echo e($event['type']); ?></th>
                                                            </tr>
                                                            <tr style="background-color:#063806;">
                                                                <th style="color:#ffffff; text-align:left;">Description</th>
                                                                <th colspan="2" style="color:#ffffff;">&nbsp;</th>
                                                                <th style="color:#ffffff; text-align:right;">Cost</th>
                                                                <th style="color:#ffffff; text-align:right;">Quantity</th>
                                                                <th style="color:#ffffff; text-align:right;">Total Price</th>
                                                                <th style="color:#ffffff;">Notes</th>
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
                                                            <td>$<?php echo e($event->total); ?></td>
                                                            <td>$<?php echo e($payment->amount); ?></td>
                                                            <td><?php echo e(($event->total - ($payinfos[0]->deposits + $collect_amount))<= 0 ? '--':'$'.$event->total - ($payinfos[0]->deposits - $latefee + $adj + $collect_amount)); ?>

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
                                                        <tr style="background: darkgray;">
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
                    
                    <div class="col-lg-12">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <?php if(isset($files) && !empty($files)): ?>
                                <h3>Attachments</h3>
                                <hr>
                                <div class="col-md-12" style="display:flex;">
                                    <table class="table table-bordered">
                                        <thead>
                                            <th>Attachment</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(basename($file)); ?></td>
                                                <td>
                                                    <a href="<?php echo e(Storage::url($file)); ?>" download
                                                        style=" position: absolute;color: #1551c9 !important">
                                                        View Document</a>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/meeting/detailed_view.blade.php ENDPATH**/ ?>