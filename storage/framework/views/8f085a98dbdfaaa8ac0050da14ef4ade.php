
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Billing')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
        <div class="page-header-title">
            <?php echo e(__('Billing')); ?>

        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php
$settings = App\Models\Utility::settings();
if(isset($settings['fixed_billing'])&& !empty($settings['fixed_billing'])){
    $billings = json_decode($settings['fixed_billing']);
}
$labels =
    [ 
        'venue_rental' => 'Venue Rental',
        'hotel_rooms'=>'Hotel Rooms',
        'equipment'=>'Tent, Tables, Chairs, AV Equipment',
        'setup' =>'Setup',
        'gold_2hrs'=>'Bar Package',
        'special_req' =>'Special Requests /Other',
        'classic_brunch'=>'Brunch/Lunch/Dinner Package',
    ]; 
?> 
<?php $__env->startSection('content'); ?>
<div class="container-field">
    <div id="wrapper">
        
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                    <?php echo e(Form::open(array('url'=>'billing','method'=>'post','enctype'=>'multipart/form-data' ,'id'=>'formdata'))); ?>

                    <div class = "col-md-12" id = "useradd-1" >
                        <div class="form-group">
                            <label class="form-label">Select Customer :</label>
                            <select class="form-select" id = "userinfo" name = "event" required>
                                <option value= '-1' disabled selected>Select Customer</option>
                                <?php $__currentLoopData = $meeting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($meet->id); ?>"><?php echo e($meet->name); ?> (Event- <?php echo e($meet->type); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
               
                    <div class = "col-md-12">
                        <div class = "form-group">
                        <label>No. of Guests : </label>
                        <input type ="text"  value = "" readonly name ="guestcount" style = "border:none" >
                    </div>                  
               
                    <div class="col-md-12">
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
                                        <?php $__currentLoopData = $labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(ucfirst($label)); ?></td>
                                                <td>
                                                <input type = "text" name ="billing[<?php echo e($key); ?>][cost]" value="$<?php echo e($billing->$key); ?>" class= "form-control" readonly></td>
                                                <td> 
                                                <input type = "number" name ="billing[<?php echo e($key); ?>][quantity]" min = '0' class= "form-control" required>
                                                </td>
                                                <td><input type = "text" name ="billing[<?php echo e($key); ?>][notes]" class= "form-control"></td> 
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <div class= "form-group">
                                <label class = "form-label"> Deposit on file: </label>
                                <input type = "number" name = "deposits" min = '0'  class= "form-control" required>
                                </div>
                        </div>
                    </div>
                <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary '))); ?>

                <?php echo e(Form::close()); ?>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<script>
    $('select[name= "event"]').on('change', function() {
        var id = this.value ;
        $.ajax({
            url: "<?php echo e(route('billing.eventdetail')); ?>",
            type: 'POST',
            data: {
                "id": id,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function(data) {
                $('input[name ="guestcount"]').val(data[0].guest_count);
                $('input[name ="billing[venue_rental][notes]"]').val(data[0].venue_selection);
                $('input[name ="billing[hotel_rooms][quantity]"]').val(data[0].room);
                $('input[name ="billing[gold_2hrs][notes]"]').val(data[0].bar);
                $('input[name ="billing[special_req][notes]"]').val(data[0].spcl_request);
                $('input[name ="billing[classic_brunch][notes]"]').val(data[0].function +','+ data[0].func_package);
                $('input[name ="billing[hotel_rooms][quantity]"]').attr('readonly', true);
                $('input[name ="billing[venue_rental][notes]"]').attr('readonly', true);
                $('input[name ="billing[gold_2hrs][notes]"]').attr('readonly', true);
                $('input[name ="billing[classic_brunch][notes]"]').attr('readonly', true);
            }
        });          
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\centraverse\resources\views/billing/create.blade.php ENDPATH**/ ?>