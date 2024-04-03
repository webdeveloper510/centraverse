<?php 
$package = json_decode($event->func_package,true);
$additional = json_decode($event->ad_opts,true);
if(isset($event->bar_package) && !empty($event->bar_package)){
    $bar = json_decode($event->bar_package,true);
}
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
            
            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Room')); ?></span></dt>
            <dd class="col-md-6"><span class=""><?php if($event->room != 0): ?><?php echo e($event->room); ?><?php else: ?> -- <?php endif; ?></span></dd>
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
            <hr class="mt-5">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <h3><?php echo e(__('Setup')); ?></h3>
                </div>
            </div>
            <hr>
            <img src="<?php echo e($event->floor_plan); ?>" alt="">
        </dl>

        <!-- </div> -->

    </div>

    <?php
    $files = Storage::files('app/public/Event/'.$event->id);
    ?>
    <hr>
    <div class="row">
        <?php if(isset($files) && !empty($files)): ?>
        <h3>Attachments</h3>
        <hr>
        <div class="col-md-12">
            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <!-- Display file name -->
                <p><?php echo e(basename($file)); ?></p>
                <div>

                    <!-- Display preview if it's a PDF -->
                    <?php if(pathinfo($file, PATHINFO_EXTENSION) === 'pdf'): ?>
                    <img src="<?php echo e(asset('extension_img/images.png')); ?>" alt="File"
                        style="max-width: 100px; max-height: 150px;">
                    <!-- <iframe src="<?php echo e(Storage::url($file)); ?>" width="50%" height="300px"></iframe> -->
                    <?php else: ?>
                    <img src="<?php echo e(asset('extension_img/images.png')); ?>" alt="File"
                        style="max-width: 100px; max-height: 150px;">
                    <!-- Placeholder icon for non-PDF files -->
                    <?php endif; ?>
                    <a href="<?php echo e(Storage::url($file)); ?>" download style=" position: absolute;"> <i
                            class="fa fa-download"></i></a>

                    <!-- Download link -->
                </div>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>

</div>

</div><?php /**PATH /home/crmcentraverse/public_html/resources/views/meeting/detailed_view.blade.php ENDPATH**/ ?>