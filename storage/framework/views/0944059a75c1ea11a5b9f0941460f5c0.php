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
$payments = App\Models\PaymentLogs::where('event_id',$event->id)->get();
$payinfo = App\Models\PaymentInfo::where('event_id',$event->id)->orderby('id','desc')->first();

?>
<div class="row">
    <div class="col-lg-12">
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

            <dt class="col-md-6"><span class="h6  mb-0"><?php echo e(__('Date')); ?></span></dt>
            <?php if($event->start_date == $event->end_date): ?>
            <dd class="col-md-6"><span class=""><?php echo e(\Auth::user()->dateFormat($event->start_date)); ?></span></dd>
            <?php else: ?>
            <dd class="col-md-6"><span class=""><?php echo e(\Auth::user()->dateFormat($event->start_date)); ?> - <?php echo e(\Auth::user()->dateFormat($event->end_date)); ?></span></dd>
            <?php endif; ?>

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
                    <img src="<?php echo e(asset('extension_img/pdf.png')); ?>" alt="File"
                        style="max-width: 100px; max-height: 150px;">
                    <!-- <iframe src="<?php echo e(Storage::url($file)); ?>" width="50%" height="300px"></iframe> -->
                    <?php else: ?>
                    <img src="<?php echo e(asset('extension_img/doc.png')); ?>" alt="File"
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
    <hr>
    <div class="row">
    <div class="col-12  p-0 modaltitle pb-3 mb-3 mt-3">
        <h5 style="margin-left: 14px;"><?php echo e(__('Billing Details')); ?></h5>
    </div>
    <?php if(isset($payments) && !empty($payments)): ?>
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Created On</th>
                        <th scope="col">Name</th>
                        <th scope="col">Transaction Id</th>
                        <th scope="col">Total Amount</th>
                        <th scope="col">Amount Recieved</th>
                    </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e(Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $payment->created_at)->format('M d, Y')); ?></td>
                    <td><?php echo e($payment->name_of_card); ?></td>
                    <td><?php echo e($payment->transaction_id); ?></td>
                    <?php if($payinfo): ?>
                            <td><?php echo e($payinfo->amounttobepaid); ?></td>
                    <?php else: ?>
    <td> -- </td>
    <?php endif; ?>
                    <td><?php echo e($payment->amount); ?></td>
                 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
        </div>
    <?php endif; ?>
    </div>
</div>

</div><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/meeting/detailed_view.blade.php ENDPATH**/ ?>