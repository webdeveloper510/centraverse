<div class="row">
    <div class="col-md-12">
        <dl class="row">

            <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Customer Name')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e($event->name); ?></span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Amount')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e($event->total); ?></span></dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Advance Payment')); ?></span></dt>
            <dd class="col-md-6">
                <span class="text-md"><?php echo e($deposit = App\Models\Billing::where('event_id',$event->id)->pluck('deposits')->first()); ?></span>
            </dd>

            <dt class="col-md-6"><span class="h6 text-md mb-0"><?php echo e(__('Balance Due')); ?></span></dt>
            <dd class="col-md-6"><span class="text-md"><?php echo e($event->total - $deposit); ?></span></dd>

        </dl>
    </div>
</div><?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/billing/pay-info.blade.php ENDPATH**/ ?>