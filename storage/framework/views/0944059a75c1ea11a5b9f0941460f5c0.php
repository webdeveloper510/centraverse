<?php 
// echo "<pre>";print_r($event);die;

$package = json_decode($event->func_package,true);
$additional = json_decode($event->ad_opts,true);
if(isset($event->bar_package) && !empty($event->bar_package)){
    $bar = json_decode($event->bar_package,true);
}
// echo "<pre>";print_r($bar);die;
?>
<div class="row">
    <div class="col-lg-12">
        <!-- <div class=""> -->
        <dl class="row">
            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Event')); ?></span></dt>
            <?php if($event->attendees_lead != 0): ?>
            <dd class="col-md-6"><span
                    class=""><?php echo e(!empty($event->attendees_leads->leadname)?$event->attendees_leads->leadname:'--'); ?></span>
            </dd>
            <?php else: ?>
            <dd class="col-md-6"><span class=""><?php echo e($event->eventname); ?></span></dd>
            <?php endif; ?>
            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Event Type')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php echo e($event->type); ?></span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Start Date')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php echo e(\Auth::user()->dateFormat($event->start_date)); ?></span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('End Date')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php echo e(\Auth::user()->dateFormat($event->end_date)); ?></span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Time')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php echo e(date('h:i A', strtotime($event->start_time))); ?> -
                    <?php echo e(date('h:i A', strtotime($event->end_time))); ?></span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Guest Count')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php echo e($event->guest_count); ?></span></dd>

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Venue')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php echo e($event->venue_selection); ?></span></dd>
            <?php if(isset($package) && !empty($package)): ?>
            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Package')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php $__currentLoopData = $package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e(implode(',',$value)); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </span>
            </dd>
            <?php endif; ?>
            <?php if(isset($additional) && !empty($additional)): ?>
            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Additional Items')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php $__currentLoopData = $additional; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e(implode(',',$value)); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </span>
            </dd>
            <?php endif; ?>
            <?php if(isset($bar) && !empty($bar)): ?>
            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Bar Package')); ?></span></dt>
            <dd class="col-md-6"><span class="">
                    <?php echo e(implode(',',$bar)); ?>

                </span>
            </dd>
            <?php endif; ?>

            <dt class="col-md-6"><span class="h6  mb-3"><?php echo e(__('Setup')); ?></span></dt>
            <img src="<?php echo e($event->floor_plan); ?>" alt="">
        </dl>
        <!-- </div> -->

    </div>

    <div class="w-100 text-end pr-2">
        <!-- <?php if($event->start_date >= now()): ?>
    <a href="<?php echo e(url('/event-download/' . $event->id)); ?>"><i class="fa fa-download action-btn bg-info ms-1" style="cursor:pointer;"></i></a>
    <?php endif; ?> -->
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit event')): ?>
        <div class="action-btn bg-info ms-2">
            <a href="<?php echo e(route('event.edit',$event->id)); ?>"
                class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip"
                data-title="<?php echo e(__('Edit Call')); ?>" title="<?php echo e(__('Edit')); ?>"><i class="ti ti-edit"></i>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/meeting/detailed_view.blade.php ENDPATH**/ ?>