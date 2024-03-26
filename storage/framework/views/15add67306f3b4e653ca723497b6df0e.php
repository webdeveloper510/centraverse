<div class="row">
    <div class="col-md-12">
        <dl class="row">
           
            <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Customer Name')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e($event->name); ?></span></dd>

            <!-- <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Type')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e($event->type); ?></span></dd> -->


            <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Total Amount')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e($event->total); ?></span></dd>

             <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Advance Paid')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e($deposit = App\Models\Billing::where('event_id',$event->id)->pluck('deposits')->first()); ?></span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Late Fee')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e($deposit = App\Models\Billing::where('event_id',$event->id)->pluck('latefee')->first()); ?></span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Adjustments')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e($deposit = App\Models\Billing::where('event_id',$event->id)->pluck('adjustments')->first()); ?></span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Balance Due')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e($event->total - $deposit); ?></span></dd>

                        <!-- <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Start Date')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e(\Auth::user()->dateFormat($event->start_date)); ?></span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('End Date')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e(\Auth::user()->dateFormat($event->end_date)); ?></span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Start Time')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e(date('h:i A', strtotime($event->start_time))); ?></span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('End Time')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e(date('h:i A', strtotime($event->end_time))); ?></span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Venue')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e($event->venue_selection); ?></span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Lead Created')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e(\Auth::user()->dateFormat($event->created_at)); ?></span></dd> -->
        </dl>
    </div>
</div><?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/billing/pay-info.blade.php ENDPATH**/ ?>