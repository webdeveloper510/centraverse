<?php echo e(Form::open(array('url' => 'contract_type'))); ?>


    <div class="row">
        <div class="form-group col-12">
            <?php echo e(Form::label('name', __('Contract Type Name'),['class'=>'col-form-label'])); ?>

            <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required','placeholder'=>'Enter Contract Type Name'))); ?>

        </div>
    </div>

<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <button type="submit" class="btn  btn-primary"><?php echo e(__('Create')); ?></button>
</div>

    <?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\centraverse\resources\views/contract_type/create.blade.php ENDPATH**/ ?>