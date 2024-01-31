<?php
$plansettings = App\Models\Utility::plansettings();
?>
<?php echo e(Form::open(array('url' => 'contract'))); ?>


    <div class="row">
        <?php if(isset($plansettings['enable_chatgpt']) && $plansettings['enable_chatgpt'] == 'on'): ?>
        <div class="text-end">
            <a href="#" data-size="md" class="btn btn-sm btn-primary" data-ajax-popup-over="true" data-size="md"
                data-title="<?php echo e(__('Generate content with AI')); ?>" data-url="<?php echo e(route('generate', ['contract'])); ?>"
                data-toggle="tooltip" title="<?php echo e(__('Generate')); ?>">
                <i class="fas fa-robot"></span><span class="robot"><?php echo e(__('Generate With AI')); ?></span></i>
            </a>
        </div>
        <?php endif; ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Contract Name'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('client_name', __('User Name'),['class'=>'form-label'])); ?>

                <?php echo e(Form::select('client_name', $client,null, array('class' => 'form-control select2','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('subject', __('Subject'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('subject', '', array('class' => 'form-control','required'=>'required'))); ?>

            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('value', __('Value'),['class'=>'form-label'])); ?>

                <?php echo e(Form::number('value', '', array('class' => 'form-control','required'=>'required','min' => '1'))); ?>

            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('type', __('Type'),['class'=>'form-label'])); ?>

                <?php echo e(Form::select('type', $contractType,null, array('class' => 'form-control select2','required'=>'required'))); ?>

                <?php if(count($contractType) <= 0): ?>
                    <div class="text-muted text-xs">
                        <?php echo e(__('Please create new contract type')); ?> <a href="<?php echo e(route('contract_type.index')); ?>"><?php echo e(__('here')); ?></a>.
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('date', __('Start Date / End Date'),['class'=>'form-label'])); ?>

                
                
                <div class='input-group'>
                    <input type='text' name="date" id='pc-daterangepicker-2'
                        class="form-control" placeholder="Select date range" />
                    <span class="input-group-text"><i
                            class="feather icon-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('notes', __('Description'),['class'=>'form-label'])); ?>

                <?php echo e(Form::textarea('notes', '', array('class' => 'form-control'))); ?>

            </div>
        </div>

    </div>



<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
    <button type="submit" class="btn  btn-primary"><?php echo e(__('Create')); ?></button>

</div>
<?php echo e(Form::close()); ?>



<script>
document.querySelector("#pc-daterangepicker-2").flatpickr({
    mode: "range"
});
</script>
<?php /**PATH C:\xampp\htdocs\centraverse\resources\views/contracts/create.blade.php ENDPATH**/ ?>