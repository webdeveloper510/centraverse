
<?php
    $startdate = \Carbon\Carbon::createFromFormat('Y-m-d', $lead->start_date)->format('d/m/Y');
    $enddate = \Carbon\Carbon::createFromFormat('Y-m-d', $lead->end_date)->format('d/m/Y');
?>
<div class="row">
        <div class="col-md-12">
            <dl class="row">
                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Name of Lead')); ?></span></dt>
                <dd class="col-md-6"><span class="text-md"><?php echo e($lead->leadname); ?></span></dd>

                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Customer Name')); ?></span></dt>
                <dd class="col-md-6"><span class="text-md"><?php echo e($lead->name); ?></span></dd>
                
                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Email')); ?></span></dt>
                <dd class="col-md-6"><span class="text-md"><?php echo e($lead->email); ?></span></dd>

                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Phone')); ?></span></dt>
                <dd class="col-md-6"><span class="text-md"><?php echo e($lead->phone); ?></span></dd>

                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Address')); ?></span></dt>
                <dd class="col-md-6"><span class="text-md"><?php echo e($lead->lead_address); ?></span></dd>

                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Start Date')); ?></span></dt>
                <dd class="col-md-6"><span class="text-md"><?php echo e(\Auth::user()->dateFormat($lead->start_date)); ?></span></dd>

                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('End Date')); ?></span></dt>
                <dd class="col-md-6"><span class="text-md"><?php echo e(\Auth::user()->dateFormat($lead->end_date)); ?></span></dd>
                
            </dl>
        </div>
        <div class="col-md-12">
            <dl class="row">
                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Start Time')); ?></span></dt>
                <dd class="col-md-6"><span class="text-md"><?php echo e(date('h:i A', strtotime($lead->start_time))); ?></span></dd>

                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('End Time')); ?></span></dt>
                <dd class="col-md-6"><span class="text-md"><?php echo e(date('h:i A', strtotime($lead->end_time))); ?></span></dd>

                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Venue')); ?></span></dt>
                <dd class="col-md-6"><span class="text-md"><?php echo e($lead->venue_selection); ?></span></dd>

                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Event')); ?></span></dt>
                <dd class="col-md-6"><span class="text-md"><?php echo e($lead->type); ?></span></dd>

                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Assigned Staff')); ?></span></dt>
                <dd class="col-md-6"><span class="text-md"><?php echo e(!empty($lead->assign_user)?$lead->assign_user->name:''); ?> (<?php echo e($lead->assign_user->type); ?>)</span></dd>

                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Lead Created')); ?></span></dt>
                <dd class="col-md-6"><span class="text-md"><?php echo e(\Auth::user()->dateFormat($lead->created_at)); ?></span></dd>
                
                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Any Special Requirements')); ?></span></dt>
                <?php if($lead->spcl_req): ?> 
                    <dd class="col-md-6"><span class="text-md"><?php echo e($lead->spcl_req); ?></span></dd>
                <?php else: ?>
                    <dd class="col-md-6"><span class="text-md">--</span></dd>
                <?php endif; ?>
                <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Status')); ?></span></dt>
                <dd class="col-md-6"><span class="text-md">
                    <?php if($lead->status == 0): ?>
                        <span class="badge bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$status[$lead->status])); ?></span>
                    <?php elseif($lead->status == 1): ?>
                        <span class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$status[$lead->status])); ?></span>
                    <?php else: ?>
                        <span class="badge bg-success p-2 px-3 rounded"><?php echo e(__(\App\Models\Lead::$status[$lead->status])); ?></span>
                    <?php endif; ?>
                </dd>
            </dl>
        </div>
        <?php if($lead->status != 2): ?>
        <div class="w-100 text-end pr-2">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Lead')): ?>
            <div class="action-btn bg-info ms-2">
                <a href="<?php echo e(route('lead.edit',$lead->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip"data-title="<?php echo e(__('Lead Edit')); ?>" title="<?php echo e(__('Edit')); ?>"><i class="ti ti-edit"></i>
                </a>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
</div>

<?php /**PATH /home/crmcentraverse/public_html/resources/views/lead/view.blade.php ENDPATH**/ ?>