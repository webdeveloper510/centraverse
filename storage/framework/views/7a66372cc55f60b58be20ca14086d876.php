<?php $event = App\Models\Meeting::find($payinformaton->event_id); ?>
<div class="card-body">
    <table class="table dataTable">
        <tr>
            <th><?php echo e(__('Transaction Id ')); ?></th>
            <td><?php echo e($payinformaton->transaction_id); ?></td>
        </tr>
        <tr>
            <th><?php echo e(__('Name')); ?></th>
            <td><?php echo e($payinformaton->name_of_card); ?></td>
        </tr>
        <tr>
            <th><?php echo e(__('Amount')); ?></th>
            <td><?php echo e($payinformaton->amount); ?></td>
        </tr>
        <tr>
            <th><?php echo e(__('Event')); ?></th>
            <td><?php echo e($event->type); ?></td>
        </tr>
    </table>
</div><?php /**PATH /home/crmcentraverse/public_html/resources/views/billing/invoice.blade.php ENDPATH**/ ?>