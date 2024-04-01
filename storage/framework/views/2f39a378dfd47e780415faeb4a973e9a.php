<?php
    $setting = App\Models\Utility::settings();
    $plansettings = App\Models\Utility::plansettings();
?>


<?php echo e(Form::open(['url' => 'task', 'method' => 'post', 'enctype' => 'multipart/form-data'])); ?>

<div class="row">
    <!-- <?php if(isset($plansettings['enable_chatgpt']) && $plansettings['enable_chatgpt'] == 'on'): ?>
        <div class="text-end">
            <a href="#" data-size="md" class="btn btn-sm btn-primary" data-ajax-popup-over="true" data-size="md"
                data-title="<?php echo e(__('Generate content with AI')); ?>" data-url="<?php echo e(route('generate', ['task'])); ?>"
                data-toggle="tooltip" title="<?php echo e(__('Generate')); ?>">
                <i class="fas fa-robot"></span><span class="robot"><?php echo e(__('Generate With AI')); ?></span></i>
            </a>
        </div>
    <?php endif; ?> -->
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required'])); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('stage', __('Task Stage'), ['class' => 'form-label'])); ?>

            <?php echo Form::select('stage', $stage, null, ['class' => 'form-control ', 'required' => 'required']); ?>

        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

            <?php echo Form::date('start_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required']); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

            <?php echo Form::date('end_date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required']); ?>


        </div>
    </div>

    <div class="col-6" data-name="parent">
        <div class="form-group">
            <?php echo e(Form::label('parent', __('Assign'), ['class' => 'form-label'])); ?>

            <?php echo Form::select('parent', $parent, null, [
                'class' => 'form-control',
                'name' => 'parent',
                'id' => 'parents',
                'required' => 'required',
            ]); ?>

        </div>
    </div>
    <div class="col-6" data-name="parent">
        <div class="form-group">
            <?php echo e(Form::label('parent_id', __('Assign Name'), ['class' => 'form-label'])); ?>

            <select class="form-control" name="parent_id" id="parent_id">

            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('priority', __('Priority'), ['class' => 'form-label'])); ?>

            <?php echo Form::select('priority', $priority, null, ['class' => 'form-control ', 'required' => 'required']); ?>

        </div>
    </div>
    <div class="col-6 mb-3 field" data-name="attachments">
        <div class="attachment-upload">
            <div class="attachment-button">
                <div class="pull-left">
                    <div class="form-group">
                        <?php echo e(Form::label('attachment', __('Attachment'), ['class' => 'form-label'])); ?>

                        
                        <input type="file"name="attachment" class="form-control mb-3"
                            onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <img id="blah" width="20%" height="20%" />
                    </div>
                </div>
            </div>
            <div class="attachments"></div>
        </div>
    </div>

    <?php if($type == 'account'): ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('account', __('Account Name'), ['class' => 'form-label'])); ?>

                <?php echo Form::select('account', $account_name, $id, [
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Select Account',
                ]); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="col-6">
            <div class="form-group">
                <?php echo e(Form::label('account', __('Account'), ['class' => 'form-label'])); ?>

                <?php echo Form::select('account', $account_name, null, [
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Select Account',
                ]); ?>

            </div>
        </div>
    <?php endif; ?>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('Assign User', __('Assign User'), ['class' => 'form-label'])); ?>

            <?php echo Form::select('user', $user, null, ['class' => 'form-control', 'required' => 'required']); ?>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => __('Enter Description')])); ?>

        </div>
    </div>
    <?php if(isset($setting['is_enabled']) && $setting['is_enabled'] == 'on'): ?>
        <div class="form-group col-md-6">
            <label><?php echo e(__('Synchronize in Google Calendar')); ?></label>
            <div class="form-check form-switch pt-2">
                <input id="switch-shadow" class="form-check-input" value="1" name="is_check" type="checkbox">
                <label class="form-check-label" for="switch-shadow"></label>
            </div>
        </div>
    <?php endif; ?>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal">Close</button>
        <?php echo e(Form::submit(__('Save'), ['class' => 'btn  btn-primary '])); ?><?php echo e(Form::close()); ?>

    </div>

</div>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\centraverse\resources\views/task/create.blade.php ENDPATH**/ ?>