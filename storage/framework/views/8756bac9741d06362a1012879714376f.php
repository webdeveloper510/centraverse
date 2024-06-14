
<?php $__env->startSection('page-title'); ?>
<?php echo e(__('Invoice')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
<?php echo e(__('Invoice')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
<li class="breadcrumb-item"><?php echo e(__('Invoice')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="container-field">
    <div id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" id="useradd-1">
                            <div class="card-body table-border-style">
                                <div class="table-responsive overflow_hidden">
                                    <table id="datatable" class="table datatable align-items-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name"><?php echo e(__('Name')); ?> <span
                                                        class="opticy"> dddd</span></th>
                                                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Event')); ?> <span
                                                        class="opticy"> dddd</span></th>
                                                <th scope="col" class="sort" data-sort="completion">
                                                    <?php echo e(__('Event Date')); ?> <span class="opticy"> </span></th>
                                                <th scope="col" class="sort" data-sort="completion">
                                                    <?php echo e(__('Payment Status')); ?> <span class="opticy"> </span></th>
                                                <th scope="col" class="sort" data-sort="completion">
                                                    <?php echo e(__('Billing Amount')); ?><span class="opticy"> </span></th>
                                                <th scope="col" class="sort" data-sort="completion">
                                                    <?php echo e(__('Adjustments')); ?><span class="opticy"> </span></th>
                                                <th scope="col" class="sort" data-sort="completion">
                                                    <?php echo e(__('Latefee')); ?><span class="opticy"> </span></th>
                                                <th scope="col" class="sort" data-sort="completion">
                                                    <?php echo e(__('Paid Amount')); ?> <span class="opticy"> </span></th>
                                                    <th scope="col" class="sort" data-sort="completion">
                                                    <?php echo e(__('Amount Due')); ?> <span class="opticy"> </span></th>
                                                <th scope="col" class="text-end"><?php echo e(__('Action')); ?><span class="opticy">
                                                    </span> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php   
                                                $latefee = 0;
                                                $adjustments = 0;
                                                $total = 0;
                                                $amountpaid = 0;

                                            ?>
                                            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php if(\App\Models\PaymentInfo::where('event_id',$event->id)->exists()): ?>
                                            <?php  
                                                $info = App\Models\PaymentInfo::where('event_id',$event->id)->get();
                                                foreach($info as $inf){
                                                $latefee += $inf->latefee;
                                                $adjustments += $inf->adjustments;
                                                }
                                            ?>
                                            <?php endif; ?>
                                            <?php if(\App\Models\PaymentLogs::where('event_id',$event->id)->exists()): ?>
                                            <?php 
                                                        $pay = App\Models\PaymentLogs::where('event_id',$event->id)->get();
                                                        foreach($pay as $p){
                                                        $total += $p->amount;
                                                        }
                                                    ?>
                                            <?php endif; ?>
                                            <tr>
                                                <td>
                                                <?php if(isset($event) && $event->attendees_lead != 0): ?>
                                                        <?php $leaddata = \App\Models\Lead::where('id',$event->attendees_lead)->first();  ?>
                                                        <?php if(isset($leaddata) && !empty($leaddata)): ?>
                                                        <a href="<?php echo e(route('lead.info',urlencode(encrypt($leaddata->id)))); ?>" data-size="md"
                                                        data-title="<?php echo e(__('Event Details')); ?>"
                                                        class="action-item text-primary"
                                                        style=" color: #1551c9 !important;">
                                                        <?php echo e(ucfirst($leaddata->leadname)); ?>

                                                        </a>
                                                        <?php endif; ?>
                                                        <?php else: ?>

                                                           <a href="<?php echo e(route('meeting.detailview',urlencode(encrypt($event->id)))); ?>"
                                                            data-size="md" title="<?php echo e(__('Detailed view ')); ?>"
                                                            class="action-item text-primary"  style=" color: #1551c9 !important;">
                                                            <?php echo e(ucfirst($event->eventname)); ?></a>
                                                       
                                                        <?php endif; ?>
                                                   
                                                </td>
                                                <td>
                                                    <span class="budget"><?php echo e(ucfirst($event->type)); ?></span>
                                                </td>
                                                <td>
                                                    <?php if($event->start_date == $event->end_date): ?>
                                                    <span
                                                        class="budget"><?php echo e(\Auth::user()->dateFormat($event->start_date)); ?></span>
                                                    <?php elseif($event->start_date != $event->end_date): ?>
                                                    <span
                                                        class="budget"><?php echo e(Carbon\Carbon::parse($event->start_date)->format('M d')); ?>

                                                        - <?php echo e(\Auth::user()->dateFormat($event->end_date)); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if(\App\Models\Billing::where('event_id',$event->id)->exists()): ?>
                                                    <?php 
                                                        $deposit = App\Models\Billing::where('event_id',$event->id)->first();
                                                        $bill = \App\Models\Billing::where('event_id', $event->id)->pluck('status')->first();
                                                     ?>
                                                    <?php if($bill == 1): ?>
                                                    <span
                                                        class=" text-info"><?php echo e(__(\App\Models\Billing::$status[$bill])); ?></span>
                                                    <?php elseif($bill == 2): ?>
                                                    <span
                                                        class=" text-warning "><?php echo e(__(\App\Models\Billing::$status[$bill])); ?></span>
                                                    <?php else: ?>
                                                    <span
                                                        class=" text-success"><?php echo e(__(\App\Models\Billing::$status[$bill])); ?></span>
                                                    <?php endif; ?>
                                                    <?php else: ?>
                                                    <span
                                                        class=" text-danger "><?php echo e(__(\App\Models\Billing::$status[0])); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e(($event->total != 0)? '$'. number_format($event->total):'--'); ?>

                                                </td>
                                                <td><?php echo e(isset($adjustments)?'$'.$adjustments :'--'); ?> </td>
                                                <td><?php echo e(isset($latefee)?'$'. $latefee :'--'); ?> </td>
                                                <td> <?php echo e(((isset($deposit) ? $deposit->deposits : 0) + ($total != 0 ? $total : 0) == 0) 
                                                        ? '--' 
                                                        : '$' . ((isset($deposit) ? $deposit->deposits : 0) + ($total != 0 ? $total : 0))); ?>

                                                </td>
                                                <td><?php echo e(($event->total - ($total + (isset($deposit) ? $deposit->deposits : 0) - $latefee + $adjustments) == 0)
                                                        ? '--' 
                                                        : '$'.$event->total - ($total + (isset($deposit) ? $deposit->deposits : 0) - $latefee + $adjustments)); ?>

                                                <td class="text-end">
                                                    <?php if(!(\App\Models\Billing::where('event_id',$event->id)->exists())): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Payment')): ?>
                                                    <div class="action-btn bg-primary ms-2">
                                                        <a href="#" data-size="md"
                                                            data-url="<?php echo e(route('billing.create',['billing',$event->id])); ?>"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                                                            data-ajax-popup="true"
                                                            data-title="<?php echo e(__('Invoice Details')); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                            <i class="ti ti-plus"></i>
                                                        </a>
                                                    </div>
                                                    <?php endif; ?>
                                                   
                                                    <?php else: ?>
                                                    
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payment')): ?>
                                                    <?php 
                                                                $paymentLog = App\Models\PaymentLogs::where('event_id', $event->id)->exists();
                                                                if($paymentLog){
                                                                    $pay = App\Models\PaymentLogs::where('event_id',$event->id)->get();

                                                                    foreach($pay as $p){
                                                                        $amountpaid += $p->amount;
                                                                    }

                                                                }
                                                               $deposit = App\Models\Billing::where('event_id',$event->id)->first();
                                                                
                                                            ?>
                                                    <?php if(($amountpaid + $deposit->deposits + $adjustments - $latefee) < $event->total ): ?>
                                                        <div class="action-btn bg-primary ms-2">
                                                            <a href="#" data-size="md"
                                                                data-url="<?php echo e(route('billing.paylink',$event->id)); ?>"
                                                                data-bs-toggle="tooltip"
                                                                title="<?php echo e(__('Share Payment Link')); ?>"
                                                                data-ajax-popup="true"
                                                                data-title="<?php echo e(__('Payment Link')); ?>"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                                <i class="ti ti-share"></i>
                                                            </a>
                                                        </div>

                                                    <?php endif; ?>
                                                        <?php if(!$paymentLog): ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Payment')): ?>
                                                                <div class="action-btn bg-info ms-2">
                                                                    <a href="#" data-size="md"
                                                                        data-url="<?php echo e(route('billing.update',urlencode(encrypt($event->id)))); ?>"
                                                                        data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>"
                                                                        data-ajax-popup="true"
                                                                        data-title="<?php echo e(__('Edit Invoice ')); ?>"
                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                                        <i class="ti ti-edit"></i>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="#" data-size="md"
                                                                data-url="<?php echo e(route('billing.paymentinfo',urlencode(encrypt($event->id)))); ?>"
                                                                data-bs-toggle="tooltip" title="<?php echo e(__('Payment')); ?>"
                                                                data-ajax-popup="true"
                                                                data-title="<?php echo e(__('Payment Information')); ?>"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                                <i class=" fa fa-credit-card "></i>
                                                            </a>
                                                        </div>


                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="#" data-size="md"
                                                                data-url="<?php echo e(route('billing.show',$event->id)); ?>"
                                                                data-bs-toggle="tooltip" title="<?php echo e(__('Quick View')); ?>"
                                                                data-ajax-popup="true"
                                                                data-title="<?php echo e(__('Invoice Details')); ?>"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                                                <i class="ti ti-eye"></i>
                                                            </a>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Payment')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' =>
                                                            ['billing.destroy', $event->id]]); ?>


                                                            <a href="#!"
                                                                class="mx-3 btn btn-sm  align-items-center text-white show_confirm"
                                                                data-bs-toggle="tooltip" title='Delete'>
                                                                <i class="ti ti-trash"></i>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php
// Reset the variables for the next iteration (if this code is inside a loop)
$total = 0;
$latefee = 0;
$adjustments = 0;
?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/billing/index.blade.php ENDPATH**/ ?>