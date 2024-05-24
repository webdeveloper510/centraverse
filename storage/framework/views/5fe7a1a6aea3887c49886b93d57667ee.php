
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
                                                <?php if($eventdetails->setup_plans != ''): ?>
                                                <img src="<?php echo e(Storage::url('app/public/'.$eventdetails->setup_plans)); ?>"
                                                    style="    width: 70%;" alt="">

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
                    $billdetails=  App\Models\Billing::where('event_id',$eventdetails->id)->first();
                    $billing_data = unserialize($billdetails->data);    
                    $total = [];
                    $bar_pck = json_decode($eventdetails['bar_package'], true);
                ?>
            <div class="container-fluid xyz mt-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="useradd-1" class="card">
                            <div class="card-body table-border-style">
                                <h3 class="mt-3">Billing Summary -Estimate</h3>
                                <div class=" mt-4">
                                    <hr>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name : <?php echo e($eventdetails['name']); ?></th>
                                                <th colspan="2"></th>
                                                <th colspan="3">Bill created on :<?php echo date("d/m/Y"); ?> </th>
                                                <th>Event: <?php echo e($eventdetails['type']); ?></th>
                                            </tr>

                                        </thead>

                                        <tbody>
                                            <tr style="background-color:#063806;">
                                                <th
                                                    style="color:#ffffff; font-size:13px;text-align:left; padding:5px 5px; margin-left:5px;">
                                                    Description</th>
                                                <th colspan="2"
                                                    style="color:#ffffff; font-size:13px;padding:5px 5px; margin-left:5px;">
                                                </th>
                                                <th
                                                    style="color:#ffffff; font-size:13px;padding:5px 5px;margin-left: 5px;font-size:13px">
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
                                            <tr>
                                                <td>Venue Rental</td>
                                                <td colspan="2"></td>

                                                <td>$<?php echo e($billing_data['venue_rental']['cost']); ?></td>
                                                <td><?php echo e($billing_data['venue_rental']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] = $billing_data['venue_rental']['cost'] * $billing_data['venue_rental']['quantity']); ?>

                                                </td>
                                                <td><?php echo e($eventdetails['venue_selection']); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Brunch / Lunch / Dinner Package</td>
                                                <td colspan="2"></td>
                                                <td> $<?php echo e($billing_data['food_package']['cost']); ?></td>
                                                <td><?php echo e($billing_data['food_package']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] =$billing_data['food_package']['cost'] * $billing_data['food_package']['quantity']); ?>

                                                </td>
                                                <td><?php echo e($eventdetails['function']); ?></td>

                                            </tr>
                                            <tr>
                                                <td>Bar Package</td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e($billing_data['bar_package']['cost']); ?></td>
                                                <td><?php echo e($billing_data['bar_package']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] = $billing_data['bar_package']['cost']* $billing_data['bar_package']['quantity']); ?>

                                                </td>
                                                <td><?php echo e(implode(',',$bar_pck)); ?></td>
                                            </tr>
                                            <tr>
                                                <td>Hotel Rooms</td>
                                                <td colspan="2" style="padding:5px 5px; margin-left:5px;"></td>
                                                <td>$<?php echo e($billing_data['hotel_rooms']['cost']); ?></td>
                                                <td><?php echo e($billing_data['hotel_rooms']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] = $billing_data['hotel_rooms']['cost'] * $billing_data['hotel_rooms']['quantity']); ?>

                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Tent, Tables, Chairs, AV Equipment</td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e($billing_data['equipment']['cost']); ?></td>
                                                <td><?php echo e($billing_data['equipment']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] = $billing_data['equipment']['cost'] * $billing_data['equipment']['quantity']); ?>

                                                </td>
                                                <td></td>
                                            </tr>

                                            <?php if(!$billing_data['setup']['cost'] == ''): ?>
                                            <tr>
                                                <td>Welcome / Rehearsal / Special Setup</td>
                                                <td colspan="2" style="padding:5px 5px; margin-left:5px;font-size:13px">
                                                </td>
                                                <td>$<?php echo e($billing_data['setup']['cost']); ?></td>
                                                <td><?php echo e($billing_data['setup']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] =$billing_data['setup']['cost'] * $billing_data['setup']['quantity']); ?>

                                                </td>
                                                <td></td>
                                            </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <td>Special Requests / Others</td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e($billing_data['additional_items']['cost']); ?></td>
                                                <td><?php echo e($billing_data['additional_items']['quantity']); ?></td>
                                                <td>$<?php echo e($total[] =$billing_data['additional_items']['cost'] * $billing_data['additional_items']['quantity']); ?>

                                                </td>
                                                <td></td>

                                            </tr>
                                            <tr>
                                                <td>-</td>
                                                <td colspan="2"></td>
                                                <td colspan="3"></td>

                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Total</td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e(array_sum($total)); ?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Sales, Occupancy Tax</td>
                                                <td colspan="2"></td>
                                                <td colspan="2"> </td>
                                                <td>$<?php echo e(7* array_sum($total)/100); ?></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="text-align:left;text-align:left; padding:5px 5px; margin-left:5px;font-size:13px;">
                                                    Service Charges & Gratuity</td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e(20 * array_sum($total)/100); ?></td>

                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>-</td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td></td>

                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="background-color:#ffff00; padding:5px 5px; margin-left:5px;font-size:13px;">
                                                    Grand Total / Estimated Total</td>
                                                <td colspan="2"></td>
                                                <td colspan="2"></td>
                                                <td>$<?php echo e($grandtotal= array_sum($total) + 20* array_sum($total)/100 + 7* array_sum($total)/100); ?>

                                                </td>

                                                <td></td>
                                            </tr>
                                            <!-- <tr>
                                                <td
                                                    style="background-color:#d7e7d7; padding:5px 5px; margin-left:5px;font-size:13px;">
                                                    Deposits on file</td>
                                                <td colspan="2"></td>
                                                <td colspan="2"
                                                    style="background-color:#d7e7d7;padding:5px 5px; margin-left:5px;font-size:13px;">
                                                    $<?php echo e($deposit= $billdetails->deposits); ?></td>
                                                <td colspan="2"></td>
                                            </tr> -->
                                            <!-- <tr>
                                                <td
                                                    style="background-color:#ffff00;text-align:left; padding:5px 5px; margin-left:5px;font-size:13px;">
                                                    balance due</td>
                                                <td colspan="2"></td>
                                                <td colspan="3">$<?php echo e($grandtotal); ?></td>
                                                <td colspan="2"></td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>


        </div>
    </div>
</div>
<div class="container-fluid xyz mt-3">
    <div class="row">
        <div class="col-lg-6">
            <div class="card" >
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