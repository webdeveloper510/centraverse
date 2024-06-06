
<?php
$labels =
    [ 
        'venue_rental' => 'Venue Rental',
        'hotel_rooms'=>'Hotel Rooms',
        'equipment'=>'Tent, Tables, Chairs, AV Equipment',
        'setup' =>'Setup',
        'bar_package'=>'Bar Package',
        'special_req' =>'Special Requests /Other',
        'food_package'=>'Brunch/Lunch/Dinner Package',
        'additional_items'=>'Additional Items'
    ]; 
    $bill = unserialize($billing->data);

?>

<?php $__env->startSection('content'); ?>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
            <?php echo e(Form::model($billing, ['route' => ['billing.edit', $billing->id],'enctype' => 'multipart/form-data', 'method' => 'post' ,'id'=> 'formdata'])); ?>


                        <div class="col-md-12">
                        <div class="form-group">
        <h4 style="float:right;    background: teal;
    color: white;
    padding: 11px;
    border-radius: 5px;"><b>Guest Count: <?php echo e(App\Models\Meeting::find($billing->event_id)->first()->guest_count); ?></b></h4>
                                <div class="form-group">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Description')); ?> </th>
                                                <th><?php echo e(__('Cost')); ?> </th>
                                                <th><?php echo e(__('Quantity')); ?> </th>
                                                <th><?php echo e(__('Notes')); ?> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php $__currentLoopData = $bill; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(ucfirst(str_replace('_', ' ', $key))); ?></td>
                                                    <td>
                                                        <input type = "number" name ="billing[<?php echo e($key); ?>][cost]"  class= "form-control" value="<?php echo e($item['cost'] ?? ''); ?>"></td>
                                                    <td> 
                                                    <input type = "number" name ="billing[<?php echo e($key); ?>][quantity]" min = '0' class= "form-control" value="<?php echo e($item['quantity'] ?? 1); ?>"required>
                                                    </td>
                                                    <td><input type = "text" name ="billing[<?php echo e($key); ?>][notes]" class= "form-control"  value="<?php echo e($item['notes'] ?? ''); ?>"></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <div class= "form-group">
                                    <label class = "form-label"> Deposit on file: </label>
                                    <input type = "number" name = "deposits" min = '0' value="<?php echo e($billing->deposits); ?>" class= "form-control" readonly>
                                    </div>
                            </div>
                        </div>
                    <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

                    <?php echo e(Form::close()); ?>    
            </div>
        </div>
    </div>
    <style>
.modal-dialog.modal-md {
    max-width: max-content;
}
.table-responsive {
    float: left;
    width: 100%;
}
</style><?php /**PATH C:\xampp\htdocs\abc\centraverse\resources\views/billing/edit.blade.php ENDPATH**/ ?>