
<div class="row">
    <div class="col-lg-12">

        <div class="">
            <dl class="row">
                <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Start Date')); ?></span></dt>
                <dd class="col-md-5"><span class="text-md"><?php echo e(\Auth::user()->dateFormat($user_data->start_date)); ?></span></dd>

                <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('End Date')); ?></span></dt>
                <dd class="col-md-5"><span class="text-md"><?php echo e(\Auth::user()->dateFormat($user_data->end_date)); ?></span></dd>

                <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Start Time')); ?></span></dt>
                <dd class="col-md-5"><span class="text-md"><?php echo e(date('h:i A', strtotime($user_data->start_time))); ?></span></dd>

                <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('End Time')); ?></span></dt>
                <dd class="col-md-5"><span class="text-md"><?php echo e(date('h:i A', strtotime($user_data->end_time))); ?></span></dd>

                <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Venue')); ?></span></dt>
                <dd class="col-md-5"><span class="text-md"><?php echo e($user_data->venue); ?></span></dd>

                <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Purpose')); ?></span></dt>
                <dd class="col-md-5"><span class="text-md"><?php echo e($user_data->purpose); ?></span></dd>

                <dt class="col-md-5"><span class="h6 text-md mb-0"><?php echo e(__('Blocked_by')); ?></span></dt>
                <dd class="col-md-5"><span class="text-md"><?php echo e($blocked_username); ?></span></dd>
            </dl>
        </div>
    </div>
    <div>
        <?php if(\Auth::user()->type == 'owner'): ?>
        <div class="w-100 text-center pr-2">
            <a href="<?php echo e(url('/unblock-date/' . $user_data->id)); ?>" style="cursor:pointer; color:red;">Unblock This Date</a>
        </div>
        <?php else: ?>
            <?php if(\Auth::user()->id == $user_data->created_by): ?>
            <div class="w-100 text-center pr-2">
                <a href="<?php echo e(url('/unblock-date/' . $user_data->id)); ?>" style="cursor:pointer; color:red;">Unblock This Date</a>
            </div>
            <?php endif; ?>
        <?php endif; ?>
        <!-- <div class="w-100  pr-2" style="margin-top: -19px;">
            <a href="<?php echo e(url('/unblock-all-dates/' . $user_data->id)); ?>" style="color:red; cursor:pointer;">Unblock All Dates</a>
        </div> -->
    </div>

</div><?php /**PATH /home/crmcentraverse/public_html/centraverse/resources/views/calendar/view.blade.php ENDPATH**/ ?>