<?php echo e(Form::open(['route' => 'contracts.store', 'method' => 'post', 'enctype' => 'multipart/form-data','id'=>'formdata'] )); ?>



<div class="row">

    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Contract Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('subject', __('Subject'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('subject', '', array('class' => 'form-control','required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('client_name', __('Staff Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('client_name', $client,null, array('class' => 'form-control select2','required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('atttachment',__('Upload File'),['class'=>'form-label'])); ?>

            <input type="file" name="atttachment" id="atttachment" class="form-control">

        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <button type="submit" class="btn  btn-primary"><?php echo e(__('Create')); ?></button>

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/crmcentraverse/public_html/resources/views/contract/newtemplate.blade.php ENDPATH**/ ?>