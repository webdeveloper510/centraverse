<?php
$startdate = \Carbon\Carbon::createFromFormat('Y-m-d', $lead->start_date)->format('d/m/Y');
$enddate = \Carbon\Carbon::createFromFormat('Y-m-d', $lead->end_date)->format('d/m/Y');
?>
<div class="row">
    <div class="col-md-12">
        <dl class="row">
            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Lead')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php echo e($lead->leadname); ?></span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Email')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php echo e($lead->email); ?></span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Phone')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php echo e($lead->phone); ?></span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Address')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php echo e($lead->lead_address ?? '--'); ?></span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Event Date')); ?></span></dt>
            <dd class="col-md-6"><span class="">
                    <?php if($lead->start_date == $lead->end_date): ?>
                    <?php echo e(\Auth::user()->dateFormat($lead->start_date)); ?>

                    <?php else: ?>
                    <?php echo e(\Auth::user()->dateFormat($lead->start_date)); ?> -
                    <?php echo e(\Auth::user()->dateFormat($lead->end_date)); ?>

                    <?php endif; ?>
                </span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Time')); ?></span></dt>
            <dd class="col-md-6"><span class="">
                    <?php if($lead->start_time == $lead->end_time): ?>
                    --
                    <?php else: ?>
                    <?php echo e(date('h:i A', strtotime($lead->start_time))); ?> - <?php echo e(date('h:i A', strtotime($lead->end_time))); ?>

                    <?php endif; ?>
                </span>
            </dd>
            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Venue')); ?></span></dt>
            <dd class="col-md-6">
                <span class=""><?php echo e(!empty($lead->venue_selection)? $lead->venue_selection :'--'); ?></span>
            </dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Type')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php echo e($lead->type); ?></span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Guest Count')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php echo e($lead->guest_count); ?></span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Assigned Staff')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php echo e(!empty($lead->assign_user)?$lead->assign_user->name:'Not Assigned Yet'); ?>

                    <?php echo e(!empty($lead->assign_user)? '('.$lead->assign_user->type.')' :''); ?></span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Lead Created')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php echo e(\Auth::user()->dateFormat($lead->created_at)); ?></span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Any Special Requirements')); ?></span></dt>
            <?php if($lead->spcl_req): ?>
            <dd class="col-md-6"><span class=""><?php echo e($lead->spcl_req); ?></span></dd>
            <?php else: ?>
            <dd class="col-md-6"><span class="">--</span></dd>
            <?php endif; ?>
            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Estimate Amount')); ?></span></dt>
            <dd class="col-md-6"><span class="">--</span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Status')); ?></span></dt>
            <dd class="col-md-6"><span class="">
                    <?php if($lead->status == 0): ?>
                    <span
                        class="badge bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$status[$lead->status])); ?></span>
                    <?php elseif($lead->status == 1): ?>
                    <span
                        class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$status[$lead->status])); ?></span>
                    <?php elseif($lead->status == 2): ?>
                    <span
                        class="badge bg-secondary p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$status[$lead->status])); ?></span>
                    <?php elseif($lead->status == 3): ?>
                    <span
                        class="badge bg-danger p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$status[$lead->status])); ?></span>
                    <?php elseif($lead->status == 4): ?>
                    <span
                        class="badge bg-success p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$status[$lead->status])); ?></span>
                    <?php elseif($lead->status == 5): ?>
                    <span
                        class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$status[$lead->status])); ?></span>
                    <?php endif; ?>
            </dd>
        </dl>
    </div>
    <?php if($lead->status != 2): ?>
    <div class="w-100 text-end pr-2">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Lead')): ?>
        <div class="action-btn bg-info ms-2">
            <a href="<?php echo e(route('lead.edit',$lead->id)); ?>"
                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip"
                data-title="<?php echo e(__('Lead Edit')); ?>" title="<?php echo e(__('Edit')); ?>"><i class="ti ti-edit"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/lead/view.blade.php ENDPATH**/ ?>