<?php
$plansettings = App\Models\Utility::plansettings();
?>
<?php echo e(Form::open(array('url'=>'campaign','method'=>'post','enctype'=>'multipart/form-data'))); ?>

<div class="row">
    <?php if(isset($plansettings['enable_chatgpt']) && $plansettings['enable_chatgpt'] == 'on'): ?>
    <div class="text-end">
        <a href="#" data-size="md" class="btn btn-sm btn-primary" data-ajax-popup-over="true" data-size="md"
            data-title="<?php echo e(__('Generate content with AI')); ?>" data-url="<?php echo e(route('generate', ['campaign'])); ?>"
            data-toggle="tooltip" title="<?php echo e(__('Generate')); ?>">
            <i class="fas fa-robot"></span><span class="robot"><?php echo e(__('Generate With AI')); ?></span></i>
        </a>
    </div>
    <?php endif; ?>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Name'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('status',__('Status'),['class'=>'form-label'])); ?>

            <?php echo Form::select('status', $status, null,array('class' => 'form-control','required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('type',__('Type'),['class'=>'form-label'])); ?>

            <?php echo Form::select('type', $type, null,array('class' => 'form-control')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('start_date',__('Start Date'),['class'=>'form-label'])); ?>

            <?php echo Form::date('start_date', date('Y-m-d'),array('class' => 'form-control','required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('budget',__('Budget'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('budget',null,array('class'=>'form-control','placeholder'=>__('Enter Price'),'required'=>'required'))); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('end_date',__('End Date'),['class'=>'form-label'])); ?>

            <?php echo Form::date('end_date', date('Y-m-d'),array('class' => 'form-control','required'=>'required')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('target_list',__('Target Lists'),['class'=>'form-label'])); ?>

            <?php echo Form::select('target_list', $target_list, null,array('class' => 'form-control')); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('excluding_list',__('Excluding Target Lists'),['class'=>'form-label'])); ?>

            <?php echo Form::select('excluding_list', $target_list, null,array('class' => 'form-control')); ?>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('description',__('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description',null,array('class'=>'form-control','rows'=>2,'placeholder'=>__('Enter Description')))); ?>

        </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('Assign User',__('Assign User'),['class'=>'form-label'])); ?>

            <?php echo Form::select('user', $user, null,array('class' => 'form-control','required' => 'required')); ?>

        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light"
            data-bs-dismiss="modal">Close</button>
            <?php echo e(Form::submit(__('Save'),array('class'=>'btn  btn-primary '))); ?><?php echo e(Form::close()); ?>

    </div>
</div>
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH C:\xampp\htdocs\centraverse\resources\views/campaign/create.blade.php ENDPATH**/ ?>