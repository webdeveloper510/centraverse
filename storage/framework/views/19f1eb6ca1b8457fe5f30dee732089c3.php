<?php echo e(Form::open(array('url'=>'report','method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="row">
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('chart_type',__('Chart Type'),['class'=>'form-label'])); ?>

            <?php echo Form::select('chart_type', $chart_type,null,array('class' => 'form-control ','required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('entity_type',__('Entity Type'),['class'=>'form-label'])); ?>

            <?php echo Form::select('entity_type', $entity_type,null,array('class' => 'form-control ','name'=>'entity_type','id'=>'entity_type','required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('group_by',__('Group By'),['class'=>'form-label'])); ?>

            <select class="form-control"  name="group_by" id="group_by">

            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('Assign User',__('Assign User'),['class'=>'form-label'])); ?>

            <?php echo Form::select('user', $user, null,array('class' => 'form-control ','required'=>'required')); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light"
        data-bs-dismiss="modal">Close</button>
        <?php echo e(Form::submit(__('Save'),array('class'=>'btn  btn-primary '))); ?><?php echo e(Form::close()); ?>

</div>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\centraverse\resources\views/report/create.blade.php ENDPATH**/ ?>