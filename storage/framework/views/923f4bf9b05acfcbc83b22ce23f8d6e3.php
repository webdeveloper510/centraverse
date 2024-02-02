<?php
    $plansettings = App\Models\Utility::plansettings();
?>
<?php echo e(Form::open(array('url'=>'salesorder','method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="row">
    <?php if(isset($plansettings['enable_chatgpt']) && $plansettings['enable_chatgpt'] == 'on'): ?>
    <div class="text-end">
        <a href="#" data-size="md" class="btn btn-sm btn-primary" data-ajax-popup-over="true" data-size="md"
            data-title="<?php echo e(__('Generate content with AI')); ?>" data-url="<?php echo e(route('generate', ['sales order'])); ?>"
            data-toggle="tooltip" title="<?php echo e(__('Generate')); ?>">
            <i class="fas fa-robot"></span><span class="robot"><?php echo e(__('Generate With AI')); ?></span></i>
        </a>
    </div>
    <?php endif; ?>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name',null,array('id'=>'name','class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <?php if($type == 'quote'): ?>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('quote',__('Quote'),['class'=>'form-label'])); ?>

            <?php echo Form::select('quote', $quote, $id,array('class' => 'form-control','data-toggle'=>'select')); ?>

        </div>
    </div>
    <?php else: ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('quote',__('Quote'),['class'=>'form-label'])); ?>

                <?php echo Form::select('quote', $quote, null,array('class' => 'form-control','data-toggle'=>'select')); ?>

            </div>
        </div>
    <?php endif; ?>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('opportunity',__('Opportunity'),['class'=>'form-label'])); ?>

            <?php echo Form::select('opportunity', $opportunities, null,array('class' => 'form-control','data-toggle'=>'select')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('status',__('Status'),['class'=>'form-label'])); ?>

            <select name="status" id="status" class="form-control" data-toggle="select" required>
                <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k); ?>"><?php echo e(__($v)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('account',__('Account'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('account',null,array('id'=>'account_name','class'=>'form-control','placeholder'=>__('Enter account'),'disabled'))); ?>

           <input type="hidden" name="account_id" id="account_id">
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('date_salesorder',__('Date SalesOrder'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('date_quoted',date('Y-m-d'),array('class'=>'form-control datepicker','required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('quote_number',__('Quote Number'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('quote_number',null,array('class'=>'form-control','placeholder'=>__('Enter Quote Number'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('billing_contact',__('Billing Contact'),['class'=>'form-label'])); ?>

            <?php echo Form::select('billing_contact', $contact, null,array('class' => 'form-control','data-toggle'=>'select')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('billing_address',__('Billing Address'),['class'=>'form-label'])); ?>

            <div class="action-btn bg-primary ms-2 float-end">
            <a class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" id="billing_data" data-toggle="tooltip" data-placement="top" title="Same As Billing Address"><i class="fas fa-copy"></i></a>
            <span class="clearfix"></span>
            </div>
            <?php echo e(Form::text('billing_address',null,array('id'=>'billing_address','class'=>'form-control','placeholder'=>__('Billing Address'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('shipping_address',__('Shipping Address'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('shipping_address',null,array('id'=>'shipping_address','class'=>'form-control','placeholder'=>__('Shipping Address'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <?php echo e(Form::text('billing_city',null,array('id'=>'billing_city','class'=>'form-control','placeholder'=>__('Billing city'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <?php echo e(Form::text('billing_state',null,array('id'=>'billing_state','class'=>'form-control','placeholder'=>__('Billing State'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <?php echo e(Form::text('shipping_city',null,array('id'=>'shipping_city','class'=>'form-control','placeholder'=>__('Shipping City'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <?php echo e(Form::text('shipping_state',null,array('id'=>'shipping_state','class'=>'form-control','placeholder'=>__('Shipping State'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <?php echo e(Form::text('billing_country',null,array('id'=>'billing_country','class'=>'form-control','placeholder'=>__('Billing Country'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <?php echo e(Form::text('billing_postalcode',null,array('id'=>'billing_postalcode','class'=>'form-control','placeholder'=>__('Billing Postal Code'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <?php echo e(Form::text('shipping_country',null,array('id'=>'shipping_country','class'=>'form-control','placeholder'=>__('Shipping Country'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <?php echo e(Form::text('shipping_postalcode',null,array('id'=>'shipping_postalcode','class'=>'form-control','placeholder'=>__('Shipping Postal Code'),'required'=>'required'))); ?>

        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('shipping_contact',__('Shipping Contact'),['class'=>'form-label'])); ?>

            <?php echo Form::select('shipping_contact', $contact, null,array('class' => 'form-control','data-toggle'=>'select')); ?>

        </div>
    </div>
    
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('shipping_provider',__('Shipping Provider'),['class'=>'form-label'])); ?>

            <?php echo Form::select('shipping_provider', $shipping_provider, null,array('class' => 'form-control','data-toggle'=>'select','required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('Assign User',__('Assign User'),['class'=>'form-label'])); ?>

            <?php echo Form::select('user', $user, null,array('class' => 'form-control','data-toggle'=>'select','required' => 'required')); ?>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('description',__('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Description')))); ?>

        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <?php echo e(Form::submit(__('Save'),array('class'=>'btn btn-primary'))); ?>

    </div>
</div>
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\centraverse\resources\views/salesorder/create.blade.php ENDPATH**/ ?>