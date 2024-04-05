<div class="row">
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <!-- <th scope="col">Email</th> -->
                    <th scope="col">Status</th>
                    <th scope="col">Lead Type</th>
                    <th scope="col">Converted events</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($lead->name); ?></td>
                    <td><?php echo e($lead->phone); ?></td>
                    <td><?php echo e($lead->type); ?></td>
                    <?php if(App\Models\Meeting::where('attendees_lead',$lead->id)->exists()): ?>
                    <td> Yes </td>
                    <?php else: ?>
                    <td> No </td>
                    <?php endif; ?>
                    <td>
                        <div class="action-btn bg-info ms-2" style="float: right;">
                            <a href="#" data-size="md" data-url="<?php echo e(route('lead.uploads',$lead->id)); ?>"
                                data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('Upload Document')); ?>"
                                title="<?php echo e(__('Upload Document')); ?>"
                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                <i class="ti ti-upload"></i>
                            </a>
                        </div>
                        <?php if(App\Models\LeadDoc::where('lead_id',$lead->id)->exists()): ?>
                        <div class="action-btn bg-warning ms-2" style="float: right;">
                            <a href="#" data-size="md" data-url="<?php echo e(route('lead.uploaded_docs',$lead->id)); ?>"
                                data-ajax-popup="true" data-bs-toggle="tooltip" data-title="<?php echo e(__('View Document')); ?>"
                                title="<?php echo e(__(' View Documents')); ?>"
                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                <i class="ti ti-eye"></i>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if(!App\Models\Meeting::where('attendees_lead',$lead->id)->exists() && $lead->status == 2): ?>
                        <div class="action-btn bg-secondary ms-2" style="    float: right;">
                            <a href="<?php echo e(route('meeting.create',['meeting',0])); ?>?lead=<?php echo e(urlencode(encrypt($lead->id))); ?>" data-size="md" data-url="#" data-id = "<?php echo e($lead->id); ?>"
                                data-bs-toggle="tooltip" data-title="<?php echo e(__('Convert')); ?>"
                                title="<?php echo e(__('Convert To Event')); ?>"
                                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white ">
                                <i class="fas fa-plus"></i> </a>
                        </div>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-3">
        <h5 style="margin-left: 14px;"><?php echo e(__('Customer Information')); ?></h5>
    </div>
    <div class="col-md-12">
        <h5><?php echo e($lead->name); ?></h5>
        <div style="float:right" class="mb-3">
        <b>Phone :</b> <?php echo e($lead->phone); ?><br>
<b>Address :</b> <?php echo e($lead->lead_address); ?>

    </div>
        
    </div>
<hr>
    <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-3">
        <h5 style="margin-left: 14px;"><?php echo e(__('Billing Details')); ?></h5>
    </div>
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Created On</th>
                    <th scope="col">Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Due</th>
                    <!-- <th scope="col">Converted events</th> -->
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                $event= App\Models\Meeting::where('attendees_lead',$lead->id)->first();
                
                    if($event)
                    {
                        $billing = App\Models\PaymentLogs::where('event_id',$event->id)->get();
                        
                            $lastpaid = App\Models\PaymentLogs::where('event_id',$event->id)->orderby('id','DESC')->first();
                        
                            if(isset($lastpaid) && !empty($lastpaid)){
                            $amount = App\Models\PaymentInfo::where('event_id',$event->id)->first();
                            $amountpaid = 0;
                            foreach($billing as $pay){
                                $amountpaid += $pay->amount;
                            }
                            echo "<tr>";
                            echo "<td>".Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lastpaid->created_at)->format('M d, Y')."</td>";
                            echo "<td>".$lead->name."</td>";
                            echo "<td>".$amount->amount."</td>";
                            echo "<td>".$amount->amounttobepaid - $amountpaid."</td>";
                            echo "</tr>";
                        }
                    }
                ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<style>
.modal-dialog.modal-md {
    max-width: 850px;
}
</style><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/lead/leadinfo.blade.php ENDPATH**/ ?>